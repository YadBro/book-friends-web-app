<?php

class Controller
{
  public function view(string $view, array $data = [])
  {

    require_once '../app/views/' . $view . '.php';
  }

  public function model(string $modelName)
  {
    require_once '../app/models/' . $modelName . '.php';
    return new $modelName;
  }

  public function redirect(string $path)
  {
    echo "<script>window.location.href='" . BASE_URL . "$path';</script>";
    exit;
  }

  public function flash(string $message)
  {
    echo "<script>alert('$message');</script>";
    sleep(2);
  }
}
