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

// 2) Grab last_login_time
$stmt = $con->prepare("
  SELECT last_login_time
    FROM students
   WHERE id = ?
");
$stmt->bind_param("i", $student_id);
$stmt->execute();
$res = $stmt->get_result();
if (!($row = $res->fetch_assoc())) {
  http_response_code(400);
  echo json_encode(['error'=>'Student not found']);
  exit;
}
$lastLogin = $row['last_login_time'];
$stmt->close();

// 3) Build notifications
$items = [];

// 3a) Announcements (use `created`, not `created_at`)
$ann = $con->prepare("
  SELECT id, title, description
    FROM announcements
   WHERE created_at > ?
");
$ann->bind_param("s", $lastLogin);
$ann->execute();
$annRes = $ann->get_result();
while ($r = $annRes->fetch_assoc()) {
  $items[] = [
    'type'    => 'announcement',
    'id'      => (int)$r['id'],
    'title'   => $r['title'],
    'content' => $r['description'],
    'created' => $r['created_at']
  ];
}
$ann->close();

//3b) Chat messages
$msg = $con->prepare("
  SELECT
    m.id,
    m.room_id,
    m.body,
    m.created,
    m.student_id AS sender_id,
    CONCAT(s.fname,' ',s.lname) AS sender_name
  FROM messages m
  JOIN room_members rm ON rm.room_id = m.room_id
  JOIN students      s  ON s.id       = m.student_id
  WHERE rm.student_id = ?
    AND m.created    > ?
");
$msg->bind_param("is", $student_id, $lastLogin);
$msg->execute();
$msgRes = $msg->get_result();
while ($r = $msgRes->fetch_assoc()) {
  $items[] = [
    'type'        => 'message',
    'id'          => (int)$r['id'],
    'room_id'     => (int)$r['room_id'],
    'body'        => $r['body'],
    'created'     => $r['created'],
    'sender_id'   => (int)$r['sender_id'],
    'sender_name' => $r['sender_name']
  ];
}
$msg->close();

// 4) Sort newest-first
usort($items, fn($a,$b) => strtotime($b['created']) - strtotime($a['created']));

// 5) If still empty, you might not have any “new” items since last login
//    You can remove this debug line once you’re seeing real data.
if (empty($items)) {
  // error_log("No notifications since {$lastLogin} for student {$student_id}");
  echo json_encode($items);
  exit;
}

//6) Now update last_login_time so subsequent calls only pick up brand-new items


// 7) Return JSON
echo json_encode($items);
exit;
