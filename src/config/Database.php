<?php

namespace PhpRestTodos\Config;

use PDO, PDOException;

class Database
{
  private $connection;

  public function __construct()
  {
    $this->host = getenv('HOST');
    $this->dbname = getenv('DBNAME');
    $this->username = getenv('USERNAME');
    $this->password = getenv('PASSWORD');
  }

  public function connect()
  {
    $this->connection = null;

    try {
      $dsn = "mysql:host={$this->host};dbname={$this->dbname}";

      $this->connection = new PDO($dsn, $this->username, $this->password);

      $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $error) {
      echo "Connection error: {$error->getMessage()}";
    }

    return $this->connection;
  }
}
