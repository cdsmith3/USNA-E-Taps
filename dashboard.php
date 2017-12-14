<!DOCTYPE html>
<?php   require_once("lib_read_csv.php");
        require_once("error.php");
        session_start();
        $midshipmen = read_csv('users.csv');
        if(!isset($_COOKIE['loggedon'])) {
          header('Location: login.php');
        }
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
    <a class="navbar-brand" href="dashboard.php">E-Taps</a>
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
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Charts">
          <a class="nav-link" href="charts.html">
            <i class="fa fa-fw fa-area-chart"></i>
            <span class="nav-link-text">Charts</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Tables">
          <a class="nav-link" href="tables.php">
            <i class="fa fa-fw fa-table"></i>
            <span class="nav-link-text">Tables</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Components">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseComponents" data-parent="#exampleAccordion">
            <i class="fa fa-fw fa-wrench"></i>
            <span class="nav-link-text">Components</span>
          </a>
          <ul class="sidenav-second-level collapse" id="collapseComponents">
            <li>
              <a href="navbar.html">Navbar</a>
            </li>
          </ul>
        </li>

        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Menu Levels">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseMulti" data-parent="#exampleAccordion">
            <i class="fa fa-fw fa-sitemap"></i>
            <span class="nav-link-text">Menu Levels</span>
          </a>
          <ul class="sidenav-second-level collapse" id="collapseMulti">
            <li>
              <a href="#">Second Level Item</a>
            </li>
            <li>
              <a href="#">Second Level Item</a>
            </li>
            <li>
              <a href="#">Second Level Item</a>
            </li>
            <li>
              <a class="nav-link-collapse collapsed" data-toggle="collapse" href="#collapseMulti2">Third Level</a>
              <ul class="sidenav-third-level collapse" id="collapseMulti2">
                <li>
                  <a href="#">Third Level Item</a>
                </li>
                <li>
                  <a href="#">Third Level Item</a>
                </li>
                <li>
                  <a href="#">Third Level Item</a>
                </li>
              </ul>
            </li>
          </ul>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Link">
          <a class="nav-link" href="#">
            <i class="fa fa-fw fa-link"></i>
            <span class="nav-link-text">Link</span>
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
          <form class="form-inline my-2 my-lg-0 mr-lg-2">
            <div class="input-group">
              <input class="form-control" type="text" placeholder="Search for...">
              <span class="input-group-btn">
                <button class="btn btn-primary" type="button">
                  <i class="fa fa-search"></i>
                </button>
              </span>
            </div>
          </form>
        </li>
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
          <a href="dashboard.php">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Welcome</li>
      </ol>
      <div class="row">
        <div class="col-12">

          <h1>Welcome <?php echo "{$midshipmen[$_COOKIE['loggedon']]['First']}"; ?>!</h1>
          <?php
if($_COOKIE['loggedon'] != 111111){
  echo "  <form method='post' action='?'>
      <input type='hidden' name='signed' value='true' />
      <input class='btn btn-primary' type='submit' name='login' value='sign taps' />
    </form>"
    ;
    echo "  <form method='post' action='?'>
        <input type='hidden' name='weekend' value='true' />
        <input class='btn btn-primary' type='submit' name='login' value='Take Weekend' />
      </form>";



      if($midshipmen[$_COOKIE['loggedon']]['Year']== '2019'){
        echo "<br><p>Midshipman 2/C";
      } else if ($midshipmen[$_COOKIE['loggedon']]['Year']== '2018'){
        echo "<br><p>Midshipman 1/C";
      } else if ($midshipmen[$_COOKIE['loggedon']]['Year']== '2021'){
        echo "<br><p>Midshipman 4/C";
      } else if ($midshipmen[$_COOKIE['loggedon']]['Year']== '2020'){
        echo "<br><p>Midshipman 3/C";
      }
       echo "</p>";
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
              $string = "Alpha,Time\n";
              fwrite($fp, $string);
            }else{
              $fp = fopen($filename, 'a');
            }
            $signedTaps = read_csv($filename);
            if(!isset($signedTaps[$_COOKIE['loggedon']])){
            $string = $_COOKIE['loggedon'] . "," . "yes" . "\n";
            fwrite($fp, $string);
          }
            fclose($fp);
          }




          ?>
          <br><p>Your profile info (name, company, rank, class etc)</p>


          <?php
          $date = date('d-m-Y');
          $file =  $date . ".csv";
          if(file_exists($file)){
          $signedTaps = read_csv($file);
          if(isset($signedTaps[$_COOKIE['loggedon']]['Time'])){
          echo "<p>
          You Signed Taps at {$signedTaps[$_COOKIE['loggedon']]['Time']}
          </p>";
        }
        else{
          echo "<p>
          You have not signed Taps
          </p>";
        }
        }


          ?>
          <p>When you signed taps</p>
          <p>.</p>
          <p>This is an example of a blank page that you can use as a starting point for creating new ones.</p>
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
          <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
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