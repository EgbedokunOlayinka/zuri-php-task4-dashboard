<?php
    require('./config/constants.php');
    require('./config/db.php');

  session_start();
  $output = '';

  if (isset($_GET['logout'])) {
    session_unset();
    session_destroy();
    header('Location: login.php'); 
  };

  if(isset($_SESSION['email'])) {
    $output = <<<'EOD'
    <li class="nav-item">
    <a class="nav-link" href="login.php?logout=true">Logout</a>
    </li>
    EOD;
  } else {
    $output = <<<'EOD'
    <li class="nav-item">
    <a class="nav-link" href="register.php">Register</a>
    </li>
    <li class="nav-item">
    <a class="nav-link" href="login.php">Login</a>
    </li>
    <li class="nav-item">
    <a class="nav-link" href="forgotpassword.php">Forgot Password</a>
    </li>
    EOD;
  };
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {font-family: 'Poppins', sans-serif;}
        .box {width: 100%; max-width: 500px;}
    </style>
    <title>My Website</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container py-3">
    <a class="navbar-brand" href="#">My Website</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <?php echo $output; ?>
      </ul>
    </div>
  </div>
</nav>