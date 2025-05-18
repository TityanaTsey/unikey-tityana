
<?php
    session_start();

    include "../Connect.php";

    $S_ID   = $_SESSION['S_Log'];
    $ann_id = $_GET['ann_id'];

    if (! $S_ID) {

        echo '<script language="JavaScript">
     document.location="../login.php";
    </script>';

    } else {

        $sql1 = mysqli_query($con, "select * from students where id = '$S_ID'");
        $row1 = mysqli_fetch_array($sql1);

        $name  = $row1['fname'] . ' ' . $row1['lname'];
        $email = $row1['email'];

        $sql2 = mysqli_query($con, "select * from announcements where id = '$ann_id'");
        $row2 = mysqli_fetch_array($sql2);

        $category_id = $row2['category_id'];
        $title       = $row2['title'];
        $date        = $row2['date'];
        $content     = $row2['content'];
        $description = $row2['description'];
        $image       = $row2['image'];

        $sql3 = mysqli_query($con, "select * from categories where id='$category_id'");
        $row3 = mysqli_fetch_array($sql3);

        $category_name = $row3['name'];
    }

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>UniKey - Announcement Details</title>
    <!-- favicon -->
    <link rel="icon" type="image/png" href="favicon/favicon-96x96.png" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="favicon/favicon.svg" />
    <link rel="shortcut icon" href="favicon/favicon.ico" />
    <link rel="apple-touch-icon" sizes="180x180" href="favicon/apple-touch-icon.png" />
    <link rel="manifest" href="favicon/site.webmanifest" />
    <!-- css -->
    <link rel="stylesheet" href="../css/all.min.css" />
    <link rel="stylesheet" href="../css/framework.css" />
    <link rel="stylesheet" href="../css/announcement.css" />
    <link rel="stylesheet" href="../css/side.css" />
    <!-- google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<style> 
        .announcement-detail {
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            margin: 20px;
            text-align: justify;
        }

        .announcement-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .announcement-header .title {
            flex: 1;
            margin-right: 20px;
        }

        .announcement-header img {
            max-width: 200px;
            border-radius: 10px;
        }

        .announcement-detail h2 {
            margin-top: 0;
        }

        .announcement-detail .tags {
            margin-top: 10px;
        }

        .announcement-detail .tag {
            display: inline-block;
            padding: 5px 10px;
            margin-right: 5px;
            background-color: #e0e0e0;
            border-radius: 3px;
            font-size: 12px;
            margin-bottom: 10px;
        }
        .go-back-btn {
            position: absolute; 
            bottom: 20px; 
            right: 20px; 
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .go-back-btn:hover {
            background-color: #45a049; 
        }

        .announcement-detail .content {
            margin-top: 20px;
            line-height: 1.6;
        }
        @media (max-width: 768px) {
            .announcement-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .announcement-header img {
                max-width: 100%;
                margin: 10px auto;
            }

            .announcement-header .title {
                margin-right: 0;
            }
            
        }
    </style>
</head>

<body>
    <div class="page d-flex content">
        <!-- Sidebar -->
        <div class="sidebar bg-white p-20 p-relative">
            <a href="landing.html">
                <h3 class="p-relative txt-c mt-0">UniKey</h3>
            </a>
            <?php require('./asaid.php') ?>
        </div>

        <!-- Content -->
        <div class="content w-full">
            <!-- Header -->
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

            <!-- Main Content -->
            <div class="announcement-detail">
                <div class="tags">
                    <span class="tag"><?php echo $category_name?></span>
                </div>
                <div class="announcement-header">
                    <div class="title">
                        <h2><?php echo $title?></h2>
                        <p><?php echo $description?></p>
                        
                    </div>
                    <img src="../Admin_Dashboard/<?php echo $image?>" alt="UJ's Yearbook" />
                </div>
                <div class="content">
                   
                    <p><?php echo $content?></p> 
                    <!-- <ul>
                        <li>- Exclusive interviews with faculty and students</li>
                        <li>- Photo galleries from major university events</li>
                        <li>- Special sections dedicated to graduating students</li>
                    </ul>
                    <p>Copies of the yearbook are available for purchase at the university bookstore. Don't miss out on
                        this keepsake that captures the spirit of our university!</p> -->
                </div>
                <div class="btn-shape bg-eee fs-13 label"><?php echo $date?></div>
                <!-- <button class="go-back-btn" onclick="goBack()">Go Back</button> -->
                
            </div>
            
        </div>
    </div>
    
    <script>
        // Function to go back to the previous page
        function goBack() {
            window.history.back();
        }
    </script>
</body>

</html>