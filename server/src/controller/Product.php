<?php

namespace controller;
use service\ProductServices;

class Product extends ProductServices {

    public function processRequest(string $method): void {

        switch($method) {

            case 'GET':

                echo(json_encode($this->getAll()));

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

            $this->delete($sku);

        }

    }

    private function createProduct(array $properties): void {

        $product = "\\model\\" . $properties['type'];

        $this->gateway->create($properties);

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

        if ($this->gateway->isSkuTaken($data['sku'])) {

            $errors[] = 'Please, provide a unique SKU';

        }

        return $errors;

    }

}