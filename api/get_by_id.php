<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../config/Database.php';
include_once '../models/Todo.php';

$database = new Database();
$db = $database->connect();

$todo = new Todo($db);
$id = isset($_GET['id']) ? $_GET['id'] : die();

$result = $todo->get_by_id($id);
extract($result);

$data = [
  'data' => array(
    '0' => (object)[
      'id' => $id,
      'body' => $body,
      'status' => $status,
      'assigned_to' => $assigned_to,
      'created_at' => $created_at
    ]
  )
];

print_r(json_encode($data));
