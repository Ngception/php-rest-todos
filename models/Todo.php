<?php

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

  public function update($data)
  {
    $allowed_fields = [
      0 => 'id',
      1 => 'body',
      2 => 'status',
      3 => 'assigned_to'
    ];

    $valid_data = false;

    $query = "UPDATE {$this->table} SET status = :status WHERE id = :id";

    $stmt = $this->connection->prepare($query);

    $fields = array();

    foreach ($data as $key => $value) {
      if (!in_array($key, $allowed_fields)) {
        $valid_data = false;
        return;
      }

      $fields[$key] = htmlspecialchars(strip_tags($value));

      $valid_data = true;
    }

    if (!$valid_data) {
      return false;
    }

    if ($stmt->execute($fields)) {
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
}
