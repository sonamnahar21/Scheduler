<?php
include_once('../data-ops/connection.php');
$columns = array('id', 'name');

$query = "SELECT * FROM availability";
$number_filter_row = mysqli_num_rows(mysqli_query($conn, $query));
$result = mysqli_query($conn, $query);
$data = array();

while($row = mysqli_fetch_array($result)){
    $sub_array = array();
    $sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-column="id">' . $row["id"] . '</div>';
    $sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-column="name">' . $row["name"] . '</div>';
    $sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-column="location">' . $row["location"] . '</div>';
    $sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-column="date">' . $row["date"] . '</div>';
    $sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-column="start_time">' . date("g:i a", strtotime($row["start_time"])) . '</div>';
    $sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-column="end_time">' . date("g:i a", strtotime($row["end_time"])) . '</div>';
    $sub_array[] = '<div  data-id="'.$row["id"].'" data-column="is_approved_by_admin">' . $row["is_approved_by_admin"] . '</div>';
    $sub_array[] = '<div  data-id="'.$row["id"].'" data-column="is_confirmed_by_student">' . $row["is_confirmed_by_student"] . '</div>';

    $sub_array[] = '<button type="button" name="delete" class="btn btn-danger btn-xs delete" id="'.$row["id"].'">Delete</button>';
    $data[] = $sub_array;
}

function get_all_data($conn)
{
 $query = "SELECT * FROM availability";
 $result = mysqli_query($conn, $query);
 return mysqli_num_rows($result);
}

$output = array(
 "draw"    => intval($_POST["draw"]),
 "recordsTotal"  =>  get_all_data($conn),
 "recordsFiltered" => $number_filter_row,
 "data"    => $data
);

echo json_encode($output);

?>