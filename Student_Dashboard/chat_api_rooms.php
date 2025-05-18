<?php
session_start();
include "../Connect.php";

$S_ID = $_SESSION['S_Log'] ?? null;
if (!$S_ID) {
    http_response_code(401);
    exit('Login required');
}

$room_id = $_GET['room'] ?? null;
$rooms = [];

if ($room_id && is_numeric($room_id)) {
    // Only fetch if user is a member
    $stmt = $con->prepare("
        SELECT r.id, r.title
        FROM rooms r
        JOIN room_members rm ON r.id = rm.room_id
        WHERE r.id = ? AND rm.student_id = ?
    ");
    $stmt->bind_param("ii", $room_id, $S_ID);
    $stmt->execute();
    $result = $stmt->get_result();
    $single_room = $result->fetch_assoc();
    if ($single_room) {
        $rooms[] = $single_room;
    }
    $stmt->close();
}

// Now get **all** rooms the user is a member of (avoids duplicate)
$stmt = $con->prepare("
    SELECT r.id, r.title
    FROM rooms r
    JOIN room_members rm ON r.id = rm.room_id
    WHERE rm.student_id = ?
");
$stmt->bind_param("i", $S_ID);
$stmt->execute();
$result = $stmt->get_result();
while ($row = $result->fetch_assoc()) {
    if (!in_array($row['id'], array_column($rooms, 'id'))) {
        $rooms[] = $row;
    }
}

header('Content-Type: application/json');
echo json_encode($rooms);
