<?php
// Require headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=UTF-8');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Max-Age: 3600');
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With');

include_once '../config/database.php';
include_once '../objects/todoItem.php';

$database = new Database();
$db = $database->getConnection();

$item = new Todoitem($db);

// Get posted content
$content = json_decode(file_get_contents('php://input'));

if(!empty($content->description) && !empty($content->isCompleted) && !empty($content->listId)) {
    // Set item values
    $item->description = $content->description;
    $item->dueDate = date('Y-m-d H:i:s');
    $item->isCompleted = $content->isCompleted;
    $item->listId = $content->listId;


    // Insert new item
    if($item->insert()) {
        // 201 created
        http_response_code(201);

        // Tell user item was inserted
        echo json_encode(array('message' => 'item was inserted'));
    }

    else {
        // 503 service unavailable
        http_response_code(503);

        echo json_encode(array('message' => 'Unable to insert item'));
    }
}

else {
    http_response_code(400);

    echo json_encode(array('message' => 'Unable to insert item. Data is incomplete'));
}

?>