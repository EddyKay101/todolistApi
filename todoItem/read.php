<?php
// Required headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=UTF-8');

// Include database and object files
include_once '../config/database.php';
include_once '../objects/todoItem.php';

$database = new Database();
$db = $database->getConnection(); 

// Initialize Object
$item = new Todoitem($db);

$dcl = $item->read(); // dcl means decleration or statement
$num = $dcl->rowCount();

// Check if more than 0 records found
if($num > 0) {
    $item_arr = array();
    $item_arr['records']=array();

    // Retrieve contents
    while ($row = $dcl->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $item_content=array(
            'id' => $id,
            'description' => $description,
            'dueDate' => $dueDate,
            'isCompleted' => $isCompleted,
            'listId' => $listId
        );

        array_push($item_arr['records'], $item_content);
    }

    // Set response
    http_response_code(200);

    // show item content in JSON format
    echo json_encode($item_arr);
}

else {
    // Response not found
    http_response_code(404);

    echo json_encode(
        array('message' => 'List not found.')
    );
}

?>
