<?php  
include_once('./connection.php');
if(isset($_POST["export"]))
{
    $sql = "SELECT `id`,`name`,`location`, `status` FROM `availability`"; 
    $setRec = mysqli_query($conn, $sql); 
    $columnHeader = ''; 
    $columnHeader = "Id" . "\t" . "Name" . "\t" . "Location" . "\t".  "Status" . "\t"; 
    $setData = ''; 
    while ($rec = mysqli_fetch_row($setRec)) { 
    $rowData = ''; 
    foreach ($rec as $value) { 
    $value = '"' . $value . '"' . "\t"; 
    $rowData .= $value; 
    } 
    $setData .= trim($rowData) . "\n"; 
    } 
    header("Content-type: application/octet-stream"); 
    header("Content-Disposition: attachment; filename=User_Detail.xls"); 
    header("Pragma: no-cache"); 
    header("Expires: 0"); 
    echo ucwords($columnHeader) . "\n" . $setData . "\n"; 
}
?>