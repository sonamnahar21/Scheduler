<?php
include_once('../connection.php');

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    //SELECT * FROM availability where date BETWEEN '2018-11-27' and '2018-12-05'
    $result_array = array();
    $query = "select * FROM availability WHERE date BETWEEN '2018-11-27' AND '2018-12-05'";
    $number_filter_row = mysqli_num_rows(mysqli_query($conn, $query));
    $result = $conn->query($query);
    while($row = $result->fetch_assoc()) {
        array_push($result_array, $row);
    }
    //echo json_encode($result_array);

    $output = array(
        "draw"    => intval($_POST["draw"]),
        "recordsTotal"  =>  $result_array,
        "recordsFiltered" => $number_filter_row,
        "data"    => $result_array
       );
       
       echo json_encode($result_array);
       
}
?>
