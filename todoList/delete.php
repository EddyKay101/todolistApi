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

// Get content
$content = json_decode(file_get_contents('php://input'));

// Set list to be deleted
$list->id = $content->id;

// Delete the list
if($list->delete()) {
    // 200 deleted
    http_response_code(200);

    // Tell user list was deleted
    echo json_encode(array('message' => 'List was deleted, all items associated with this list was deleted also'));
}

else {
    // 503 service unavailable
    http_response_code(503);

    echo json_encode(array('message' => 'Unable to delete list'));
}
