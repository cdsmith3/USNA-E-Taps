<!DOCTYPE html>
<?php   require_once("lib_read_csv.php");
        require_once("error.php");
        session_start();
        $midshipmen = read_csv('users.csv');
        if(!isset($_COOKIE['loggedon'])) {
          header('Location: login.php');
        }
        $a = $_COOKIE['loggedon'];
if($midshipmen[$a]['Admin'] == 'no'){
  header('Location: dashboard.php');
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
  <!-- Page level plugin CSS-->
  <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">
  <link rel="icon" href="https://upload.wikimedia.org/wikipedia/commons/7/78/Navy_Athletics_logo.png">

  <script type="text/javascript">
  function goForm(formElement) {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
       document.getElementById("demo").innerHTML = xhttp.responseText;
    }
  };
  xhttp.open(formElement.method, formElement.action, true);
  xhttp.send(new FormData (formElement));
  return false;
}

function appWeekend(alpha){

  document.getElementById("user").value = alpha;
  document.getElementById("myform").submit();
}

  </script>
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
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Weekends">
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
          <a href="#">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Weekends</li>
      </ol>

      <!-- Example DataTables Card-->
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> TAPS Tracker</div>
          <div class="col-sm-1 col-md-1">


          <?php
          $CSV = read_csv('users.csv');


          require_once("error.php");
          ?>
</div>
        <div class="card-body">


          <div class="table-responsive">
<?php
function write_csv($filename, $data=array(), $withHeaders=True, $withLeftID=True, $leftID='', $withDelimiter=',') {
    if ($fp = fopen($filename, 'w+')) {
      $headers = array_keys($data[array_keys($data)[0]]);
      if ($withHeaders) {
        if ($withLeftID && $leftID != '') {
          $headers = array_diff($headers, array($leftID));
          array_unshift($headers, $leftID);
        }
        fputcsv($fp, $headers, $withDelimiter);
      }
      foreach ($data as $i => $row) {
        $line = array();
        foreach ($headers as $key) {
          $line[] = $row[$key];
        }
        fputcsv($fp, $line, $withDelimiter);
      }
      fclose($fp);
      return True;
    } else {
      return False;
    }
  }

$date = date('W');
$file =  $date . ".csv";
if(file_exists($file))
$signedTaps = read_csv($file);


if(isset($_POST['approved'])){
  $signedTaps[$_POST['approved']]['Approved'] = "yes";
  write_csv($file,$signedTaps);
  unset($_POST['approved']);
}
?>
            <table class="table table-bordered dataTable" id="dataTable" style="width: 100%;" cellspacing="0" role="grid" aria-describedby="dataTable_info" >
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Alpha</th>
                  <th>Phone Number</th>
                  <th>Year</th>
                  <th>Company</th>
                  <th>Approved</th>
                </tr>
              </thead>

              <tbody>
<?php



ksort($midshipmen);
foreach ($midshipmen as $key => $value) {
  if($midshipmen[$key]['Admin'] == 'no'){
echo "<tr role='row'>";
$name = $midshipmen[$key]['First'] . " " . $midshipmen[$key]['Last'];
if(isset($signedTaps[$key]['Requested'])){
$company = $midshipmen[$key]['Company'] . "<sup>th</sup>";
  echo "<td>$name</td>";
  echo "<td >$key</td>";
  echo "<td>{$midshipmen[$key]['Phone Number']}</td>";
  echo "<td>{$midshipmen[$key]['Year']}</td>";
  echo "<td>$company</td>";

  if(isset($signedTaps[$key]['Approved']) && $signedTaps[$key]['Approved'] == "yes"){
  echo "<td onclick='appWeekend($key);' style='background-color:green;'>Yes</td>";
}
  else {
    echo "<td onclick='appWeekend($key);' style='background-color:red;'>No</td>";
  }
  echo "</tr>";
}
}
}
?>

              </tbody>
            </table>
          </div>
        </div>

      </div>
    </div>
    <script type="text/javascript">
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
           document.getElementById("demo").innerHTML = xhttp.responseText;
        }
    };
    xhttp.open("GET", "docs/xmlhttprequest.php", true);
    xhttp.send();

    </script>
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
    <!-- Page level plugin JavaScript-->
    <script src="vendor/datatables/jquery.dataTables.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin.min.js"></script>
    <!-- Custom scripts for this page-->
    <script src="js/sb-admin-datatables.min.js"></script>
  </div>
  <form method='post' action='?' id="myform">
      <input id="user" type='hidden' name='approved' />
    </form>"
</body>

</html>
/
