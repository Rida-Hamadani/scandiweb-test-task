<?php

namespace model;
use Product;
use service\ProductServices;

class DVD extends Product {

    protected string $size;

    public function __construct(string $sku,
                                string $name, 
                                string $price, 
                                array $properties,
                                ProductServices $services) {

        parent::__construct($sku, $name, $price, $services);
        
        $this->dimensions = $properties["size"];

    }

    protected function getSpecificProperty(): string {

        return "size: " . $this->size . " MB";

    }

    protected function setSpecificProperty($size) {

        $this->size = $size;

    }

}