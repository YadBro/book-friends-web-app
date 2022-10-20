<?php
session_start();

class Dashboard extends Controller
{
  private $model;
  protected string $email;
  protected string $password;

  public function __construct()
  {
    $this->model = $this->model('FriendModel');
  }

  public function index(): void
  {
    if (!isset($_SESSION['login'])) {
      $this->redirect('home');
    }


    $genderMale = $this->model->getAllFriendsByGender('male');
    $genderFemale = $this->model->getAllFriendsByGender('female');

    $genderMaleUnder19 = 0;
    $genderMaleAbove20 = 0;

    if ($genderMale->num_rows > 0) {
      while ($row = $genderMale->fetch_assoc()) {
        if ($row['age'] >= 20 && $row['gender'] === 'male') {
          $genderMaleAbove20 += 1;
        } else if ($row['age'] <= 19 && $row['gender'] === 'male') {
          $genderMaleUnder19 += 1;
        }
      }
    }

    $genderFemaleUnder19 = 0;
    $genderFemaleAbove20 = 0;

    if ($genderFemale->num_rows > 0) {
      while ($row = $genderFemale->fetch_assoc()) {
        if ($row['age'] >= 20 && $row['gender'] === 'female') {
          $genderFemaleAbove20 += 1;
        } else if ($row['age'] <= 19 && $row['gender'] === 'female') {
          $genderFemaleUnder19 += 1;
        }
      }
    }
    $data = [];
    if ($this->model->getAllFriends()->num_rows) {
      foreach ($this->model->getAllFriends()->fetch_assoc() as $row) {
        array_push($data, $row);
      }
    }

    // var_dump($this->model->getAllFriends()->fetch_assoc());


    $this->view('layouts/navbar', [
      'title' => 'dashboard',
      'name' => $_SESSION['name'],
    ]);
    $this->view('dashboard/index', [
      'friends' => $this->model->getAllFriends(),
      'friends2' => $data,
      'friendsMaleGender' => $genderMale,
      'friendsFemaleGender' => $genderFemale,
      'countMaleUnder19' => $genderMaleUnder19,
      'countMaleAbove20' => $genderMaleAbove20,
      'countFemaleUnder19' => $genderFemaleUnder19,
      'countFemaleAbove20' => $genderFemaleAbove20,
    ]);
    $this->view('layouts/footer');
  }

  public function add_friend(): void
  {
    if (!isset($_SESSION['login'])) {
      $this->redirect('home');
    }

    $this->view('layouts/navbar', [
      'title' => 'add friend',
      'name' => $_SESSION['name'],
    ]);
    $this->view('dashboard/add_friend');
    $this->view('layouts/footer');
  }

  public function process_add()
  {
    if (!isset($_POST['gender'])) {
      $this->flash('Please add gender first!');
      $this->redirect('dashboard/add_friend');
    }
    $friend_name = $_POST['friend_name'];
    $gender = $_POST['gender'];
    $age = (int)$_POST['age'];


    $result = $this->model->addFriend($friend_name, $age, $gender);
    if ($result) {
      $this->flash('Success add new friend');
      $this->redirect('dashboard/add_friend');
    }
  }

  public function process_logout()
  {
    $_SESSION = [];
    session_unset();
    session_destroy();

    $this->redirect('home');
  }
}
