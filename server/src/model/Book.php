<?php

namespace model;
use Product;
use service\ProductServices;

class Book extends Product {

    protected string $weight;

    public function __construct(string $sku,
                                string $name, 
                                string $price, 
                                array $properties,
                                ProductServices $services) {

        parent::__construct($sku, $name, $price, $services);
        
        $this->weight = $properties["weight"];

    }

    protected function getSpecificProperty(): string {

        return "weight: " . $this->weight . " KG";

    }

    protected function setSpecificProperty($weight) {

        $this->weight = $weight;

    }

}