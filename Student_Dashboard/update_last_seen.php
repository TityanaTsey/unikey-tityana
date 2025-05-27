<?php
// notifications_api.php

session_start();
include "../Connect.php";

header('Content-Type: application/json');

// 1) Authenticate
$student_id = $_SESSION['S_Log'] ?? null;
if (!$student_id) {
  http_response_code(401);
  echo json_encode(['error'=>'Not authenticated']);
  exit;
}

$u = $con->prepare("
  UPDATE students
     SET last_login_time = NOW()
   WHERE id = ?
");
$u->bind_param("i", $student_id);
$u->execute();
$u->close();
 echo json_encode("updated");
  exit;
?>