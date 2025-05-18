<?php

session_start();

include "../Connect.php";

$S_ID = $_SESSION['S_Log'];

$ann_id      = $_GET['ann_id'] ?? '';
$title        = $_POST['title'] ?? '';
$date    = $_POST['date'] ?? '';
$content  = $_POST['content'] ?? '';
$description = $_POST['description'] ?? '';
$category_id = $_POST['category_id'] ?? 0;

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

if ($imagePath) {

    $stmt = $con->prepare("UPDATE announcements SET category_id = ?, title = ?, date = ?, content = ?, description = ?, image = ? WHERE id = ?");
    $stmt->bind_param("isssssi", $category_id, $title, $date, $content, $description, $imagePath, $ann_id);

} else {

    $stmt = $con->prepare("UPDATE announcements SET category_id = ?, title = ?, date = ?, content = ?, description = ? WHERE id = ?");
    $stmt->bind_param("issssi", $category_id, $title, $date, $content, $description, $ann_id);
}

if ($stmt->execute()) {
    $res['error'] = false;
} else {
    $res['error'] = true;
}

echo json_encode($res);
