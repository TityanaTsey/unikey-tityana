<?php

session_start();

include "../Connect.php";

$enrollment_id = $_GET['enrollment_id'];

$res = [];

$stmt = $con->prepare("DELETE FROM student_events WHERE id = ?");
$stmt->bind_param("i", $enrollment_id);

if ($stmt->execute()) {

    echo "<script language='JavaScript'>
    alert ('Enrollment Cancled !');
    </script>";

    echo "<script language='JavaScript'>
    document.location='./index.php';
    </script>";

}

echo json_encode($res);
