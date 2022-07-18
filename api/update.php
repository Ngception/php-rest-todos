<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PATCH');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../config/Database.php';
include_once '../models/Todo.php';

$database = new Database();
$db = $database->connect();

$todo = new Todo($db);

$input_data = json_decode(file_get_contents('php://input'));

if ($todo->update($input_data)) {
  echo json_encode(array(
    'message' => 'Successfully updated todo'
  ));
} else {
  echo json_encode(array(
    'message' => 'Failed to update todo'
  ));
}
