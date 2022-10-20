<?php

class Database
{
  protected $conn;
  public function __construct()
  {
    $this->conn = new mysqli($_ENV['DB_HOST'], $_ENV['DB_USERNAME'], $_ENV['DB_PASSWORD'], $_ENV['DB_NAME']);

    if ($this->conn->connect_error) {
      die("Connection failed: " . $this->conn->connect_error);
    }
  }

  public function query(string $query)
  {
    $result = $this->conn->query($query);
    return $result;
  }
}
