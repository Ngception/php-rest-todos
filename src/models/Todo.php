<?php

namespace PhpRestTodos\Models;

class Todo
{
  private $connection;
  private $table;

  public function __construct($connection)
  {
    $this->connection = $connection;
    $this->table = getenv('DBNAME');
  }

  public function get_by_id($id)
  {
    $query = "SELECT * FROM {$this->table} WHERE id = :id LIMIT 0,1";

    $stmt = $this->connection->prepare($query);

    $stmt->execute([
      'id' => $id
    ]);

    $todo = $stmt->fetch();

    return $todo;
  }

  public function get_all()
  {
    $query = "SELECT * FROM {$this->table} ORDER BY id ASC";

    $stmt = $this->connection->prepare($query);

    $stmt->execute();

    $todos = $stmt->fetchAll();

    return $todos;
  }

  public function create($data)
  {
    $allowed_fields = [
      0 => 'body',
      1 => 'status',
      2 => 'assigned'
    ];

    $query = "INSERT INTO {$this->table} (body, status, assigned_to)
    VALUES (:body, :status, :assigned)";

    $stmt = $this->connection->prepare($query);

    $sanitized_data = $this->sanitize_input_data($data);

    if (count($sanitized_data) <= 1) {
      return false;
    }

    $fields_are_valid = $this->validate_input_fields($sanitized_data, $allowed_fields);

    if (!$fields_are_valid) {
      return false;
    }

    if ($stmt->execute($sanitized_data)) {
      return true;
    }

    return false;
  }

  public function update($data)
  {
    $allowed_fields = [
      0 => 'id',
      1 => 'body',
      2 => 'status',
      3 => 'assigned'
    ];

    $body_field = isset($data->body) ? 'body = :body' : '';
    $status_field = isset($data->status) ? 'status = :status' : '';
    $assigned_field = isset($data->assigned) ? 'assigned_to = :assigned' : '';

    $query = "UPDATE {$this->table}
    SET {$body_field} {$status_field} {$assigned_field}
    WHERE id = :id";

    $stmt = $this->connection->prepare($query);

    $sanitized_data = $this->sanitize_input_data($data);

    if (count($sanitized_data) <= 1) {
      return false;
    }

    $fields_are_valid = $this->validate_input_fields($sanitized_data, $allowed_fields);

    if (!$fields_are_valid) {
      return false;
    }

    if ($stmt->execute($sanitized_data)) {
      return true;
    }

    return false;
  }

  public function delete($id)
  {
    $query = "DELETE FROM {$this->table} WHERE id = :id";

    $stmt = $this->connection->prepare($query);

    $sanitized_id = htmlspecialchars(strip_tags($id));

    if ($stmt->execute([
      'id' => $sanitized_id
    ])) {
      return true;
    }

    return false;
  }

  private function sanitize_input_data($input_data)
  {
    $sanitized_data = array();

    foreach ($input_data as $key => $value) {
      $sanitized_data[$key] = htmlspecialchars(strip_tags($value));
    }

    return $sanitized_data;
  }

  private function validate_input_fields($fields, $allowed_fields)
  {
    foreach ($fields as $field => $value) {
      if (!in_array($field, $allowed_fields)) {
        return false;
      }
    }

    return true;
  }
}
