<?php
declare(strict_types = 1);
namespace App\Models;

use App\Libraries\Model;
use PDOException;

class PasswordModel extends Model {
    public function add(array $data): bool {
        try {
            $this->query("INSERT into resetpasswords(email, code) VALUES(:email, :code)");
            $this->bind(":email", $data["email"]);
            $this->bind(":code", $data["code"]);
            return $this->execute();
        } catch(\PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function isCodeExist(string $code) {
        $this->query("SELECT COUNT(code) as total from resetpasswords where code=:code LIMIT 1");
        $this->bind(":code", $code);
        return  $this->single()["total"] > 0 ? true : false;
    }
    public  function getEmailByCode(string $code) {
        $this->query("SELECT email FROM resetpasswords WHERE code=:code LIMIT 1");
        $this->bind(":code", $code);
        return $this->single()["email"];
    }

    public function updatePassword(array $admin) {
        $email = $this->getEmailByCode($admin["code"]);
        $this->query("UPDATE admin SET password=:password WHERE email=:email");
        $this->bind(":password", \sha1($admin["password"]));
        $this->bind(":email", $email);
        return $this->execute();
    }

    public function deleteRegsiterdCode(string $code) {
        $this->query("DELETE FROM resetpasswords WHERE code=:code");
        $this->bind(":code", $code);
        $this->execute();
    }
}
?>