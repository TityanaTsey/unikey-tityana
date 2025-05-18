<?php
    session_start();

    include "../Connect.php";

    $S_ID     = $_SESSION['S_Log'];
    $event_id = $_GET['event_id'];

    if (! $S_ID) {

        echo '<script language="JavaScript">
     document.location="../login.php";
    </script>';

    } else {

        $sql1 = mysqli_query($con, "select * from students where id='$S_ID'");
        $row1 = mysqli_fetch_array($sql1);

        $name  = $row1['fname'] . ' ' . $row1['lname'];
        $email = $row1['email'];

        $sql2 = mysqli_query($con, "select * from events where id='$event_id'");
        $row2 = mysqli_fetch_array($sql2);

        $category_id = $row2['category_id'];
        $event_name  = $row2['name'];
        $location    = $row2['location'];
        $supervisor  = $row2['supervisor'];
        $description = $row2['description'];
        $image       = $row2['image'];
        $date        = $row2['date'];
        $count       = $row2['count'];
        $status      = $row2['status'];

        $sql3 = mysqli_query($con, "select * from categories where id='$category_id'");
        $row3 = mysqli_fetch_array($sql3);

        $category_name = $row3['name'];
    }

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Event Details - <?php echo $event_name ?></title>
    <!-- favicon -->
    <link rel="icon" type="image/png" href="favicon/favicon-96x96.png" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="favicon/favicon.svg" />
    <link rel="shortcut icon" href="favicon/favicon.ico" />
    <link rel="apple-touch-icon" sizes="180x180" href="favicon/apple-touch-icon.png" />
    <link rel="manifest" href="favicon/site.webmanifest" />
    <!-- css -->
    <link rel="stylesheet" href="../css/all.min.css" />
    <link rel="stylesheet" href="../css/framework.css" />
    <link rel="stylesheet" href="../css/event.css" />
    <link rel="stylesheet" href="../css/side.css" />
    <!-- google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<style>
        .cover {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 6px;
        }

        .detail-item {
            display: flex;
            align-items: center;
            margin-bottom: -10px;
        }

        .detail-item i {
            color: #314528;
            font-size: 16px;
            margin-right: 10px;
        }

        .tags {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin-top: 20px;
        }

        .tag {
            padding: 5px 10px;
            background-color: #f0f0f0;
            border-radius: 15px;
            font-size: 12px;
            color: #333;
            cursor: pointer;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .tag:hover {
            background-color: #314528;
            color: #fff;
        }

        .enroll-btn {
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #314528;
            color: #fff;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 14px;
            transition: background-color 0.3s ease;
        }

        .enroll-btn:hover {
            background-color: #1e2b1a;
        }

        .confirmation-popup {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #fff;
            padding: 20px;
            border-radius: 6px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            z-index: 1000;
            text-align: center;
        }

        .confirmation-popup p {
            margin-bottom: 20px;
        }

        .confirmation-popup button {
            padding: 8px 16px;
            background-color: #314528;
            color: #fff;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 14px;
        }

        .confirmation-popup button:hover {
            background-color: #1e2b1a;
        }

        .overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 999;
        }
    </style>
</head>

<body>
    <div class="page d-flex">
        <div class="sidebar bg-white p-20 p-relative">
            <a href="landing.html">
                <h3 class="p-relative txt-c mt-0">UniKey</h3>
            </a>
            <?php require './asaid.php'?>
        </div>
        <div class="content w-full">
            <!-- Start Head -->
            <div class="head bg-white p-15 between-flex">
                <div class="user-display p-relative d-flex align-center">
                    <i class="fa-solid fa-user-circle fa-lg c-main mr-10"></i>
                    <span class="fs-14 fw-500"><?php echo $name ?></span> <!-- Replace with dynamic username -->
                </div>
                <div class="icons d-flex align-center">
                    <span class="notification p-relative">
                        <i class="fa-regular fa-bell fa-lg"></i>
                        <i class="fa-solid fa-right-from-bracket"></i>
                    </span>
                </div>
            </div>
            <!-- End Head -->
            <h1 class="p-relative">Event Details</h1>
            <div class="event-details bg-white rad-6 p-20 m-20">
                <!-- Event Picture -->
                <img class="cover rad-6" src="../Admin_Dashboard/<?php echo $image ?>" alt="Event Cover" />

                <h2 class="mt-20"><?php echo $event_name ?></h2>
                <p class="description c-grey mt-15 fs-14">
                <?php echo $description ?>
                </p>

                <!-- Event Details with Icons -->
                <div class="details mt-20">
                    <div class="detail-item d-flex align-center mb-10">
                        <i class="fa-solid fa-location-dot c-blue fs-16 mr-10"></i>
                        <p><strong>Location:</strong><?php echo $location ?></p>
                    </div>
                    <div class="detail-item d-flex align-center mb-10">
                        <i class="fa-solid fa-user-tie c-blue fs-16 mr-10"></i>
                        <p><strong>Supervisor:</strong> <?php echo $supervisor ?></p>
                    </div>
                    <div class="detail-item d-flex align-center mb-10">
                        <i class="fa-solid fa-clock c-blue fs-16 mr-10"></i>
                        <p><strong>Time:</strong> <?php echo $date ?></p>
                    </div>
                </div>

                <!-- Tags -->
                <div class="tags mt-20">
                <span class="tag"><?php echo $category_name ?></span>
                </div>

                <!-- Enroll Now Button -->
                <button class="enroll-btn" onclick="showConfirmation()">Enroll Now</button>
            </div>
        </div>
    </div>

    <!-- Confirmation Pop-up -->
    <div class="overlay" id="overlay"></div>
    <div class="confirmation-popup" id="confirmationPopup">
        <p>Are you sure you want to enroll in this event?</p>
        <button onclick="confirmEnrollment()" style="margin-bottom: 5px;">Yes, Enroll</button>
        <button onclick="hideConfirmation()">Cancel</button>
    </div>

    <script>
        function showConfirmation() {
            document.getElementById('confirmationPopup').style.display = 'block';
            document.getElementById('overlay').style.display = 'block';
        }
        function hideConfirmation() {
            document.getElementById('confirmationPopup').style.display = 'none';
            document.getElementById('overlay').style.display = 'none';
        }
        function confirmEnrollment() {
            // alert('You have successfully enrolled in the event!');
            // hideConfirmation();


            fetch(`./EnrollInEvent.php?event_id=${<?php echo json_encode($event_id) ?>}`)
            .then(res => res.json())
            .then(res => {

                if(!res.error) {

                    alert('You have successfully enrolled in the event!');
                    hideConfirmation();

                } else {
                    alert(res.message ?? 'Something went wrong')
                    hideConfirmation();
                }
            })
        }
    </script>
</body>

</html>