<?php

namespace controller;
use core\Database;

class Main {

    private Database $database;
    private array $parts;

    public function __construct(array $parts, Database $database) {
        
        // Cannot use construct property promotion in PHP7

        $this->database = $database;
        $this->parts = $parts;

    }

    public function route() {

        // Send HTTP headers

        header("application/x-www-form-urlencoded; charset=utf-8");
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET, POST");
        header("Access-Control-Allow-Headers: Content-Type");

        // New endpoints can be placed as cases here

        switch($this->parts[1]){

        case 'products':

            $productGateway = new \model\Product($this->database);

            $productController = new \controller\Product($productGateway);

            $productController->processRequest($_SERVER['REQUEST_METHOD']);

            break;

        default:

            http_response_code(404);
            exit;

        }

    }

}