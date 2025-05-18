<?php

session_start();

include "../Connect.php";

$S_ID = $_SESSION['S_Log'];

$eventID = $_GET['event_id'];
$active  = 0;

$res = [];

$stmt = $con->prepare("UPDATE students SET active = ? WHERE id = ?");
$stmt->bind_param("ii", $active, $S_ID);

if ($stmt->execute()) {

    unset($_SESSION['S_Log']);

    echo "<script language='JavaScript'>
			alert ('Account Deativated !');
      </script>";

    echo '<script language="JavaScript">
        document.location="../login.php";
    </script>';

}
