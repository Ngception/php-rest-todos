<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Method: DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

require_once '../config/Database.php';
require_once '../models/Todo.php';

$database = new Database();
$db = $database->connect();

$todo = new Todo($db);

$data = json_decode(file_get_contents('php://input'));

if ($todo->delete($data->id)) {
  print_r(json_encode(array(
    'message' => 'Successfully deleted todo'
  )));
} else {
  print_r(json_encode(array(
    'message' => 'Failed to delete todo'
  )));
}
