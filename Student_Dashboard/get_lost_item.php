<?php
session_start();
include "../Connect.php";

$S_ID = $_SESSION['S_Log'] ?? null;
if (!$S_ID) {
    http_response_code(401);
    exit('Login required');
}

$item_id = (int)$_GET['item_id'] ?? null;
$single_item;

if ($item_id && is_numeric($item_id)) {
    // Only fetch if user is a member
    $stmt = $con->prepare("
        SELECT * from lost_founds
        WHERE id = ? 
    ");
    $stmt->bind_param("i", $item_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $single_item = $result->fetch_assoc();
   
  
}

header('Content-Type: application/json');
echo json_encode($single_item);