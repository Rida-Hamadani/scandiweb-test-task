<?php

namespace model;
use service\ProductServices;

abstract class Product extends ProductServices {

    // Products common properties

    protected string $sku;
    protected string $name;
    protected string $price;
    protected ProductServices $services;

    public function __construct(string $sku, 
                                string $name, 
                                string $price, 
                                ProductServices $services) {

        // Cannot use construct property promotion in PHP7

        $this->sku = $sku;
        $this->name = $name;
        $this->price = $price;
        $this->gateway = $gateway;

    }

    // Getters

    protected function getSku(): string {

        return $this->sku;

    }

    protected function getName(): string {

        return $this->name;

    }

    protected function getPrice(): string {

        return $this->price;

    }

    abstract protected function getSpecificProperty(): string;

    // Setters

    protected function setSku($sku) {

        $this->sku = $sku;

    }

    protected function setName($name) {

        $this->name = $name;

    }

    protected function setPrice($price) {

        $this->price = $price;

    }

    abstract protected function setSpecificProperty($property);

    public function save(): string {

        return $this->services->save(

            $this->getSku(),
            $this->getName(),
            $this->getPrice(),
            $this->getSpecificProperty()

        );

    }

    public function delete(): int {

        return $this->services->delete($this->getSku());

    }

}