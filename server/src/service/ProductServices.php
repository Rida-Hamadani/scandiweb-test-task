<?php

namespace service;
use core\Database;
use model\Product;
use PDO;

class ProductServices {

    private PDO $connection;

    public function __construct(Database $database) {

        $this->connection = $database->getConnection();

    }

    // Get the list of all products

    public function getAll(): array {

        $sql = "SELECT * 
                FROM products;";

        $statement = $this->connection->query($sql);

        return $statement->fetchAll(PDO::FETCH_ASSOC);

    }

    // Create new product

    public function create(Product $product): string {

        $sql = "INSERT INTO products (sku, name, price, property)
                VALUES (:sku, :name, :price, :property);";

        $statement = $this->connection->prepare($sql);

        $statement->bindValue(':sku', $product->getSku(), PDO::PARAM_STR);
        $statement->bindValue(':name', $product->getName(), PDO::PARAM_STR);
        $statement->bindValue(':price', $product->getPrice(), PDO::PARAM_STR);
        $statement->bindValue(':property', $product->getSpecificProperty(), PDO::PARAM_STR);

        $statement->execute();

        return $this->connection->lastInsertId();

    }

    // Check if SKU is taken

    public function isSkuTaken(string $sku): bool {

        $sql = "SELECT sku
                FROM products
                WHERE sku = :sku;";
        
        $statement = $this->connection->prepare($sql);
        $statement->bindValue(":sku", $sku, PDO::PARAM_STR);
        $statement->execute();

        if ($statement->rowCount() !== 0) {

            return true;

        }

        return false;

    }

    // Delete product from database

    public function delete(string $sku): int {

        $sql = "DELETE FROM products
               WHERE sku=:sku;";

        $statement = $this->connection->prepare($sql);
        $statement->bindValue(':sku', $sku, PDO::PARAM_STR);
        $statement->execute();

        return $statement->rowCount(); 
    }
    
}