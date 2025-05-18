<?php

session_start();

include "../Connect.php";
$S_ID = $_SESSION['S_Log'];

// $input = json_decode(file_get_contents('php://input'), true);

$fName         = $_POST['fname'];
$lName         = $_POST['lname'];
$email         = $_POST['email'];
// $password      = md5($_POST['password']);
$major_id      = $_POST['major_id'];
$department_id = $_POST['department_id'];
$student_id    = $_POST['student_id'];

$imagePath = null;
if (! empty($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
    $tmpName   = $_FILES['image']['tmp_name'];
    $origName  = basename($_FILES['image']['name']);
    $targetDir = __DIR__ . '/Students_Images/';
    if (! is_dir($targetDir)) {
        mkdir($targetDir, 0755, true);
    }
    $newName  = time() . '_' . preg_replace('/[^a-zA-Z0-9_\-\.]/', '_', $origName);
    $fullPath = $targetDir . $newName;
    if (move_uploaded_file($tmpName, $fullPath)) {
        $imagePath = 'Students_Images/' . $newName;
    }
}

$res = [];

if ($imagePath) {

    $stmt = $con->prepare("UPDATE students SET fname = ?, lname = ?, email = ?, major_id = ?, department_id = ?, image = ? WHERE id = ?");

    $stmt->bind_param("sssiisi", $fName, $lName, $email, $major_id, $department_id, $imagePath, $student_id);
} else {

    $stmt = $con->prepare("UPDATE students SET fname = ?, lname = ?, email = ?, major_id = ?, department_id = ? WHERE id = ?");

    $stmt->bind_param("sssiii", $fName, $lName, $email, $major_id, $department_id, $student_id);
}

if ($stmt->execute()) {

    $res['error'] = false;
} else {
    $res['error'] = true;
}

echo json_encode($res);
