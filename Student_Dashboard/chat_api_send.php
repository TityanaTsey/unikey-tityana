<?php
session_start();
include "../Connect.php";

$S_ID = $_SESSION['S_Log'];
if (!isset($S_ID)) {
    http_response_code(401);
    exit('Login required');
}
$user_id = (int)$S_ID;
$user_nick = "Test"; // or pull from session if you store nicknames

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit('Method Not Allowed');
}

$room = trim($_POST['room'] ?? '');
$body = trim($_POST['text'] ?? '');

if ($room === '' || $body === '') {
    http_response_code(400);
    exit('Missing parameters');
}

/* escape HTML */
$body = htmlspecialchars($body, ENT_QUOTES, 'UTF-8');

/* save message */
$stmt = $con->prepare(
    'INSERT INTO messages (room_id, student_id, body) VALUES (?, ?, ?)'
);
$stmt->bind_param('iis', $room, $user_id, $body);
if (!$stmt->execute()) {
    http_response_code(500);
    exit('Database error');
}
$stmt->close();

/* ensure membership */
$stmt = $con->prepare(
    'INSERT IGNORE INTO room_members (room_id, student_id) VALUES (?, ?)'
);
$stmt->bind_param('ii', $room, $user_id);
$stmt->execute();
$stmt->close();

echo 'OK';
