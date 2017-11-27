<?php

  // This function reads in a CSV, Comma Seperated file, and returns a
  // 2D array indexed like, $table[ROW_ID][COLUMN_ID] = CELL_VALUE
  // Inputs:
  //   $filename = 'test.csv' // specific file
  //   $withHeaders = True    // Is their a header row
  //   $withLeftID = True     // Can a row be determined by the leftmost column
  //   $withDelimiter = ','   // What is the default delimiter
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

 ?>
