<?php
session_start();
include "../Connect.php";

// tell clients not to cache this response
header('Content-Type: application/json');
header('Cache-Control: no-cache, must-revalidate');

// get current student and last-seen message ID
$student_id = $_SESSION['S_Log'] ?? null;
$since      = isset($_GET['since']) ? (int)$_GET['since'] : 0;

if (!$student_id) {
    echo json_encode([]);
    exit;
}
session_write_close();
// how long to hold the request before giving up (in seconds)
$timeoutSeconds = 30;
$startTime      = time();

$sql = "
    SELECT
      m.id,
      m.room_id,
      m.body,
      m.created,
      m.student_id,
      s.fname,
      s.lname
    FROM messages m
    JOIN room_members rm
      ON rm.room_id = m.room_id
    JOIN students s
      ON s.id = m.student_id
    WHERE
      rm.student_id = ?
      AND m.id > ?
    ORDER BY m.id ASC
";

$messages = [];

while (true) {
    $stmt = $con->prepare($sql);
    $stmt->bind_param("ii", $student_id, $since);
    $stmt->execute();
    $result = $stmt->get_result();

    $messages = [];
    while ($row = $result->fetch_assoc()) {
        $row['full_name'] = $row['fname'] . ' ' . $row['lname'];
        $messages[] = $row;
    }
    $stmt->close();

    // if we found new messages, or timed out, return whatever we have
    if (!empty($messages) || (time() - $startTime) >= $timeoutSeconds) {
        echo json_encode($messages);
        exit;
    }

    // otherwise wait briefly and try again
    usleep(500000); // 0.5s
}
