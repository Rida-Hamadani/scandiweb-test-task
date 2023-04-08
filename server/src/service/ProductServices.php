<?php

namespace service;
use core\Database;
use PDO;

class Product extends Database {

    private PDO $connection;

    public function __construct(Database $database) {

        $this->connection = $database->getConnection();

    }

    // Get the list of all products

    protected function getAll(): array {

        $sql = "SELECT * 
                FROM products;";

        $statement = $this->connection->query($sql);

        return $statement->fetchAll(PDO::FETCH_ASSOC);

    }

    // Create new product

    protected function create(string $sku, string $name, string $price, string $property): string {

        $sql = "INSERT INTO products (sku, name, price, property)
                VALUES (:sku, :name, :price, :property);";

        $statement = $this->connection->prepare($sql);

        $statement->bindValue(':sku', $sku, PDO::PARAM_STR);
        $statement->bindValue(':name', $name, PDO::PARAM_STR);
        $statement->bindValue(':price', $price, PDO::PARAM_STR);
        $statement->bindValue(':property', $property, PDO::PARAM_STR);

        $statement->execute();

        return $this->connection->lastInsertId();

    }

    // Check if SKU is taken

    protected function isSkuTaken(string $sku): bool {

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

    protected function delete(string $sku): int {

        $sql = "DELETE FROM products
               WHERE sku=:sku;";

        $statement = $this->connection->prepare($sql);
        $statement->bindValue(':sku', $sku, PDO::PARAM_STR);
        $statement->execute();

        return $statement->rowCount(); 
    }
    
}