<!DOCTYPE html>
<?php
require_once("lib_read_csv.php");
        require_once("error.php");
        session_start();
?>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>E-Taps</title>
  <!-- Bootstrap core CSS-->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">
  <script type="text/javascript" src="sha256.js"></script>
  <script type="text/javascript" src="cookie.js"></script>
</head>

<body class="bg-dark">

  <div class="container">
    <div class="card card-login mx-auto mt-5">
      <div class="card-header">E-Taps Login</div>
      <div class="card-body">
          <form method="post" action="?">
          <div class="form-group">
            <label for="exampleInputEmail1">Alpha</label>
            <input class="form-control" name="alpha" id="alpha" type="test" aria-describedby="emailHelp" placeholder="Enter alpha">
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input class="form-control" name="password" id="password" type="password" placeholder="Password">
          </div>
          <div class="form-group">
            <div class="form-check">
              <label class="form-check-label">
                <input class="form-check-input" type="checkbox"> Remember Password</label>
              </div>
            </div>
            <input class="btn btn-primary btn-block"  type="submit" name="" value="Login">
          </form>
          <div class="text-center">
            <a class="d-block small mt-3" href="register.php">Register an Account</a>
            <a class="d-block small" href="forgot-password.php">Forgot Password?</a>
          </div>
        </div>
      </div>
    </div>

    <?php

    $CSV = read_csv('users.csv');

    if(isset($_POST['alpha']) && isset($CSV[$_POST['alpha']])){
      if($CSV[$_REQUEST['alpha']]['Password'] == hash('sha256', $_POST['password'])){
        $_SESSION['loggedon'] = $_POST['alpha'];
        setcookie("loggedon", $_POST['alpha'], time()+30*24*60*60, "/");
        header('Location: dashboard.php');
      }

    }
    if(isset( $_COOKIE['loggedon'])){
      header('Location: dashboard.php');

    }

    ?>


    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <pre>
      <?php
      print_r($_SESSION);
      print_r($_COOKIE);
      ?>
    </pre>
  </body>

  </html>
