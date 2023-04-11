<?php

namespace model;

abstract class Product {

    // Products common properties

    private string $sku;
    private string $name;
    private string $price;


    public function __construct(string $sku, 
                                string $name, 
                                string $price) {

        // Cannot use construct property promotion in PHP7

        $this->sku = $sku;
        $this->name = $name;
        $this->price = $price;

    }

    // Getters

    public function getSku(): string {

        return $this->sku;

    }

    public function getName(): string {

        return $this->name;

    }

    public function getPrice(): string {

        return $this->price;

    }

    abstract public function getSpecificProperty(): string;

    // Setters

    public function setSku($sku) {

        $this->sku = $sku;

    }

    public function setName($name) {

        $this->name = $name;

    }

    public function setPrice($price) {

        $this->price = $price;

    }

    abstract public function setSpecificProperty($property);
}