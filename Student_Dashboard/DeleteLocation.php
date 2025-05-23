<?php

session_start();

include "../Connect.php";

$S_ID   = $_SESSION['S_Log'];
$loc_id = $_GET['loc_id'];

$res = [];

$stmt = $con->prepare("DELETE FROM maps WHERE id = ?");
$stmt->bind_param("i", $loc_id);

if ($stmt->execute()) {
    $res['error'] = false;
} else {
    $res['error'] = true;
}

echo json_encode($res);
