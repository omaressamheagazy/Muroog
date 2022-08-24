<?php

declare(strict_types=1);

namespace App\Models;

use App\Helpers\Auth;
use App\Helpers\Enums\MessagesName;
use App\Helpers\Enums\MessageType;
use App\Helpers\Logger;
use App\Helpers\MessageReporting;
use App\Helpers\Redirection;
use App\Libraries\Model;

class AdminModel extends Model
{

    public function login(array $userDetail)
    {
        if ((empty($userDetail))) {
            exit();
        }

        try {
            $this->query("SELECT password,id,role FROM admin WHERE email=:email LIMIT 1 ");
            $this->bind(":email", $userDetail["email"]);
            $row = $this->single();
            if ($this->rowCount() > 0) {
                if(password_verify($userDetail["password"], $row["password"])) 
                    Auth::authenticate(["id" => $row['id'], "role" => $row["role"]]);
            }
        } catch (\PDOException $e) {
            $error = $e->getMessage();
            Logger::add($error);
            MessageReporting::flash(MessagesName::ERROR, "An error occured, please try again later", MessageType::FAIL);
            Redirection::redirectTo("/admin");
        }
    }

    public function add(array $adminDetail): bool
    {
        try {
            if($this->isEmailExist($adminDetail["email"])) return false;
            $this->query("INSERT INTO admin(name, phone, email, password, role) VALUES(:name, :phone, :email, :password, :role)");
            $this->bind(":name", $adminDetail["name"]);
            $this->bind(":phone", $adminDetail["phone"]);
            $this->bind(":email", $adminDetail["email"]);
            $this->bind(":password", password_hash($adminDetail["password"], PASSWORD_DEFAULT)); // store the password in hashed format
            $this->bind(":role", $adminDetail["role"]);
            return $this->execute() ? true : false;
        } catch (\PDOException $e) {
            $error = $e->getMessage();
            Logger::add($error);
            MessageReporting::flash(MessagesName::ERROR, "An error happend while adding a new an admin, please try again", MessageType::FAIL);
            Redirection::redirectTo("/admin/all");
        }
    }

    public function getAlladmin(): array
    {

        try {
            $this->query("SELECT * FROM ADMIN  WHERE not id=:currentID");
            $this->bind(":currentID", $_SESSION["USER"]);
            return $this->resultSet() ?? $this->resultSet() ?? [];

        } catch (\PDOException $e) {
            $error = $e->getMessage();
            Logger::add($error);
            MessageReporting::flash(MessagesName::ERROR, "An error happend while trying to show all  admins, please try again",  MessageType::FAIL);
            Redirection::redirectTo("/admin/all");
        }
    }

    public  function delete(int $id): bool {
        try {
            $this->query("DELETE FROM admin where id={$id} ");
            return $this->execute() ? true : false;
        } catch(\PDOException $e) {
            $error = $e->getMessage();
            Logger::add($error);
            MessageReporting::flash(MessagesName::ERROR, "An error happend while deleting an admin, please try again", MessageType::FAIL);
            Redirection::redirectTo("/admin/all");
        }

        
    }

    public function update(array $adminDetail): bool
    {
        try {
            if(!$this->isProvidedEmailSame($adminDetail["email"], +$adminDetail["id"])) { // if the entered email is same as the current email, no need to check if it's unique
                if($this->isEmailExist($adminDetail["email"])) return false;
            }
            $this->query("UPDATE  addmin set name=:name, email=:email, phone=:phone, role=:role WHERE id=:id");
            $this->bind(":name", $adminDetail["name"]);
            $this->bind(":phone", $adminDetail["phone"]);
            $this->bind(":email", $adminDetail["email"]);
            $this->bind(":role", $adminDetail["role"]);
            $this->bind(":id", $adminDetail["id"]);
            return $this->execute() ? true : false;
        } catch (\PDOException $e) {
            $error = $e->getMessage();
            Logger::add($error);
            MessageReporting::flash(MessagesName::ERROR, "An error happend while updating an admin, please try again",  MessageType::FAIL);
            Redirection::redirectTo("/admin/all");
            
        }

    }

    public function isEmailExist(string $email): bool {
        try {
        $this->query("SELECT COUNT(email) as total from admin where email=:email  LIMIT 1");
        $this->bind(":email", $email);
        return  $this->single()["total"] > 0 ? true : false;

        } catch (\PDOException $e) {
            throw new \PDOException();
        }
    }

    public function isProvidedEmailSame(string $newEmail, int $adminId): bool {

        try {
            $this->query("SELECT email FROM admin WHERE id=:id");
            $this->bind(":id", $adminId);
            $oldEmail = $this->single()["email"];
            return $newEmail == $oldEmail ? true : false;
        } catch (\Exception $e) {
            throw new \PDOException();
        }
    }
    public function getAdminbyId(int $id) : array {
        try {
            $this->query("SELECT * from admin where id=:id LIMIT 1");
            $this->bind(":id", $id);
            return $this->single() ?? $this->single() ?? [];
        } catch (\PDOException $e) {
            throw new \PDOException();
        }
    }

    public function getPassword(int $id) : string {
        try {
            $this->query("SELECT password from admin where id=:id LIMIT 1");
            $this->bind(":id", $id);
            return $this->single()["password"] ? $this->single()["password"] : [];
        } catch (\PDOException $e) {
            throw new \PDOException();
        }
    }

    public  function numberOfAdmin() {
        try {
            $this->query("SELECT COUNT(name) as total from admin");
            return $this->single()["total"];
        } catch (\PDOException $e) {
            throw new \PDOException();
        }
    }
}
