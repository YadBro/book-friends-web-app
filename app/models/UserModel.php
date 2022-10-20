<?php

class UserModel extends Database
{

  public function getAllUser(): object
  {

    $query = "SELECT id, 'name', age, email, password FROM user";
    $result = $this->query($query);
    return $result;
  }

  public function getUser(string $email, string $password): object
  {
    $email = htmlspecialchars($email);
    $password = htmlspecialchars($password);
    $id_user = $_SESSION['id_user'];
    $query = "SELECT id, name, email FROM user WHERE id='$id_user'";
    $result = $this->query($query);
    return $result;
  }

  public function login(string $email, string $password): object
  {
    $email = htmlspecialchars($email);
    $password = htmlspecialchars($password);

    $query = "SELECT id, name, email, password FROM user WHERE email='$email'";
    $result = $this->query($query);

    return $result;
  }

  public function register(string $name, string $email, string $password): bool
  {
    $name = htmlspecialchars($name);
    $email = htmlspecialchars($email);
    $password = htmlspecialchars($password);

    $password = password_hash($password, PASSWORD_DEFAULT);
    $query = "INSERT INTO user (name, email, password) VALUES ('$name', '$email', '$password')";
    $result = $this->query($query);
    return $result;
  }
}
