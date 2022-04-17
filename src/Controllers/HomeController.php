<?php
namespace Api\Controllers;

class HomeController {

    public function index() {
        // send json response
        header('Content-Type: application/json');
        echo json_encode(['message' => 'Hello world!']);
    }

}