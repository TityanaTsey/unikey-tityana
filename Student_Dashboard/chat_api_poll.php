<?php
session_start();
include "../Connect.php";

header('Content-Type: application/json');

$student_id = $_SESSION['S_Log'] ?? null;
$room_id = isset($_GET['room']) ? (int)$_GET['room'] : 0;
$since = isset($_GET['since']) ? (int)$_GET['since'] : 0;

if (!$student_id || !$room_id) {
    echo json_encode([]);
    exit;
}

// Verify user is a member of the room
$check = $con->prepare("SELECT 1 FROM room_members WHERE room_id = ? AND student_id = ?");
$check->bind_param("ii", $room_id, $student_id);
$check->execute();
$check->store_result();
if ($check->num_rows === 0) {
    echo json_encode([]);
    exit;
}
$check->close();

// Fetch new messages
$sql = "
    SELECT m.id, m.body, m.created, m.student_id, s.fname, s.lname
    FROM messages m
    JOIN students s ON m.student_id = s.id
    WHERE m.room_id = ?
      AND m.id > ?
    ORDER BY m.id ASC
";
$stmt = $con->prepare($sql);
$stmt->bind_param('ii', $room_id, $since);
$stmt->execute();
$result = $stmt->get_result();

$messages = [];
while ($row = $result->fetch_assoc()) {
    $row['full_name'] = $row['fname'] . ' ' . $row['lname'];
    $messages[] = $row;
}
$stmt->close();

echo json_encode($messages);
exit;
