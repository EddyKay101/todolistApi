<?php
// Required headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=UTF-8');

// Include database and object files
include_once '../config/database.php';
include_once '../objects/todoList.php';

$database = new Database();
$db = $database->getConnection(); // use this method of the database class to get the database connection and pass it to the Todolist class

// Initialize Object
$list = new Todolist($db);

$dcl = $list->read(); // dcl means decleration or statement
$num = $dcl->rowCount();

// Check if more than 0 records found
if($num > 0) {
    $list_arr = array();
    $list_arr['records']=array();

    // Retrieve contents
    while ($row = $dcl->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $list_content=array(
            'id' => $id,
            'name' => $name
        );

        array_push($list_arr['records'], $list_content);
    }

    // Set response
    http_response_code(200);

    // show list content in JSON format
    echo json_encode($list_arr);
}

else {
    // Response not found
    http_response_code(404);

    echo json_encode(
        array('message' => 'List not found.')
    );
}

?>
