<?php
session_start();
include "../Connect.php"; // your DB connection file

header('Content-Type: application/json');

$S_ID = $_SESSION['S_Log'] ?? null;
if (!$S_ID) {
    http_response_code(401);
    echo json_encode(['success' => false, 'message' => 'Login required']);
    exit;
}

$market_id = $_POST['market_id'] ?? null;
if (!$market_id || !is_numeric($market_id)) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Invalid item ID']);
    exit;
}

 $sql1 = mysqli_query($con, "select * from students where id='$S_ID'");
        $row1 = mysqli_fetch_array($sql1);

        $current_user_name          = $row1['fname'] . ' ' . $row1['lname'];
        


// 1. Get the item and owner student_id
$stmt = $con->prepare("
    SELECT MK.id,MK.name, MK.student_id AS owner_id
    FROM marketplaces MK
    JOIN students s ON MK.student_id = s.id
    WHERE MK.id = ? AND MK.status = 'Available'
    LIMIT 1
");
$stmt->bind_param('i', $market_id);
$stmt->execute();
$result = $stmt->get_result();
$item = $result->fetch_assoc();
$stmt->close();

if (!$item) {
    http_response_code(404);
    echo json_encode(['success' => false, 'message' => 'Item not found or inactive']);
    exit;
}

$owner_id = $item['owner_id'];
$item_name=$item['name'];
$user_id = $S_ID;

// === NEW: Check if a room already exists for this user and item ===
$stmt = $con->prepare("
    SELECT r.id
    FROM rooms r
    JOIN room_members rm ON r.id = rm.room_id
    WHERE r.market_id = ? AND rm.student_id = ?
    LIMIT 1
");
$stmt->bind_param('ii', $market_id, $user_id);
$stmt->execute();
$result = $stmt->get_result();
$existingRoom = $result->fetch_assoc();
$stmt->close();

if ($existingRoom) {
    // Room already exists, return that room_id
    echo json_encode(['success' => true, 'room_id' => $existingRoom['id'], 'message' => 'Room already exists']);
    exit;
}

// 2. Create a new room (e.g. title could be "Lost item #123 chat")
$title = "Chat regarding {$item_name} from {$current_user_name} ";
$description = "Chat regarding {$item_name} From User #{$user_id}";

// Insert new room with market_id
$stmt = $con->prepare("INSERT INTO rooms (title, description, created_by, market_id) VALUES (?, ?, ?, ?)");
$stmt->bind_param('ssii', $title, $description, $user_id, $market_id);
$stmt->execute();

if ($stmt->affected_rows === 0) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Failed to create room']);
    exit;
}

$room_id = $stmt->insert_id;
$stmt->close();

// 3. Add sender and owner as members to room_members
$stmt = $con->prepare("INSERT INTO room_members (room_id, student_id) VALUES (?, ?), (?, ?)");
$stmt->bind_param('iiii', $room_id, $user_id, $room_id, $owner_id);
$stmt->execute();

if ($stmt->affected_rows < 1) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Failed to add room members']);
    exit;
}
$stmt->close();

// 4. Return success + new room_id
echo json_encode(['success' => true, 'room_id' => $room_id]);
exit;
