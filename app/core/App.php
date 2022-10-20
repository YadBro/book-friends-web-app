<?php

class App
{
  protected $controller = 'Home';
  protected $method = 'index';
  protected $params = [];

  public function __construct()
  {

    // Controller
    $url = $this->parseUrl();


    if (empty($url) || file_exists('../app/controllers/' . $url[0] . '.php') === false) {
      $this->controller;
    } else if (file_exists('../app/controllers/' . $url[0] . '.php')) {
      $this->controller = $url[0];
      unset($url[0]);
    }

    require_once '../app/controllers/' . $this->controller . '.php';
    $this->controller = ucfirst($this->controller);
    $this->controller = new $this->controller;


    // Method
    if (isset($url[1])) {
      if (method_exists($this->controller, $url[1])) {
        $this->method = $url[1];
        unset($url[1]);
      } else {
        echo '404 Not Found!';
        die();
      }
    }

    // Params
    if (!empty($url)) {
      $this->params = array_values($url);
    }

    // Run controllers and methods with send the params if exist
    call_user_func_array([$this->controller, $this->method], $this->params);
  }

  public function parseUrl()
  {
    if (isset($_GET['url'])) {
      $getUrl = rtrim($_GET['url'], '/');
      $filterUrl = filter_var($getUrl, FILTER_SANITIZE_URL);
      $fetchUrl = explode('/', $filterUrl);
      return $fetchUrl;
    }
  }
}
