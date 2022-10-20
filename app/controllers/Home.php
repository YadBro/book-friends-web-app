<?php
session_start();

class Home extends Controller
{
  private $model;
  protected string $email;
  protected string $password;

  public function __construct()
  {
    $this->model = $this->model('UserModel');
  }

  public function index()
  {
    if (isset($_SESSION['login'])) {
      $this->redirect('dashboard');
    }

    $this->view('home/login', [
      'title' => 'Login',
    ]);
  }

  public function register()
  {
    if (isset($_SESSION['login'])) {
      $this->redirect('dashboard');
    }

    $this->view('home/register', [
      'title' => 'Register',
    ]);
  }

  public function process_register()
  {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $data = $this->model->register($name, $email, $password);

    if ($data) {
      $this->redirect('home');
    }
    var_dump('FAILED');
  }

  public function process_login()
  {
    if (isset($_POST['login'])) {
      $this->email = $_POST['email'];
      $this->password = $_POST['password'];
      $data = $this->model->login($this->email, $this->password);

      // if there is data
      if ($data->num_rows === 1) {

        // check password
        $row = mysqli_fetch_assoc($data);
        if (password_verify($this->password, $row['password'])) {
          $_SESSION['login'] = true;
          $_SESSION['id_user'] = $row['id'];
          $_SESSION['name'] = $row['name'];

          return $this->redirect('dashboard');
        } else {
          $this->flash('There was problem with your login, please check again!');
          return $this->redirect('home');
        }
      } else {
        $this->flash('The email is not registered!');
        return $this->redirect('home');
      }
    }
  }
}
