<?php
// Require headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=UTF-8');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Max-Age: 3600');
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With');

include_once '../config/database.php';
include_once '../objects/todoList.php';

$database = new Database();
$db = $database->getConnection();

$list = new Todolist($db);

// Get posted content
$content = json_decode(file_get_contents('php://input'));

$list->id = $content->id;

// Set values
$list->name = $content->name;

// Update list
if($list->update()) {
    // 201 created
    http_response_code(201);

    // Tell user list was updated
    echo json_encode(array('message' => 'List was updated'));
}

else {
    // 503 service unavailable
    http_response_code(503);

    echo json_encode(array('message' => 'Unable to update list'));
}