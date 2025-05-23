<?php

session_start();

include "../Connect.php";

$S_ID = $_SESSION['S_Log'];
$lat  = isset($_POST['lat']) ? floatval($_POST['lat']) : null;
$lng  = isset($_POST['lng']) ? floatval($_POST['lng']) : null;
$name = isset($_POST['name']) ? trim($_POST['name']) : '';
$type = isset($_POST['type']) ? trim($_POST['type']) : '';

$res = [];

$stmt = $con->prepare("INSERT INTO maps (student_id, longitude, latitude, name, type) VALUES (?, ?, ?, ?, ?)");

$stmt->bind_param("iddss", $S_ID, $lng, $lat, $name, $type);

if ($stmt->execute()) {
    $res['error'] = false;
} else {
    $res['error'] = true;
}

echo json_encode($res);
