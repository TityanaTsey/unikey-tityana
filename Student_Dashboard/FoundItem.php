<?php

session_start();

include "../Connect.php";

$S_ID = $_SESSION['S_Log'];

$item_id = $_GET['item_id'];
$status  = '3';

$res = [];

$stmt = $con->prepare("UPDATE lost_founds SET status = ? WHERE id = ?");
$stmt->bind_param("si", $status, $item_id);

if ($stmt->execute()) {

    echo "<script language='JavaScript'>
    alert ('Item Found !');
    </script>";

    echo "<script language='JavaScript'>
    document.location='./index.php';
    </script>";
}
