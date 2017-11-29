<!DOCTYPE html>
<?php   require_once("lib_read_csv.php");
        require_once("error.php");
        function getRealIpAddr()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
    {
      $ip=$_SERVER['HTTP_CLIENT_IP'];
    }
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
    {
      $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    else
    {
      $ip=$_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}
$ip = getRealIpAddr();
echo "$ip";
        if(isset($_COOKIE['loggedon'])){
          header('Location: index.php');
        }

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
  <script type="text/javascript">
  var user = "";
  <?php if(isset($_COOKIE['loggedon'])){
    echo "user = getCookie('loggedon');";
  }
  ?>
  </script>
  <div class="container">
    <div class="card card-login mx-auto mt-5">
      <div class="card-header">E-Taps Login</div>
      <div class="card-body">
          <form method="post" action="?" onsubmit="compute();">
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
            <input class="btn btn-primary btn-block" type="submit" name="" value="Login">
          </form>
          <div class="text-center">
            <a class="d-block small mt-3" href="register.php">Register an Account</a>
            <a class="d-block small" href="forgot-password.php">Forgot Password?</a>
          </div>
        </div>
      </div>
    </div>

    <?php
    session_start();
    $CSV = read_csv('users.csv');
    if(isset($_POST['alpha']) && isset($CSV[$_POST['alpha']])){

      $results = hash('sha256', $CSV[$_REQUEST['alpha']]['Password'].$_SESSION['nonce']);
      if($results == $_POST['password']){
        echo "<script type='text/javascript'>setCookie('loggedon',{$_POST['alpha']},90)</script>";

      }

    }

    $_SESSION['nonce'] = base64_encode(bin2hex(openssl_random_pseudo_bytes(16)));

    ?>

    <script type="text/javascript">
    var nonce = <?php echo json_encode($_SESSION['nonce']); ?>;
    function compute() {
    var enteredPassword = Sha256.hash(document.getElementById('password').value);
    var results = Sha256.hash(enteredPassword+nonce);
    document.getElementById('password').value = results;
    }
    </script>
    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <pre>
      <?php
      print_r($CSV);
      print_r($_SESSION);
      print_r($_POST);
      print_r($_COOKIE);
      ?>
    </pre>
  </body>

  </html>
