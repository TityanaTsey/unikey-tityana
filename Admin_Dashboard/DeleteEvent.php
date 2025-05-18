<?php

session_start();

include "../Connect.php";

$S_ID = $_SESSION['S_Log'];

$eventID = $_GET['event_id'];
$status  = 'Deleted';

$res     = [];

$stmt = $con->prepare("UPDATE events SET status = ? WHERE id = ?");
$stmt->bind_param("si", $status, $eventID);

if ($stmt->execute()) {
    $res['error'] = false;
} else {
    $res['error'] = true;
}

echo json_encode($res);
