<?php

session_start();

include "../Connect.php";

$ann_id = $_GET['ann_id'];
$status  = 'Deleted';

$res     = [];

$stmt = $con->prepare("UPDATE announcements SET status = ? WHERE id = ?");
$stmt->bind_param("si", $status, $ann_id);

if ($stmt->execute()) {
    $res['error'] = false;
} else {
    $res['error'] = true;
}

echo json_encode($res);
