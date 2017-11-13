<!DOCTYPE html>
<?php
  //
  // require_once("error.inc.php");

?>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>SB Admin - Start Bootstrap Template</title>
  <!-- Bootstrap core CSS-->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">
</head>

<body class="bg-dark">
  <div class="container">
    <div class="card card-register mx-auto mt-5">
      <div class="card-header">Register an Account</div>
      <div class="card-body">
        <form method="POST" action="?" onsubmit="return check()">
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <label for="exampleInputName">First name</label>
                <input name="firstname" class="form-control" id="firstname" type="text" aria-describedby="nameHelp" placeholder="Enter first name">
              </div>
              <div class="col-md-6">
                <label for="exampleInputLastName">Last name</label>
                <input name = "lastname" class="form-control" id="lastname" type="text" aria-describedby="nameHelp" placeholder="Enter last name">
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Alpha</label>
            <input name = "alpha" class="form-control" id="alpha" type="text" aria-describedby="emailHelp" placeholder="Enter alpha">
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <label for="exampleInputPassword1">Password</label>
                <input name="password" class="form-control" id="password" type="password" placeholder="Password">
              </div>
              <div class="col-md-6">
                <label for="exampleConfirmPassword">Confirm password</label>
                <input name="passconf" class="form-control" id="passwordconf" type="password" placeholder="Confirm password">
              </div>
            </div>
          </div>
          <p id="wrong" class="danger">

          </p>
          <input type="submit" class="btn btn-primary btn-block">
        </form>

        <script>
        var first = document.getElementById('firstname');
        var last = document.getElementById('lastname');
        var alpha = document.getElementById('alpha');
        var pass = document.getElementById('password');
        var conf = document.getElementById('passwordconf');
        // Used from W3Resource, checks if letter
        var letters = /^[A-Za-z]+$/;
          function check() {

            // Checks if anything was actually entered on submit
            if(first.value == "" || last.value == "" || alpha.value == "" || pass.value == "" || conf.value == "") {
              document.getElementById('wrong').innerHTML = "Please Enter all fields."
              return false;
            }
          }

          function valid(x) {
            if(!x.innerHTML.match(letters)) {
              x.innerHTML = "";
            }
          }

          first.onkeyup = valid(first);
          last.onkeyup = valid(last);
          alpha.onkeyup = function validA() {
            if(!alpha.innerHTML.match(/^[0-9]+$/)) {
              alpha.innterHTML = "";
            }
          }
          password.onchange = function veritas() {
            if(password.innerHTML.length < 8) {
              // Temporary alert
              alert("Please use a longer password");
            }
          }
          passwordconf.onchange = function verify() {
            if(passwordconf.innerHTML != password.innerHTML) {
              // Temporary alert
              passwordconf.innerHTML = "";
              alert("Passwords do not match!");

            }
          }
        </script>
        <?php

$firstname = $_POST["firstname"];
$lastname = $_POST["lastname"];
$alpha = $_POST["alpha"];
$password = $_POST["password"];
$passconf = $_POST["passconf"];

// Use to read csv file of info
function read_csv($filename, $header = True, $left_index = True) {
  if($fp = fopen($filename, 'r')) {
    while($row = fgetcsv($fp)) {
      if(!isset($headers)) {
        $headers = $row;
      } else {
        // Want to store as $data['O-4']['8']
        // Reference rows first
        foreach($row as $key=> $value) {
          $data[$row[0]][$headers[$key]] = $value;
        }
      }
    }

  }
  return $data;
}
$userfile = 'user.txt';
if(isset($_POST["firstname"]) && isset($_POST["lastname"]) && isset($_POST["alpha"])
  && isset($_POST["password"]) && isset($_POST["passconf"])) {
  $fp = fopen($userfile, 'a');
}
// if($_POST["alpha"] != "") {
//   if($alpha ) {
//
//   }
// }





// if(!$fp =fopen('loginfo.csv', 'a')){
//   echo "This was false first";
// }
// $savestring = $firstname . '|' . $lastname . '|' . $alpha  . '|' . $email . '|' . $password . "\n";
// if(!$fp = fwrite($fp, $savestring)){
//   echo "we failed";
// }
// fclose($fp);

?>
        <div class="text-center">
          <a class="d-block small mt-3" href="login.html">Login Page</a>
          <a class="d-block small" href="forgot-password.php">Forgot Password?</a>
        </div>
      </div>
    </div>
  </div>
  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
</body>

</html>
