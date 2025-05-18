<?php
session_start();

include "../Connect.php";

$events = [];

$sql1 = mysqli_query($con, "SELECT * FROM events WHERE status != 'Deleted' ORDER BY id DESC");

while ($row1 = mysqli_fetch_array($sql1)) {

    $category_id = $row1['category_id'];

    $sql2 = mysqli_query($con, "SELECT * FROM categories WHERE id = '$category_id'");
    $row2 = mysqli_fetch_array($sql2);

    $events[] = [
        'id'          => $row1['id'],
        'name'        => $row1['name'],
        'location'    => $row1['location'],
        'supervisor'  => $row1['supervisor'],
        'description' => $row1['description'],
        'image'       => $row1['image'],
        'date'        => $row1['date'],
        'count'       => $row1['count'],
        'category'    => $row2['name'],
        'status'      => $row1['status'],
        'category_id' => $category_id,
    ];
}

echo json_encode($events);
