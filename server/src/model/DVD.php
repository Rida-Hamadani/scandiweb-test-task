<?php

namespace model;
use model\Product;

class DVD extends Product {

    private string $size;

    public function __construct(array $properties) {

        parent::__construct($properties["sku"], $properties["name"], $properties["price"]);
        
        $this->size = $properties["size"];

    }

    public function getSpecificProperty(): string {

        return "Size: " . $this->size . " MB";

    }

    public function setSpecificProperty($size) {

        $this->size = $size;

    }

}