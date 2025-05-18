<?php

session_start();

include "../Connect.php";

$S_ID = $_SESSION['S_Log'];

$name        = $_POST['name'] ?? '';
$location    = $_POST['location'] ?? '';
$supervisor  = $_POST['supervisor'] ?? '';
$description = $_POST['description'] ?? '';
$date        = $_POST['date'] ?? '';
$count       = $_POST['count'] ?? 0;
$category_id = $_POST['category_id'] ?? 0;
$status      = 'Active';

$imagePath = null;
if (! empty($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
    $tmpName   = $_FILES['image']['tmp_name'];
    $origName  = basename($_FILES['image']['name']);
    $targetDir = __DIR__ . '/Events_Images/';
    if (! is_dir($targetDir)) {
        mkdir($targetDir, 0755, true);
    }
    $newName  = time() . '_' . preg_replace('/[^a-zA-Z0-9_\-\.]/', '_', $origName);
    $fullPath = $targetDir . $newName;
    if (move_uploaded_file($tmpName, $fullPath)) {
        $imagePath = 'Events_Images/' . $newName;
    }
}

$res = [];

$stmt = $con->prepare("INSERT INTO events (category_id, name, location, supervisor, description, image, date, count, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

$stmt->bind_param("issssssis", $category_id, $name, $location, $supervisor, $description, $imagePath, $date, $count, $status);

if ($stmt->execute()) {
    $res['error'] = false;
} else {
    $res['error'] = true;
}

echo json_encode($res);
