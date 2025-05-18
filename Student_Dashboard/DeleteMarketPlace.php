<?php

session_start();

include "../Connect.php";

$marketplace_id = $_GET['marketplace_id'];
$status = 'Expired';

$res = [];

$stmt = $con->prepare("UPDATE marketplaces SET status = ? WHERE id = ?");
$stmt->bind_param("si", $status, $marketplace_id);

if ($stmt->execute()) {

    echo "<script language='JavaScript'>
    alert ('Marketplace Expired !');
    </script>";

    echo "<script language='JavaScript'>
    document.location='./index.php';
    </script>";

}

echo json_encode($res);
