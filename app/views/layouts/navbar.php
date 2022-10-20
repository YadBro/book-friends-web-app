<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/x-icon" href="<?= BASE_URL; ?>icons/book.ico">

  <!-- BOOTSTRAP CSS -->
  <link rel="stylesheet" href="<?= BASE_URL; ?>bootstrap_5/css/bootstrap.min.css" crossorigin="anonymous">

  <!-- FONT AWESOME -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="<?= BASE_URL; ?>css/style.css">
  <title><?= $data['title']; ?></title>
</head>

<body>

  <div class="d-flex" id="wrapper">

    <!-- SIDEBAR <start> -->
    <?php include "sidebar.php" ?>
    <!-- SIDEBAR <end> -->

    <div id="page-content-wrapper">
      <nav class="navbar navbar-expand-lg navbar-light bg-transparent py-4 px-4">
        <div class="d-flex align-items-center">
          <i class="fas fa-align-left primary-text fs-4 me-3" id="menu-toggle"></i>
          <h2 class="fs-2 m-0">Dashboard</h2>
        </div>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle second-text fw-bold" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fas fa-user me-2"></i><?= $data['name']; ?>
              </a>
              <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <!-- <li><a class="dropdown-item" href="#">Profile</a></li> -->
                <li><a class="dropdown-item" href="<?= BASE_URL; ?>dashboard/process_logout">Logout</a></li>
              </ul>
            </li>
          </ul>
        </div>
      </nav>