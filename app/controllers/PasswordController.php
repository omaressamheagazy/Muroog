<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Helpers\Email;
use App\Helpers\Enums\MessagesName;
use App\Helpers\Enums\MessageType;
use App\Helpers\Logger;
use App\Helpers\MessageReporting;
use App\Helpers\Redirection;
use App\Libraries\Controller;

class PasswordController extends Controller
{

    public function index()
    {
        $this->view('backend/pages/password/passwordResetView', []);
    }

    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                "email" => trim($_POST["email"]),
                "code" => \uniqid(more_entropy: true),
                "error" => [],
                "success" => []
            ];
            try {

                $passwordModel = $this->model(MODELS_NAMESPACE . "PasswordModel");
                $adminModel = $this->model(MODELS_NAMESPACE . "AdminModel");
                if (!call_user_func_array([$adminModel, "isEmailExist"], [$data["email"]])) {
                    $data["error"]["duplicate_email"] = "The email that you entered is not match any account";
                }
                if (empty($data["error"])) {
                    if (call_user_func_array([$passwordModel, "add"], [$data])) {
                        $data["success"]["email"] = "A link has been sent to your email";
                        $this->send($data["email"], $data["code"]);
                    }
                }
                $this->view('backend/pages/password/addPasswordView', $data);
            } catch (\PDOException $e) {

                $error = $e->getMessage();
                Logger::add($error);
                MessageReporting::dialogMessage("An error happend while trying to reset password, please try again later");
                exit();
            }
        }
    }

    public function send(string $email, string $code)
    {
        $serverSetting = [
            "server" => "smtp.gmail.com",
            "username" => $_ENV["SMTP_USER"],
            "password" => $_ENV["SMTP_PASSWORD"]
        ];

        $recipients = [
            "fromEmail" => $_ENV["SMTP_USER"],
            "fromName" => "Muroog Support Team",
            "recipientEmail" => $email,
            "recipientName" => "Muroog Admin",
        ];

        $path = URLROOT . "reset/update/" . $code;
        $content = [
            "subject" => "reset password",

            "body" => "Go to this <a href=$path>link</a>"
        ];

        $mail = new Email();
        $mail->sendEmail($serverSetting, $recipients, $content);
    }

    public function update(array $param = null)
    {
        try {

            $passwordModel = $this->model(MODELS_NAMESPACE . "PasswordModel");
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $data = array_map(fn ($element) => trim($element),  $_POST);
                if (call_user_func_array([$passwordModel, "updatePassword"], [$data])) {
                    MessageReporting::flash(MessagesName::PASSWORD, "Password ,updated successfully");
                    call_user_func_array([$passwordModel, "deleteRegsiterdCode"], [$data["code"]]);
                    self::redirectTo("/admin/login");
                }
            } else {
                $data = [
                    "code" => $param["id"]
                ];
                if (!call_user_func_array([$passwordModel, "isCodeExist"], [$data["code"]]))
                    Self::redirectTo("/admin/login");
            }

            $this->view('backend/pages/password/updatePasswordView', $data);
        } catch (\PDOException $e) {
            $error = $e->getMessage();
            Logger::add($error);
            MessageReporting::flash(MessagesName::ERROR, "An error happend while updating the admin, please try again", MessageType::FAIL);
            Redirection::redirectTo("/admin/location");
        }
    }
}
