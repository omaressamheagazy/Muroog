<?php

declare(strict_types=1);

namespace App\Models;

use App\Helpers\Auth;
use App\Libraries\Model;

class AdminModel extends Model
{

    public function login(array $userDetail)
    {
        if ((empty($userDetail))) {
            exit();
        }

        try {
            $this->query("SELECT id,email,password, role FROM admin WHERE email=:email AND password=:password LIMIT 1 ");
            $this->bind(":email", $userDetail["email"]);
            $this->bind(":password", \sha1($userDetail["password"]));
            $row = $this->single();
            if ($this->rowCount() > 0) {
                Auth::authenticate(["id" => $row['id'], "role" => $row["role"]]);
            }
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function add(array $adminDetail): bool
    {
        try {
            if(!$this->isEmailUnique($adminDetail["email"])) return false;
            $this->query("INSERT INTO admin(name, phone, email, password, role) VALUES(:name, :phone, :email, :password, :role)");
            $this->bind(":name", $adminDetail["name"]);
            $this->bind(":phone", $adminDetail["phone"]);
            $this->bind(":email", $adminDetail["email"]);
            $this->bind(":password", \sha1($adminDetail["password"])); // store the password in hashed format
            $this->bind(":role", $adminDetail["role"]);
            return $this->execute() ? true : false;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function getAlladmin(): array
    {

        try {
            $this->query("SELECT * FROM ADMIN  WHERE not id=:currentID");
            $this->bind(":currentID", $_SESSION["USER"]);
            return $this->resultSet() ?? $this->resultSet() ?? [];

        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    public  function delete(int $id): bool {
        try {
            $this->query("DELETE FROM admin where id={$id} ");
            return $this->execute() ? true : false;
        } catch(\PDOException $e) {
            echo $e->getMessage();
        }
        catch(\Exception $e) {
            echo $e->getMessage();
        }
        
    }

    public function update(array $adminDetail): bool
    {
        try {
            if(!$this->isProvidedEmailSame($adminDetail["email"], +$adminDetail["id"])) { // if the entered email is same as the current email, no need to check if it's unique
                if(!$this->isEmailUnique($adminDetail["email"])) return false;
            }
            $this->query("UPDATE  admin set name=:name, email=:email, phone=:phone, role=:role WHERE id=:id");
            $this->bind(":name", $adminDetail["name"]);
            $this->bind(":phone", $adminDetail["phone"]);
            $this->bind(":email", $adminDetail["email"]);
            $this->bind(":role", $adminDetail["role"]);
            $this->bind(":id", $adminDetail["id"]);
            return $this->execute() ? true : false;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function isEmailUnique(string $email): bool {
        try {
        $this->query("SELECT COUNT(email) as total from admin where email=:email  LIMIT 1");
        $this->bind(":email", $email);
        return  $this->single()["total"] > 0 ? false : true;

        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function isProvidedEmailSame(string $newEmail, int $adminId): bool {
        $this->query("SELECT email FROM admin WHERE id=:id");
        $this->bind(":id", $adminId);
        $oldEmail = $this->single()["email"];
        return $newEmail == $oldEmail ? true : false;
    }
    public function getAdminbyId(int $id) : array {
        $this->query("SELECT * from admin where id=:id LIMIT 1");
        $this->bind(":id", $id);
        return $this->single() ?? $this->single() ?? [];
    }
}
