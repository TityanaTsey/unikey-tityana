<?php

session_start();

include "../Connect.php";

$S_ID           = $_SESSION['S_Log'];
$marketplace_id = $_GET['marketplace_id'];

$res = [];

$sql44444 = mysqli_query($con, "SELECT id FROM marketplace_interestes WHERE marketplace_id = '$marketplace_id' AND student_id = '$S_ID'");

if (mysqli_num_rows($sql44444) > 0) {

    echo "<script language='JavaScript'>
    alert ('You Already Interested !');
    </script>";

    echo "<script language='JavaScript'>
    document.location='./marketplace.php';
    </script>";

} else {

    $sql2 = mysqli_query($con, "SELECT * FROM marketplaces WHERE id = '$marketplace_id'");
    $row2 = mysqli_fetch_array($sql2);

    $intresets_counts    = $row2['intresets_counts'];
    $newIntresets_counts = $intresets_counts + 1;

    $stmt = $con->prepare("INSERT INTO marketplace_interestes (student_id, marketplace_id) VALUES (?, ?)");
    $stmt->bind_param("ii", $S_ID, $marketplace_id);
    $stmt->execute();

    mysqli_query($con, "UPDATE marketplaces SET intresets_counts = '$newIntresets_counts' WHERE id = '$marketplace_id'");

    echo "<script language='JavaScript'>
    alert ('Added Success !');
    </script>";

    echo "<script language='JavaScript'>
    document.location='./marketplace.php';
    </script>";

}
