<?php  
//export.php  
if(isset($_POST["export"]))
{
    $conn = new mysqli('localhost', 'root', 'root'); 
    mysqli_select_db($conn, 'scheduling'); 
    $sql = "SELECT `id`,`name`,`location` FROM `availability`"; 
    $setRec = mysqli_query($conn, $sql); 
    $columnHeader = ''; 
    $columnHeader = "Id" . "\t" . "Name" . "\t" . "Location" . "\t"; 
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