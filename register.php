  <!DOCTYPE html>
  <?php
  require_once("lib_read_csv.php");
  require_once("error.php");
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
    <link rel="icon" href="https://upload.wikimedia.org/wikipedia/commons/7/78/Navy_Athletics_logo.png">

    <script type="text/javascript" src="sha256.js"></script>
  </head>

  <body class="bg-dark">
    <div class="container">
      <div class="card card-register mx-auto mt-5">
        <div class="card-header">Register an Account</div>
        <div class="card-body">
          <form method="post" action="?" onsubmit="return check()">
            <div class="form-group">
              <div class="form-row">
                <div class="col-md-6">
                  <label for="exampleInputName">First name</label>
                  <input name="firstname" class="form-control" id="firstname" type="text" aria-describedby="nameHelp" placeholder="Enter first name">
                  <span class="text-danger" id="firstError">

                  </span>
                </div>
                <div class="col-md-6">
                  <label for="exampleInputLastName">Last name</label>
                  <input name = "lastname" class="form-control" id="lastname" type="text" aria-describedby="nameHelp" placeholder="Enter last name">
                  <span class="text-danger" id="lastError">

                  </span>
                </div>
              </div>
            </div>

            <div class="form-group">
              <div class="form-row">
                <div class="col-md-6">
                  <label for="exampleInputEmail1">Alpha</label>
                  <input name = "alpha" class="form-control" id="alpha" type="text" aria-describedby="emailHelp" placeholder="Enter alpha">

                  <span class="text-danger" id="alphaError">

                  </span>

                </div>
                <div class="col-md-6">
                  <label for="exampleInputEmail1">Phone Number</label>
                  <input name = "phone" class="form-control" id="phone" type="text" aria-describedby="emailHelp" placeholder="Enter phone number">

                  <span class="text-danger" id="phoneError">

                  </span>

                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="form-row">
                <div class="col-md-6">
                  <label for="exampleInputEmail1">Company</label>
                  <input name = "company" class="form-control" id="company" type="text" aria-describedby="emailHelp" placeholder="Enter company">
                </div>
                <div class="col-md-6">
                  <label for="exampleInputEmail1">Class Year</label>
                  <input name = "year" class="form-control" id="year" type="text" aria-describedby="emailHelp" placeholder="Enter Class Year">
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="form-row">
                <div class="col-md-6">
                  <label for="exampleInputPassword1">Password</label>
                  <input name="password" class="form-control" id="password" type="password" placeholder="Password">

                  <p id="passError" class="text-danger">

                  </p>

                </div>
                <div class="col-md-6">
                  <label for="exampleConfirmPassword">Confirm password</label>
                  <input name="passwordconf" class="form-control" id="passwordconf" type="password" placeholder="Confirm password">
                  <div>
                    <p id="passconfError" class="text-danger">

                    </p>
                  </div>
                </div>
              </div>
            </div>
            <p id="wrong">

          </p>

            <input type="submit" class="btn btn-primary btn-block" name="" value="Register">
          </form>

          <script>
          var first = document.getElementById('firstname');
          var last = document.getElementById('lastname');
          var alpha = document.getElementById('alpha');
          var password = document.getElementById('password');
          var passwordconf = document.getElementById('passwordconf');
          var phone = document.getElementById('phone');
          // Used from W3Resource, checks if letter
          var letters = /^[A-Za-z]+$/;
          function check() {

            // Checks if anything was actually entered on submit
            if(first.value == "" || last.value == "" || alpha.value == "" || password.value == "" || passwordconf.value == "" || password.value.length < 8 || passwordconf.value != password.value || !alpha.value.match(/^[0-9]+$/)) {
              document.getElementById('wrong').innerHTML = "<div class='alert alert-danger' data-dismiss='alert' aria-label='close'> <a href='#' class='close' data-dismiss='alert' aria-label='close'>×</a> <strong>Danger!</strong> This alert box could indicate a dangerous or potentially negative action.</div> ";
              return false;
            }else{
              return true;
            }
          }

          // function valid(x) {
          //   if(!isNaN(x.value)) {
          //     x.value = "";
          //   }
          // }

          //
          //last.onkeyup = valid(last);
          first.onkeyup = function validf() {
            var matches = first.value.match(/\d+/g);
            if (matches != null) {
              document.getElementById('firstError').innerHTML = "Letters only!";
            }
            else{
              document.getElementById('firstError').innerHTML = "";
            }
          }
          alpha.onkeyup = function validA() {
            if(!alpha.value.match(/^[0-9]+$/)) {

              document.getElementById('alphaError').innerHTML = "Numbers only!";
            }
            else{
              document.getElementById('alphaError').innerHTML = "";
            }
          }
          alpha.onchange = function length(){
            if(alpha.value.length != 6){

              document.getElementById('alphaError').innerHTML = "Enter 6 digits!";
            }else {
              document.getElementById('alphaError').innerHTML = "";
            }
          }
          password.onchange = function veritas() {
            if(password.value.length < 8) {
              document.getElementById('passError').innerHTML = "Password must be 8 characters or greater!";
            }else{
              document.getElementById('passError').innerHTML = "";
            }
          }
          passwordconf.onchange = function verify() {
            if(passwordconf.value != password.value) {
              document.getElementById('passconfError').innerHTML = "Passwords not the same!";
            }else{
              document.getElementById('passconfError').innerHTML = "";
            }
          }
          </script>
          <?php


          if(isset($_POST["firstname"]) && isset($_POST["lastname"]) && isset($_POST["alpha"])
          && isset($_POST["password"]) && isset($_POST["passwordconf"]) && isset($_POST['company']) && isset($_POST['phone'])) {

            $fp2 = fopen('users.csv', 'a');
            $savestring =  $_POST['alpha'] . ',' . $_POST['firstname'] . ',' . $_POST['lastname'] . ',' . $_POST['company'] . ',' . $_POST['year'] . ','  . hash("sha256", $_POST['password']) . ','  . $_POST['phone'] . ",no" . "\n";


            fwrite($fp2, $savestring);
            fclose($fp2);
          }

          ?>
          <div class="text-center">
            <a class="d-block small mt-3" href="login.php">Login Page</a>

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
