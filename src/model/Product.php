<?php

/**
  * The closing ?> tag MUST be omitted from files containing only PHP.
  * @see https://www.php-fig.org/psr/psr-12/
  *
  * @author Rayane Mallek (mallekr@3il.fr)
*/

require_once File::build_path(array("model", "BaseModel.php"));

class Product extends BaseModel
{
    private ?string $name;
    private ?string $description;
    private ?float $price;

    public function __construct(?string $name = null, ?string $description = null, ?float $price = null)
    {
        parent::__construct();

        if (!is_null($name) && !is_null($description) && !is_null($price)) {
            $this->name = $name;
            $this->description = $description;
            $this->price = $price;
        }
    }

    public function getAllProducts()
    {
        $sql = "SELECT * FROM product";
        $req = $this->pdo->query($sql);
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getProductById($id)
    {
        $sql = "SELECT * FROM product WHERE id = :id";
        $req = $this->pdo->prepare($sql);
        $req->execute(['id' => $id]);
        return $req->fetch(PDO::FETCH_ASSOC);
    }

    public function create()
    {
        $sql = "INSERT INTO product (name, description, price) VALUES (:name, :description, :price)";
        $req = $this->pdo->prepare($sql);
        $req->execute([
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
        ]);
    }

    public function update($id)
    {
        $sql = "UPDATE product SET name = :name, description = :description, price = :price  WHERE id = :id";
        $req = $this->pdo->prepare($sql);
        $req->execute([
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'id' => $id
        ]);
    }

    public function delete($id)
    {
        $sql = "DELETE FROM product WHERE id = :id";
        $req = $this->pdo->prepare($sql);
        $req->execute(['id' => $id]);
    }
}

