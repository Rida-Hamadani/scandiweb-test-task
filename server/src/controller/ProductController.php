<?php

namespace controller;
use service\ProductServices;

class ProductController {

    private ProductServices $services;

    public function __construct(ProductServices $services) {

        $this->services = $services;

    }

    public function processRequest(string $method): void {

        switch($method) {

            case 'GET':

                echo(json_encode($this->services->getAll()));

                break;

            case 'POST':

                $data = $_POST;

                if (isset($data['method']) && $data['method'] === 'DELETE') {

                    $this->deleteProducts($data['products']);

                } else {

                    $errors = $this->getValidationErrors($data);

                    if (!empty($errors)) {
            
                        http_response_code(400);
            
                        echo json_encode(['errors' => $errors]);
            
                        exit();
            
                    }

                    $this->createProduct($data);

                }

                break;

            default:

                http_response_code(405);

                header("Allow: GET, POST");
        }

    }

    private function deleteProducts(array $products): void {

        foreach ($products as $sku) {

            $this->services->delete($sku);

        }

    }

    private function createProduct(array $data): void {

        $productType = "\\model\\" . $data['type'];
        $product = new $productType($data);
        $this->services->create($product);
        echo(json_encode(['messages' => 'success']));
    }

    private function getValidationErrors($data): array {

        $errors = [];

        if (!(isset($data['sku']) && isset($data['name']) && isset($data['price'])) 
            || $data['type'] === 'Type') {

            $errors[] = 'Please, submit required data';

        }

        if (!(isset($data['size'])
            || (isset($data['length']) && isset($data['width']) && isset($data['height'])) 
            || isset($data['weight']))) {
            
            $errors[] = 'Please, submit required data';

            return $errors;

        }

        $numerics = ['price', 'size', 'length', 'width', 'height'];

        foreach ($numerics as $value) {

            if (isset($data[$value]) 
                && !is_numeric($data[$value])) {

                $errors[] = 'Please, provide the data of indicated type';

            }

        }

        if ($this->services->isSkuTaken($data['sku'])) {

            $errors[] = 'Please, provide a unique SKU';

        }

        return $errors;

    }

}