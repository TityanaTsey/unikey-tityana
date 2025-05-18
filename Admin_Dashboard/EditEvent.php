<?php

session_start();

include "../Connect.php";

$S_ID = $_SESSION['S_Log'];

$eventID     = $_GET['event_id'] ?? '';
$name        = $_POST['name'] ?? '';
$location    = $_POST['location'] ?? '';
$supervisor  = $_POST['supervisor'] ?? '';
$description = $_POST['description'] ?? '';
$date        = $_POST['date'] ?? '';
$count       = $_POST['count'] ?? 0;
$category_id = $_POST['category_id'] ?? 0;

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

if($imagePath) {

    $stmt = $con->prepare("UPDATE events SET category_id = ?, name = ?, location = ?, supervisor = ?, description = ?, imagePath = ?, date = ?, count = ? WHERE id = ?");
    $stmt->bind_param("issssssii", $category_id, $name, $location, $supervisor, $description, $imagePath, $date, $count, $eventID);

} else {

    $stmt = $con->prepare("UPDATE events SET category_id = ?, name = ?, location = ?, supervisor = ?, description = ?, date = ?, count = ? WHERE id = ?");
    $stmt->bind_param("isssssii", $category_id, $name, $location, $supervisor, $description, $date, $count, $eventID);
}


if ($stmt->execute()) {
    $res['error'] = false;
} else {
    $res['error'] = true;
}

echo json_encode($res);
