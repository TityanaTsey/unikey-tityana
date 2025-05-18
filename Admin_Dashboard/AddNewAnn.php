<?php

session_start();

include "../Connect.php";

$S_ID = $_SESSION['S_Log'];

$title        = $_POST['title'] ?? '';
$date         = $_POST['date'] ?? '';
$content      = $_POST['content'] ?? '';
$description  = $_POST['description'] ?? '';
$category_id  = $_POST['category_id'] ?? 0;
$is_important = $_POST['is_important'] ?? 0;
$status       = 'Available';

$imagePath = null;
if (! empty($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
    $tmpName   = $_FILES['image']['tmp_name'];
    $origName  = basename($_FILES['image']['name']);
    $targetDir = __DIR__ . '/Announcements_Images/';
    if (! is_dir($targetDir)) {
        mkdir($targetDir, 0755, true);
    }
    $newName  = time() . '_' . preg_replace('/[^a-zA-Z0-9_\-\.]/', '_', $origName);
    $fullPath = $targetDir . $newName;
    if (move_uploaded_file($tmpName, $fullPath)) {
        $imagePath = 'Announcements_Images/' . $newName;
    }
}

$res = [];

$stmt = $con->prepare("INSERT INTO announcements (category_id, title, date, content, description, image, status, is_important) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

$stmt->bind_param("issssssi", $category_id, $title, $date, $content, $description, $imagePath, $status, $is_important);

if ($stmt->execute()) {
    $res['error'] = false;
} else {
    $res['error'] = true;
}

echo json_encode($res);
