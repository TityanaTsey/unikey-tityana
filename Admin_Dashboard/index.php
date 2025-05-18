<?php
    session_start();

    include "../Connect.php";

    $A_ID = $_SESSION['A_Log'];

   
    if (! $A_ID) {

        echo '<script language="JavaScript">
     document.location="../Admin-Login.php";
    </script>';

    } else {

        $sql1 = mysqli_query($con, "select * from administrator where id='$A_ID'");
        $row1 = mysqli_fetch_array($sql1);

        $name  = $row1['fname'] . ' ' . $row1['lname'];
        $email = $row1['email'];
    }
?>





<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo $name ?> - Dashboard</title>
    <!-- css -->
    <link rel="stylesheet" href="../css/all.min.css" />
    <link rel="stylesheet" href="../css/framework.css" />
    <link rel="stylesheet" href="../css/event_admin.css" />
    <link rel="stylesheet" href="../css/side.css" />
    <!-- fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;500&display=swap" rel="stylesheet" />
</head>

<body>
    <div class="page d-flex content">
        <!-- Sidebar -->
        <div class="sidebar bg-white p-20 p-relative">
            <h3 class="p-relative txt-c mt-0"><?php echo $name ?></h3>
            <?php require './adminaside.php'?>
        </div>

        <!-- Content -->
      
        <div class="content w-full full-content">
            <!-- Header -->
            <div class="head bg-white p-15 between-flex">
                <!-- Left side - User Name -->
                <div class="user-display p-relative d-flex align-center">
                    <i class="fa-solid fa-user-circle fa-lg c-main mr-10"></i>
                    <span class="fs-14 fw-500"><?php echo $name ?></span> <!-- Replace with dynamic username -->
                </div>

                <!-- Right side - Action Buttons -->
                <div class="header-actions d-flex align-center gap-10">
                    <!-- Dark/Light Mode Toggle -->
                    <button id="themeToggle" class="mode-toggle btn-shape bg-transparent c-gray hover-c-main p-10">
                        <i class="fa-solid fa-moon"></i> <!-- Default dark icon -->
                        <span class="fs-14 ml-5">Dark</span>
                    </button>

                    <!-- Language Selector -->
                    <div class="language-select p-relative">
                        <button id="languageToggle" class="btn-shape bg-transparent c-gray hover-c-main p-10">
                            <i class="fa-solid fa-globe"></i>
                            <span class="fs-14 ml-5">EN</span>
                            <i class="fa-solid fa-chevron-down fs-12 ml-5"></i>
                        </button>
                        <ul class="language-dropdown hidden bg-white rad-6 shadow">
                            <li><a href="#" data-lang="en">English</a></li>
                            <li><a href="#" data-lang="ar">العربية</a></li>
                        </ul>
                    </div>
                    <a href="./Logout.php" id="logoutBtn" class="btn-shape bg-red c-white hover-opacity p-10">
                        <i class="fa-solid fa-right-from-bracket"></i>
                        <span class="fs-14 ml-5">Logout</span> </a>
                </div>
            </div>

           
        </div>
    </div>

    <script src="../js/ann_admin.js"></script>
</body>

</html>
