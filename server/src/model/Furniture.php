<?php

namespace model;
use model\Product;

class Furniture extends Product {

    private string $dimensions;

    public function __construct(array $properties) {

        parent::__construct($properties["sku"], $properties["name"], $properties["price"]);
        
        $this->dimensions = $properties["height"] . 'x' . $properties["length"] . 'x' . $properties["width"];

    }

    public function getSpecificProperty(): string {

        return "Dimensions: " . $this->dimensions;

    }

    public function setSpecificProperty($dimensions) {

        $this->dimensions = $dimensions;

    }

}