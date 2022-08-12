<?php
declare (strict_types = 1);
namespace App\Models;

use App\Helpers\Auth;
use App\Libraries\Model;

class AdminModel extends Model
{

    public function login(array $userDetail)
    {   
        if((empty($userDetail))) exit();
        
        try {
            $this->query("SELECT id,email,password FROM admin WHERE email=:email AND password=:password LIMIT 1 ");
            $this->stmt->bindValue(":email", $userDetail["email"]);
            $this->stmt->bindValue(":password", $userDetail["password"]);
            $row = $this->single();
            if ($this->rowCount() > 0) {
                Auth::authenticate($row['id']);
            }

        } catch (\PDOException$e) {
            echo $e->getMessage();
        }
    }
}
