<?php
class FriendModel extends Database
{

  public function getAllFriends(): object
  {
    $id_user = $_SESSION['id_user'];
    $result = $this->query("SELECT friend_name, gender, age FROM friend WHERE id_user in(SELECT id FROM user WHERE id_user='$id_user')");
    return $result;
  }

  public function getAllFriendsByGender(string $gender): object
  {
    $id_user = $_SESSION['id_user'];
    $result = $this->query("SELECT friend_name, gender, age FROM friend WHERE gender='$gender' AND id_user in(SELECT id FROM user WHERE id_user='$id_user')");
    return $result;
  }

  public function addFriend(string $friend_name, int $age, string $gender): bool
  {
    $id_user = $_SESSION['id_user'];
    $friend_name = htmlspecialchars($friend_name);
    $age = (int)htmlspecialchars($age);
    $gender = htmlspecialchars($gender);

    $result = $this->query("INSERT INTO friend (id_user, friend_name, gender, age) VALUES ($id_user, '$friend_name', '$gender', $age)");
    return $result;
  }
}
