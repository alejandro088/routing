<?php
namespace Api\Controllers;

class UsersController {

    public function index() {
        // send json response
        header('Content-Type: application/json');
        echo json_encode(['message' => 'Hello users!']);
    }

    public function show($id) {
        // send json response
        header('Content-Type: application/json');
        echo json_encode(['message' => 'Hello user #' . $id]);
    }

    public function edit($id) {
        // send json response
        header('Content-Type: application/json');
        echo json_encode(['message' => 'Hello user #' . $id . ' to edit']);
    }

}