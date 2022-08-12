<?php
declare (strict_types = 1);
namespace App\Models;

class ProductModel extends \App\Libraries\Model
{

    public function index($id = null): array
    {   
        $condidtion = null;
        if($id) 
            $condidtion = "WHERE id = {$id}";
    
        $this->query("SELECT * from product $condidtion");
        $this->execute();
        return $this->resultSet() ? $this->resultSet() : [];
    }

    public function delete(int $id = null): void
    {
        if (empty($id)) exit();

        $this->query("DELETE from product WHERE id={$id}");
        $this->execute();
    }

    public function add(array $product = null): void
    {
        if (empty($product)) exit();
        $this->query("INSERT INTO product(title, description, image, price) VALUES (:title, :description, :image, :price)");
        $this->bind(":title",$product["productTitle"]);
        $this->bind(":description",$product["descriptoin"]);
        $this->bind(":image",$product["file"]["name"] ?? "");
        $this->bind(":price",$product["price"]);
        $this->execute();
    }



    // public function add($array )
}
