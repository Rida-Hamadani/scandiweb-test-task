<?php

namespace model;
use Product;
use service\ProductServices;

class Furniture extends Product {

    protected string $dimensions;

    public function __construct(string $sku,
                                string $name, 
                                string $price, 
                                array $properties,
                                ProductServices $services) {

        parent::__construct($sku, $name, $price, $services);
        
        $this->dimensions = $properties["dimensions"];

    }

    protected function getSpecificProperty(): string {

        return "dimensions: " . $this->dimensions;

    }

    protected function setSpecificProperty($dimensions) {

        $this->dimensions = $dimensions;

    }

}