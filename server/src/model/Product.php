<?php

namespace model;
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

    protected function create(array $properties): string {

        $sql = "INSERT INTO products (sku, name, price, size, weight, dimensions)
                VALUES (:sku, :name, :price, :size, :weight, :dimensions);";

        $statement = $this->connection->prepare($sql);

        foreach (['sku', 'name', 'price', 'size', 'weight', 'dimensions'] as $key) {

            if (array_key_exists($key, $properties)) {

                $statement->bindValue(':' . $key, $properties[$key], PDO::PARAM_STR);

            } else {

                $statement->bindValue(':' . $key, null, PDO::PARAM_NULL);

            }
            
        }

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