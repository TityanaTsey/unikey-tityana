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
    <title><?php echo $name ?> - Events</title>
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
                        <span class="fs-14 ml-5">Logout</span></a>
                </div>
            </div>

            <!-- Main Content -->
            <div class="wrapper">
                <div class="short-header">
                    <h1 class="p-relative">Admin Panel for Events</h1>
                </div>

                <!-- Announcement Form -->
                <div class="latest-news p-20 bg-white rad-10 txt-c-mobile">
                    <h2 class="mt-0 mb-20">Add New Event</h2>
                    <form class="announcement-form" onsubmit="event.preventDefault(); addAnnouncement();">
                    <input type="hidden" id="eventID">
                        <input type="text" id="announcement-title" placeholder="Title" required />
                        <textarea id="announcement-des" placeholder="Description" rows="2" required></textarea>
                        <input type="text" id="ann-location" placeholder="Location" required />
                        <input type="text" id="supervisor" placeholder="Supervisor" required />
                        <input type="number" min="0" id="count" placeholder="count" required />
                        <input type="datetime-local" id="announcement-date" min="<?php echo date('Y-m-d') . 'T00:00'; ?>" required />
                        <select id="announcement-category" required>
                            <option value="" disabled selected>Select Category</option>
                            <?php
                                $sql1 = mysqli_query($con, "SELECT * from categories WHERE type = 'events'");

                                while ($row1 = mysqli_fetch_array($sql1)) {

                                    $category_id   = $row1['id'];
                                    $category_name = $row1['name'];

                                ?>
<option value="<?php echo $category_id ?>"><?php echo $category_name ?></option>
<?php
}?>
                        </select>
                        <div class="attach">
                            <i class="fa-solid fa-paperclip attach-pin"></i>
                            <input type="file" id="announcement-image" accept="image/*" />
                        </div>
                        <button type="submit">Add Event</button>
                    </form>
                </div>

                <!-- List of Announcements -->
                <div class="announcement-list" id="announcement-list">
                    <h2 class="mt-0 mb-20">Existing Events</h2>
                    <!-- Announcements will be dynamically added here -->
                </div>
            </div>
        </div>
    </div>

    <script src="../js/event_admin.js"> </script>
</body>

</html>