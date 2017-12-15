<!-- CONTAINS INFO FOR MAIN USER DASHBOARD-->
<!DOCTYPE html>
<?php   require_once("lib_read_csv.php");
require_once("error.php");
session_start();
$midshipmen = read_csv('users.csv');
if(!isset($_COOKIE['loggedon'])) {
  header('Location: login.php');
}
// read in all relevant files, if somewhere your status (admin vs user)
// does not allow, redirect to login page
?>


<html lang="en">

<head>
  <script type="text/javascript" src="cookie.js"></script>
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
  <link rel="icon" href="https://upload.wikimedia.org/wikipedia/commons/7/78/Navy_Athletics_logo.png">
</head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
  <!-- Navigation-->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <a class="navbar-brand" href="dashboard.php">&#128013;  E-Taps</a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
          <a class="nav-link" href="dashboard.php">
            <i class="fa fa-fw fa-dashboard"></i>
            <span class="nav-link-text">Dashboard</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Weekend List">
          <a class="nav-link" href="weekends.php">
            <i class="fa fa-fw fa-beer"></i>
            <span class="nav-link-text">Weekends</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Tables">
          <a class="nav-link" href="tables.php">
            <i class="fa fa-fw fa-table"></i>
            <span class="nav-link-text">Tracker</span>
          </a>
        </li>

      </ul>
      <ul class="navbar-nav sidenav-toggler">
        <li class="nav-item">
          <a class="nav-link text-center" id="sidenavToggler">
            <i class="fa fa-fw fa-angle-left"></i>
          </a>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto">



        <li class="nav-item">
          <a class="nav-link" data-toggle="modal" data-target="#exampleModal">
            <i class="fa fa-fw fa-sign-out"></i>Logout</a>
          </li>
        </ul>
      </div>
    </nav>
    <div class="content-wrapper">
      <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">

          </li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
        <div class="row">
          <div class="col-12" style='text-align:center; '>

            <h1>Welcome <?php echo "{$midshipmen[$_COOKIE['loggedon']]['First']}"; ?>!</h1>
            <?php
            if($_COOKIE['loggedon'] != 123456){


              echo "
              <body class='bg-dark' >
              <div class='container' style='text-align:center; width:30%' >
              <div class='card card-register mx-auto mt-5'>
              <div class='card-header'>

              ";
              if($midshipmen[$_COOKIE['loggedon']]['Year']== '2019'){
                echo "2/C";
              } else if ($midshipmen[$_COOKIE['loggedon']]['Year']== '2018'){
                echo "1/C";
              } else if ($midshipmen[$_COOKIE['loggedon']]['Year']== '2021'){
                echo "4/C";
              } else if ($midshipmen[$_COOKIE['loggedon']]['Year']== '2020'){
                echo "3/C";
              }

              echo "
              {$midshipmen[$_COOKIE['loggedon']]['Last']}
              </div>
              <div class='card-body'>
              <div class'btn-group'>
              <div class='form-row'>

              <div class='col-md-6'>

              <form method='post' action='?'>
              <input type='hidden' name='signed' value='true' />
              <input class='btn btn-primary' type='submit' name='login' value='Sign Taps' />
              </form>
              </div>
              "
              ;
              echo "
              <div class='col-md-6'>
              <form method='post' action='?'>
              <input type='hidden' name='weekend' value='true' />
              <input class='btn btn-primary' type='submit' name='login' value='Request Weekend' />
              </form>
              </div>
              </div>
              </div>
              </div>
              </div>
              </div>
              </div>
              </div>
              </body>";

            } else {
              echo "
              <body class='bg-dark' >
              <div class='container' style='text-align:center;width:23%;'>
              <div class='card card-register mx-auto mt-5'>
              <div class='card-header'>";


              echo "
              Requests:
              </div>

              ";
              if($_COOKIE['loggedon'] != 123456){
                $date = date('Y-m-d');
                $file =  $date . ".csv";
                $file2 = date('W') . ".csv";
                if(file_exists($file2)){
                  $weekend = read_csv($file2);
                  if(!isset($weekend[$_COOKIE['loggedon']])){
                    // echo "<p>
                    // You have not requested a weekend.
                    // </p>";
                  }else{
                    if($weekend[$_COOKIE['loggedon']]['Approved'] == "yes"){
                      // echo "<p>
                      // Your weekend has been approved.
                      // </p>";
                    }else {
                      // echo "<p>
                      // Your weekend has not been approved.
                      // </p>";
                    }
                  }
                }else{
                  // echo "<p>
                  // You have not requested a weekend.
                  // </p>";
                }
                if(file_exists($file)){
                  $signedTaps = read_csv($file);
                  if(isset($signedTaps[$_COOKIE['loggedon']]['Time']) && $_COOKIE['loggedon'] != 123456){
                    // echo "<p>
                    // You Signed Taps today at {$signedTaps[$_COOKIE['loggedon']]['Time']}
                    // </p>";
                  }else if(file_exists($file2)){
                    $signedTaps = read_csv($file2);
                    if(isset($signedTaps[$_COOKIE['loggedon']]['Weekend'])){
                      // echo "<p>
                      // You Signed Taps at {$signedTaps[$_COOKIE['loggedon']]['Time']}
                      // </p>";
                    }
                    else if ($_COOKIE['loggedon'] != 123456){
                      // echo "<p>
                      // You have not signed Taps
                      // </p>";
                    }
                  }

                }
              } else {
                echo "<br>";

                $date = date('W');
                $file =  $date . ".csv";
                if(file_exists($file))
                $signedTaps = read_csv($file);
                $we=true;
                foreach ($midshipmen as $key => $value) {
                  if(isset($signedTaps[$key]['Approved']) && $signedTaps[$key]['Approved'] == "no"){
                    echo "You have weekends to approve.<br><br>";
                    $we = false;
                    break;
                  }
                }
                if($we){

                  echo "You do not have weekends to approve.<br><br>";
                }

              }
              echo "

              </div>
              </div>
              </body>";
            }
            ?>

            <?php
            if(isset($_POST['signed'])){
              $date = date('Y-m-d');
              $filename = $date . ".csv";
              $time = date('H:i:s');

              if (!file_exists($filename)){
                $fp = fopen($filename, 'a');
                $string = "Alpha,Time\n";
                fwrite($fp, $string);
              }else{
                $fp = fopen($filename, 'a');
              }
              $signedTaps = read_csv($filename);
              if(!isset($signedTaps[$_COOKIE['loggedon']])){
                $string = $_COOKIE['loggedon'] . "," . $time . "\n";
                fwrite($fp, $string);
              }
              fclose($fp);
            }

            if(isset($_POST['weekend'])){
              $date = date('W');
              $filename = $date . ".csv";
              $time = date('H:i:s');

              if (!file_exists($filename)){
                $fp = fopen($filename, 'a');
                $string = "Alpha,Requested,Approved\n";
                fwrite($fp, $string);
              }else{
                $fp = fopen($filename, 'a');
              }
              $signedTaps = read_csv($filename);
              if(!isset($signedTaps[$_COOKIE['loggedon']])){
                $string = $_COOKIE['loggedon'] . "," . "yes" . ",no" . "\n";
                fwrite($fp, $string);
              }
              fclose($fp);
            }




            ?>




            <?php
            if($_COOKIE['loggedon'] != 123456){
              echo "<br>";
              $date = date('Y-m-d');
              $file =  $date . ".csv";
              $file2 = date('W') . ".csv";
              if(file_exists($file2)){
                $weekend = read_csv($file2);
                if(!isset($weekend[$_COOKIE['loggedon']])){
                  echo "<p>
                <center>  <div style = ' width:20%' class='alert alert-success' data-dismiss='alert' aria-label='close'> <a href='#' class='close' data-dismiss='alert' aria-label='close'>×</a> You have not requested a weekend.</div>


                  </p>";
                }else{
                  if($weekend[$_COOKIE['loggedon']]['Approved'] == "yes"){
                    echo "<p>
                    <center>
                    <div style = ' width:20%' class='alert alert-success' data-dismiss='alert' aria-label='close'> <a href='#' class='close' data-dismiss='alert' aria-label='close'>×</a> </strong>Your weekend has been <strong>approved</strong>.</div>
                    </p>";
                  }else {
                    echo "<p>
                    <div style = ' width:20%' class='alert alert-danger' data-dismiss='alert' aria-label='close'> <a href='#' class='close' data-dismiss='alert' aria-label='close'>×</a> </strong>Your weekend has <strong>not</strong> been approved.</div>;

                    </p>";
                  }
                }
              }else{
                echo "<p>
                <div style = ' width:20%' class='alert alert-success' data-dismiss='alert' aria-label='close'> <a href='#' class='close' data-dismiss='alert' aria-label='close'>×</a> You have not requested a weekend.</div>

                </p>";
              }

              if(file_exists($file)){
                $signedTaps = read_csv($file);



                if(isset($signedTaps[$_COOKIE['loggedon']]['Time']) && $_COOKIE['loggedon'] != 123456){
                  echo "<p>
                  <div style = ' width:20%' class='alert alert-info' data-dismiss='alert' aria-label='close'>You Signed Taps today at </strong> {$signedTaps[$_COOKIE['loggedon']]['Time']}</strong>.</div>
                  </center>

                  </p>";
                }else if(file_exists($file2)){
                  $signedTaps = read_csv($file2);
                  if(isset($signedTaps[$_COOKIE['loggedon']]['Weekend'])){
                    echo "<p>
                    You Signed Taps at {$signedTaps[$_COOKIE['loggedon']]['Time']}
                    </p>";
                  }
                  else if ($_COOKIE['loggedon'] != 123456){
                    echo "<p>
                    <div style = ' width:20%' class='alert alert-danger' data-dismiss='alert' aria-label='close'>  You have not signed TAPS.</div>

                    </p>";
                  }
                }

              }
            } else {
              echo "<p>";

              $date = date('W');
              $file =  $date . ".csv";
              if(file_exists($file))
              $signedTaps = read_csv($file);

              $we=true;
              foreach ($midshipmen as $key => $value) {

                if(isset($signedTaps[$key]['Approved']) && $signedTaps[$key]['Approved'] == "no"){

                  //echo "You have weekends to approve";

                  $we = false;
                  break;
                }

              }
              if($we){
                //echo "You do not have weekends to approve.";

              }
              echo "</p>";



            }
            ?>

          </div>
        </div>
      </div>
      <!-- /.container-fluid-->
      <!-- /.content-wrapper-->
      <footer class="sticky-footer">
        <div class="container">
          <div class="text-center">
            <small>Copyright © RoughRiderNet</small>
          </div>
        </div>
      </footer>
      <!-- Scroll to Top Button-->
      <a class="scroll-to-top rounded" href="#page-top">
        <i class="fa fa-angle-up"></i>
      </a>
      <!-- Logout Modal-->
      <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
              <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <?php if($_COOKIE['loggedon'] != 123456){
            echo "<div class='modal-body'>Make sure <strong>you</strong> signed TAPS! &#128013;</div>";
          } else {
            echo "<div class='modal-body'>Remember to enter <strong>all</strong> UA's into MIDS! &#128013;</div>";
          }
            ?>
            <div class="modal-footer">
              <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
              <a href="login.php" class="btn btn-primary" onclick="eraseCookie('loggedon');">Logout</a>
            </div>
          </div>
        </div>
      </div>
      <!-- Bootstrap core JavaScript-->
      <script src="vendor/jquery/jquery.min.js"></script>
      <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
      <!-- Core plugin JavaScript-->
      <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
      <!-- Custom scripts for all pages-->
      <script src="js/sb-admin.min.js"></script>
    </div>
  </body>

  </html>
