<?php
session_start();

include "../Connect.php";

$events = [];

$sql1 = mysqli_query($con, "SELECT * FROM announcements WHERE status != 'Deleted' ORDER BY id DESC");

while ($row1 = mysqli_fetch_array($sql1)) {

    $category_id = $row1['category_id'];

    $sql2 = mysqli_query($con, "SELECT * FROM categories WHERE id = '$category_id'");
    $row2 = mysqli_fetch_array($sql2);

    $events[] = [
        'id'           => $row1['id'],
        'title'        => $row1['title'],
        'date'         => $row1['date'],
        'content'      => $row1['content'],
        'description'  => $row1['description'],
        'image'        => $row1['image'],
        'status'       => $row1['status'],
        'is_important' => $row1['is_important'],
        'category'     => $row2['name'],
        'category_id'  => $category_id,
    ];
}

echo json_encode($events);
