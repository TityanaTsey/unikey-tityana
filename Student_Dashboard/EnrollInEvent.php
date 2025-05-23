<?php

session_start();

include "../Connect.php";

use PHPMailer\PHPMailer\PHPMailer;

require '../phpmailer/src/Exception.php';
require '../phpmailer/src/PHPMailer.php';
require '../phpmailer/src/SMTP.php';

$S_ID     = $_SESSION['S_Log'];
$event_id = $_GET['event_id'];

$res = [];

$sql44444 = mysqli_query($con, "SELECT id FROM student_events WHERE event_id = '$event_id' AND student_id = '$S_ID'");

if (mysqli_num_rows($sql44444) > 0) {

    $res['error']   = true;
    $res['message'] = "You Already Enrolled";

} else {

    $sql2 = mysqli_query($con, "SELECT * FROM events WHERE id='$event_id'");
    $row2 = mysqli_fetch_array($sql2);

    $count      = $row2['count'];
    $event_name = $row2['name'];

    $sql3333 = mysqli_query($con, "SELECT COUNT(id) AS enrollments_count FROM student_events WHERE event_id = '$event_id'");
    $row3333 = mysqli_fetch_array($sql3333);

    $enrollments_count = $row3333['enrollments_count'];

    if ($enrollments_count == $count) {

        $status = 'Closed';

        $stmt = $con->prepare("UPDATE events SET status = ? WHERE id = ?");

        $stmt->bind_param("si", $status, $event_id);

    }

    $stmt = $con->prepare("INSERT INTO student_events (student_id, event_id) VALUES (?, ?)");

    $stmt->bind_param("ii", $S_ID, $event_id);

    if ($stmt->execute()) {
        $res['error'] = false;
    } else {
        $res['error'] = "Err In Adding Student to Event";
    }


        $studentSql = mysqli_query($con, "SELECT * FROM students WHERE id='$S_ID'");
        $studentRow = mysqli_fetch_array($studentSql);

        $student_email = $studentRow['email'];
    try {

                       

                        $mail = new PHPMailer(true);
                        $mail->isSMTP();
                        $mail->Host       = 'smtp.gmail.com';
                        $mail->SMTPAuth   = true;
                        $mail->Username   = 'unikeyproj@gmail.com';
                        $mail->Password   = 'bobl rknu ojwk nvwq';
                        $mail->SMTPSecure = 'ssl';
                        $mail->Port       = 465;

                        $mail->setFrom("unikeyproj@gmail.com");

                        $mail->addAddress($student_email);

                        $mail->isHTML(true);

                        $mail->Subject = "Event Enrollment";
                        $mail->Body    = "Your Have Enrolled in ".$event_name;

                        $mail->send();

                      

                    } catch (Exception $e) {

                       $res['error'] = "Err In Sending Email".$mail->ErrorInfo;
                    }

}


echo json_encode($res);
