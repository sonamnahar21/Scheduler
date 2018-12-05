<?php
include_once('./connection.php');
if($_SERVER['REQUEST_METHOD'] == 'POST'){
      $filename = "data_export_".date('Ymd') . ".xls";
      header("Content-Type: application/vnd.ms-excel");
      header("Content-Disposition: attachment; filename=\"$filename\"");

      $sql_query = "SELECT * FROM availability";
      $resultset = mysqli_query($conn, $sql_query) or die("database error:". mysqli_error($conn));
      $developer_records = array();
      while( $rows = mysqli_fetch_assoc($resultset) ) {
      $developer_records[] = $rows;
      }
      $show_coloumn = false;
      if(!empty($developer_records)) {
        foreach($developer_records as $record) {
          echo $record;
          if(!$show_coloumn) {
            // display field/column names in first row
            echo implode("\t", array_keys($record)) . "\n";
            $show_coloumn = true;
          }
          echo implode("\t", array_values($record)) . "\n";
        }
      }
      exit;
}
?>