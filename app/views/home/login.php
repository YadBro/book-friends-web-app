<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Book Icon are credits from https://www.vecteezy.com/vector-art/3226980-note-book-with-pencil-icon-cartoon-illustration -->
  <link rel="icon" type="image/x-icon" href="<?= BASE_URL; ?>icons/book.ico">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="<?= BASE_URL; ?>bootstrap_5/css/bootstrap.min.css" crossorigin="anonymous">
  <link rel="stylesheet" href="<?= BASE_URL; ?>css/style.css" crossorigin="anonymous">
  <title><?= $data['title']; ?> | Book Friends</title>
</head>

<body>
  <section id="login">
    <div class="d-flex justify-content-end flex-column align-items-center">
      <div class="mt-3 d-flex justify-content-center">
        <img style="width: 60%;" src="<?= BASE_URL; ?>image/book.png" alt="Book">
      </div>
      <h1>LOGIN</h1>
      <!-- FORM -->
      <form action="<?= BASE_URL; ?>home/process_login" method="post" class="w-100 mt-3" style="max-width: 500px;" autocomplete="off">
        <div class="mb-3">
          <label for="email" class="form-label">Email</label>
          <input type="email" class="form-control" name="email" id="email" placeholder="test@gmail.com">
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <input type="password" class="form-control" name="password" id="password">
        </div>
        <button type="submit" class="btn btn-primary w-100" name="login">Login</button>
      </form>
      <p class=" mt-3">Don't have an account? Click <a href="<?= BASE_URL; ?>home/register">here</a></p>

      <script src="<?= BASE_URL; ?>bootstrap_5/js/bootstrap.min.js" crossorigin="anonymous"></script>
    </div>
  </section>

  <footer class="footer" style="bottom:0;">
    <p>Created by Yadi Apriyadi. &copy; 2022 -<?= date('Y'); ?></p>
  </footer>
</body>

</html>