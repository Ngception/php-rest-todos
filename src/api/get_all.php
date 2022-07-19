<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../config/Database.php';
include_once '../models/Todo.php';

$database = new Database();
$db = $database->connect();

$todo = new Todo($db);

$result = $todo->get_all();

$todos = array();

foreach ($result as $todo) {
  extract($todo);

  $formatted_todo = (object) [
    'id' => $id,
    'body' => $body,
    'status' => $status,
    'assigned_to' => $assigned_to,
    'created_at' => $created_at
  ];

  array_push($todos, $formatted_todo);
}

$data = [
  'data' => $todos
];

print_r(json_encode($data));
