<?php

use PHPUnit\Framework\TestCase;

include 'config/Database.php';
include 'models/Todo.php';

class TodoTest extends TestCase
{
  public function test_get_by_id()
  {
    $todo_mock = [
      'id' => 'id',
      'body' => 'body',
      'status' => 'status',
      'assigned_to' => 'assigned_to',
      'created_at' => time()
    ];

    $stmt_mock = $this->createMock(PDOStatement::class);
    $stmt_mock->expects($this->once())->method('execute');
    $stmt_mock->expects($this->once())->method('fetch')->willReturn($todo_mock);

    $pdo_mock = $this->createMock(PDO::class);
    $pdo_mock->expects($this->once())->method('prepare')->willReturn($stmt_mock);

    $todo = new Todo($pdo_mock);

    $this->assertEquals($todo->get_by_id(1), $todo_mock);
  }

  public function test_get_all()
  {
    $todos_mock = [
      0 => (object) [
        'id' => 'id',
        'body' => 'body',
        'status' => 'status',
        'assigned_to' => 'assigned_to',
        'created_at' => time()
      ]
    ];

    $stmt_mock = $this->createMock(PDOStatement::class);
    $stmt_mock->expects($this->once())->method('execute');
    $stmt_mock->expects($this->once())->method('fetchAll')->willReturn($todos_mock);

    $pdo_mock = $this->createMock(PDO::class);
    $pdo_mock->expects($this->once())->method('prepare')->willReturn($stmt_mock);

    $todo = new Todo($pdo_mock);

    $this->assertEquals($todo->get_all(), $todos_mock);
  }

  public function test_update()
  {
    $data_mock = [
      'id' => 'id',
      'body' => 'body',
      'status' => 'status',
      'assigned_to' => 'assigned_to'
    ];

    $stmt_mock = $this->createMock(PDOStatement::class);
    $stmt_mock->expects($this->once())->method('execute')->willReturn(true);

    $pdo_mock = $this->createMock(PDO::class);
    $pdo_mock->expects($this->once())->method('prepare')->willReturn($stmt_mock);

    $todo = new Todo($pdo_mock);

    $this->assertTrue($todo->update($data_mock));
  }

  public function test_update_fails()
  {
    $data_mock = [
      'hello' => 'world'
    ];

    $stmt_mock = $this->createMock(PDOStatement::class);
    $stmt_mock->expects($this->never())->method('execute');

    $pdo_mock = $this->createMock(PDO::class);
    $pdo_mock->expects($this->once())->method('prepare')->willReturn($stmt_mock);

    $todo = new Todo($pdo_mock);

    $this->assertNull($todo->update($data_mock));
  }

  public function test_delete()
  {
    $stmt_mock = $this->createMock(PDOStatement::class);
    $stmt_mock->expects($this->once())->method('execute')->willReturn(true);

    $pdo_mock = $this->createMock(PDO::class);
    $pdo_mock->expects($this->once())->method('prepare')->willReturn($stmt_mock);

    $todo = new Todo($pdo_mock);

    $this->assertTrue($todo->delete(1));
  }
}
