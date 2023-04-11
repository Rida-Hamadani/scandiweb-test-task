<?php

namespace model;
use model\Product;

class Book extends Product {

    private string $weight;

    public function __construct(array $properties) {

        parent::__construct($properties["sku"], $properties["name"], $properties["price"]);
        
        $this->weight = $properties["weight"];

    }

    public function getSpecificProperty(): string {

        return "Weight: " . $this->weight . " KG";

    }

    public function setSpecificProperty($weight) {

        $this->weight = $weight;

    }

}