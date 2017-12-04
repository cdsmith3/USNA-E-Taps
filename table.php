
<?php

        require_once("error.php");
        session_start();

function read_csv($filename, $withHeaders=True, $withLeftID=True, $withDelimiter=',') {
  if ($fp = fopen($filename, 'r')) {
    $counter = 0;
    while($row = fgetcsv($fp, 0, $withDelimiter)) {
      if (!isset($headers) && !$withHeaders) {
        $headers = array_keys($row);
      }
      if (!isset($headers)) {
        $headers = $row;
      } else {
        foreach ($row as $i => $value) {
          if ($withLeftID) {
            $table[$row[0]][$headers[$i]] = $value;
          } else {
            $table[$counter][$headers[$i]] = $value;
          }
        }
      }
      $counter++;
    }
  }
  return $table;
}


$midshipmen = read_csv('users.csv');
$date = date('d-m-Y');
$file =  $date . ".csv";
$signedTaps = read_csv($file);

ksort($midshipmen);
foreach ($midshipmen as $key => $value) {

if($midshipmen[$key]['Company'] == $_POST['company']){
echo "<tr role='row'>";

$name = $midshipmen[$key]['First'] . " " . $midshipmen[$key]['Last'];
  echo "<td>$name</td>";
  echo "<td>{$midshipmen[$key]['Phone Number']}</td>";
  echo "<td>{$midshipmen[$key]['Year']}</td>";
  if(isset($signedTaps[$key]['Time'])){
  echo "<td style='background-color:green;'>Yes</td>";
  echo "<td>{$signedTaps[$key]['Time']}</td>";
}
  else {
    echo "<td style='background-color:red;'>No</td>";
    echo "<td>N/A</td>";
  }
  echo "</tr>";
}
}


?>
