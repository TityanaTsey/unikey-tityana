<?php

session_start();
require './Connect.php';

$department_id = $_GET['department_id'];
$majors        = [];

$sql1 = mysqli_query($con, "SELECT id, name from majors WHERE department_id = '$department_id'");

while ($row1 = mysqli_fetch_array($sql1)) {

    $majors[] = $row1;

}

echo json_encode($majors);
