<?php
    session_start();

    include "../Connect.php";

    $S_ID = $_SESSION['S_Log'];

    $now = date('Y-m-d H:i:s');
    $fmt = '%Y-%m-%dT%H:%i';

    // $sql = "
    //     UPDATE `events`
    //     SET `status` = 'Expired'
    //     WHERE `status` = 'Active'
    //       AND STR_TO_DATE(`date`, '$fmt') < '$now'
    // ";

    // mysqli_query($con, $sql);

    // $fmtDate = '%Y-%m-%d';

    // $sql2 = "
    //   UPDATE `announcements`
    //   SET `status` = 'Expired'
    //   WHERE `status` = 'Available'
    //     AND STR_TO_DATE(`date`, '$fmtDate') < CURDATE()
    // ";
    // mysqli_query($con, $sql2);

    if (! $S_ID) {

        echo '<script language="JavaScript">
     document.location="../login.php";
    </script>';

    } else {

        $sql1 = mysqli_query($con, "select * from students where id='$S_ID'");
        $row1 = mysqli_fetch_array($sql1);

        $name          = $row1['fname'] . ' ' . $row1['lname'];
        $email         = $row1['email'];
        $user_image    = $row1['image'];
        $department_id = $row1['department_id'];
        $major_id      = $row1['major_id'];

        $sql222 = mysqli_query($con, "select * from departments where id='$department_id'");
        $row222 = mysqli_fetch_array($sql222);

        $dep_name = $row222['name'];

        $sql33333 = mysqli_query($con, "select * from majors where id='$major_id'");
        $row3333  = mysqli_fetch_array($sql33333);

        $major_name = $row3333['name'];

        $eventsSql = mysqli_query($con, "select COUNT(id) AS count_events from student_events where student_id='$S_ID'");
        $eventsRow = mysqli_fetch_array($eventsSql);

        $count_events = $eventsRow['count_events'];

        $lostsSql = mysqli_query($con, "SELECT COUNT(id) AS count_losts FROM lost_founds WHERE student_id='$S_ID' AND status = 1");
        #mysqli_query($con, "select COUNT(id) AS count_losts from lost_founds where student_id='$S_ID'");
        $lostsRow = mysqli_fetch_array($lostsSql);

        $count_losts = $lostsRow['count_losts'];

        $marketPlaceSql = mysqli_query($con, "SELECT COUNT(id) AS count_marketplaces FROM marketplaces WHERE student_id='$S_ID' AND status = 'Available'");
        #mysqli_query($con, "select COUNT(id) AS count_marketplaces from marketplaces where student_id='$S_ID'");
        $marketPlaceRow = mysqli_fetch_array($marketPlaceSql);

        $count_marketplaces = $marketPlaceRow['count_marketplaces'];

    }

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>UniKey - Dashboard</title>
    <!-- favicon -->
    <link rel="icon" type="image/png" href="favicon/favicon-96x96.png" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="favicon/favicon.svg" />
    <link rel="shortcut icon" href="favicon/favicon.ico" />
    <link rel="apple-touch-icon" sizes="180x180" href="favicon/apple-touch-icon.png" />
    <link rel="manifest" href="favicon/site.webmanifest" />
    <!-- css -->
    <link rel="stylesheet" href="../css/all.min.css" />
    <link rel="stylesheet" href="../css/framework.css" />
    <link rel="stylesheet" href="../css/dashboard.css" />
    <link rel="stylesheet" href="../css/side.css" />
    <!-- fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet" />
    <style>

    </style>
</head>

<body>
    <div class="page d-flex">
    <!-- Sidebar Navigation -->
    <div class="sidebar bg-white p-20 p-relative" id="sidebar">
        <a href="index.php"><h3 class="p-relative txt-c mt-0">UniKey</h3></a>
        <?php require './asaid.php'?>
    </div>

        <!-- Main Content -->
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
                         <a href="./logout.php" title="Logout" style="color: inherit; margin-left: 15px;">
                        <i class="fa-solid fa-right-from-bracket"></i>
                        </a>
                    </span>
                </div>
            </div>
            <!-- User Profile Section -->
            <div class="user-profile-header">
                <img src="<?php echo $user_image ?>" alt="User Avatar" class="user-avatar">
                <div class="user-info">
                    <h2><?php echo $name ?></h2>
                    <p><?php echo $dep_name ?></p>
                    <p><?php echo $major_name ?></p>
                    <div class="user-stats">
                        <div class="stat-box">
                            <i class="fa-solid fa-calendar-check"></i>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   <?php echo $count_events ?> Events
                        </div>
                        <div class="stat-box">   
                        <i class="fa-solid fa-magnifying-glass"></i>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    <?php echo $count_losts; ?> Lost Items
                        </div>
                        <div class="stat-box"> 
                            <i class="fa-solid fa-store"></i>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                      <?php echo $count_marketplaces ?> BookTrade
                        </div>
                    </div>
                </div>
            </div>

            <!-- Map Section -->
            <div class="dashboard-section">
                <h2 class="section-title">
                    <i class="fa-solid fa-map-location-dot"></i> Your Map Activity
                </h2>

                <div class="items-grid">
                    <div class="item-card">
                        <div class="item-actions">
                            <button class="action-btn" title="Edit">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </button>
                            <button class="action-btn delete-event-btn " title="Delete" >
                                <i class="fa-solid fa-trash-can "></i>
                            </button>
                        </div>
                        <h3>Saved Location</h3>
                        <p>Faculty Cafeteria</p>
                        <div class="map-preview">
                            <img src="imgs/cafeteria.jpeg" alt="Cafeteria Preview">
                            <div class="map-label">IT Building Cafeteria</div>
                        </div>
                        <div class="item-meta">
                            <span><i class="fa-solid fa-bookmark"></i> Saved location</span>
                        </div>
                    </div>
                </div>

                <div class="view-all">
                    <a href="map.php">View Full Map →</a>
                </div>
            </div>

            <!-- Upcoming Events Section -->
            <div class="dashboard-section">
                <h2 class="section-title">
                    <i class="fa-regular fa-calendar"></i> Your Registered Events
                </h2>

                <div class="items-grid">

                <?php
                    $sql1 = mysqli_query($con, "SELECT * FROM student_events WHERE student_id = '$S_ID'");

                    while ($row1 = mysqli_fetch_array($sql1)) {

                        $enrollment_id = $row1['id'];
                        $event_id      = $row1['event_id'];

                        $sql2 = mysqli_query($con, "SELECT * from events WHERE id = '$event_id'");
                        $row2 = mysqli_fetch_array($sql2);

                        $event_name        = $row2['name'];
                        $event_description = $row2['description'];
                        $event_date        = $row2['date'];

                    ?>

                    <div class="item-card">
                        <div class="item-actions">

                            <a href="./CancelErollment.php?enrollment_id=<?php echo $enrollment_id ?>" class="action-btn delete-event-btn" title="Cancel Registration"
                                data-event="Tech Conference 2025">
                                <i class="fa-solid fa-trash-can"></i>
                            </a>

                        </div>
                        <h3><?php echo $event_name ?></h3>
                        <p><?php echo $event_description ?></p>
                        <div class="item-meta">
                            <span><i class="fa-solid fa-calendar-days"></i>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                          <?php echo $event_date ?></span>
                            <span class="status status-registered">Registered</span>
                        </div>
                    </div>

                    <?php
                    }?>




                </div>

                <div class="view-all">
                    <a href="./event.php">View All Events →</a>
                </div>
            </div>

            <!-- Lost & Found Items Section -->
            <div class="dashboard-section">
                <h2 class="section-title">
                    <i class="fa-solid fa-magnifying-glass"></i> Your Found Items
                </h2>

                <div class="items-grid">

                <?php
                    $sql1 = mysqli_query($con, "SELECT * FROM lost_founds WHERE student_id = '$S_ID' AND status = 1 ORDER BY id DESC");

                    while ($row1 = mysqli_fetch_array($sql1)) {

                        $lost_id      = $row1['id'];
                        $lost_name    = $row1['name'];
                        $last_seen_in = $row1['last_seen_in'];
                        $status       = $row1['status'];
                        $created_at   = $row1['created_at'];

                    ?>
                    <div class="item-card">
                    <span id="lostID" style="display: none;"><?php echo $lost_id?></span>
                        <div class="item-actions">
                            <a href="./edit-item.php?item_id=<?php echo $lost_id ?>" class="action-btn" title="Edit">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                            <a href="./FoundItem.php?item_id=<?php echo $lost_id ?>" class="action-btn delete-item-btn" title="Delete" data-item="Student ID">
                                <i class="fa-solid fa-trash-can"></i>
                            </a>
                        </div>
                        <h3>Found:                                                                                                                                                                                                             <?php echo $lost_name ?></h3>
                        <p><?php echo $last_seen_in ?></p>
                        <div class="item-meta">
                        <?php
                            $createdDate = new DateTime($created_at);
                                $now         = new DateTime();
                                $diff        = $createdDate->diff($now);

                                if ($diff->d > 0) {
                                    $timeAgo = $diff->d . ' days ago';
                                } elseif ($diff->h > 0) {
                                    $timeAgo = $diff->h . ' hours ago';
                                } elseif ($diff->i > 0) {
                                    $timeAgo = $diff->i . ' minutes ago';
                                } else {
                                    $timeAgo = 'just now';
                                }
                            ?>

                            <span><i class="fa-solid fa-clock"></i><?php echo $timeAgo ?></span>
                            <span class="status                                                                                                                                                                                                                                                                                                                                          <?php echo $status == 1 || $status == 3 ? 'status-missing' : 'status-found' ?>"><?php echo $status == 1 ? 'Still Missing' : ('Found') ?></span>
                        </div>
                    </div>
                    <?php
                    }?>

                </div>

                <div class="view-all">
                    <a href="./lost.php">View All Items →</a>
                </div>
            </div>

            <!-- Marketplace Section -->
            <div class="dashboard-section">
                <h2 class="section-title">
                    <i class="fa-solid fa-store"></i> Your BookTrade Activity
                </h2>

                <div class="items-grid">
                <?php
                    $sql1 = mysqli_query($con, "SELECT * FROM marketplaces WHERE student_id = '$S_ID' AND status = 'Available'  ORDER BY id DESC");

                    while ($row1 = mysqli_fetch_array($sql1)) {

                        $marketplace_id          = $row1['id'];
                        $marketplace_name        = $row1['name'];
                        $marketplace_description = $row1['description'];
                        $status                  = $row1['status'];
                        $marketplace_created_at  = $row1['created_at'];
                        $category_id             = $row1['category_id'];
                        $marketplace_image       = $row1['image'];
                        $intresets_counts        = $row1['intresets_counts'];

                        $sql2 = mysqli_query($con, "SELECT * FROM categories WHERE id = '$category_id'");
                        $row2 = mysqli_fetch_array($sql2);

                        $category_name = $row2['name'];

                    ?>

                    <div class="item-card">
                        <div class="item-actions">
                            <a href="./Edit-Marketplace.php?marketplace_id=<?php echo $marketplace_id ?>" class="action-btn" title="Edit" id="<?php echo $marketplace_id ?>">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                            <a href="./DeleteMarketPlace.php?marketplace_id=<?php echo $marketplace_id ?>" class="action-btn delete-marketplace-btn" title="Delete"
                                data-item="Calculus Textbook">
                                <i class="fa-solid fa-trash-can"></i>
                            </a>
                        </div>
                        <div class="marketplace-item">
                            <!-- <img src="imgs/calculus.jpg" alt="Calculus Textbook"> -->
                            <div class="marketplace-info">
                                <span id="marketID" style="display: none;"><?php echo $marketplace_id?></span>
                                <h4><?php echo $marketplace_name ?></h4>
                                <p><?php echo $marketplace_description ?></p>
                                <p><?php echo $category_name ?></p>
                            </div>
                        </div>
                        <div class="item-meta">

                        <?php
                            $marketplaceCreatedDate = new DateTime($marketplace_created_at);
                                $marketplaceNow         = new DateTime();
                                $marketplaceDiff        = $marketplaceCreatedDate->diff($marketplaceNow);

                                if ($marketplaceDiff->d > 0) {
                                    $marketplaceTimeAgo = $marketplaceDiff->d . ' days ago';
                                } elseif ($marketplaceDiff->h > 0) {
                                    $marketplaceTimeAgo = $marketplaceDiff->h . ' hours ago';
                                } elseif ($marketplaceDiff->i > 0) {
                                    $marketplaceTimeAgo = $marketplaceDiff->i . ' minutes ago';
                                } else {
                                    $marketplaceTimeAgo = 'just now';
                                }
                            ?>

                            <span><i class="fa-solid fa-clock"></i> Posted                                                                                                                                                                                                                                                                                                                                                                                   <?php echo $marketplaceTimeAgo ?></span>
                            <a href="chat.php"><span class="interested"><?php echo $intresets_counts ?> interested</span></a>
                        </div>
                    </div>
                    <?php }?>


                </div>

                <div class="view-all">
                    <a href="./marketplace.php">View All Marketplace Items →</a>
                </div>
            </div>

            <!-- Confirmation Dialog -->
            <div class="confirmation-dialog" id="confirmationDialog">
                <div class="confirmation-box">
                    <h3>Confirm Deletion</h3>
                    <p id="confirmationMessage">Are you sure you want to delete this item?</p>
                    <div class="confirmation-buttons">
                        <button class="cancel-btn" id="cancelDelete">Cancel</button>
                        <button class="confirm-btn" id="confirmDelete" style="background-color: #d32f2f;">Delete</button>
                    </div>
                </div>
            </div>

            <!-- Recent Announcements Section -->
            <div class="dashboard-section">
                <h2 class="section-title">
                    <i class="fa-solid fa-bullhorn"></i> Recent Announcements
                </h2>

                <div class="items-grid">

                <?php
                    $sql5555 = mysqli_query($con, "SELECT * FROM announcements WHERE is_important = 1 AND status = 'Available'");

                    while ($row5555 = mysqli_fetch_array($sql5555)) {

                        $announcement_id          = $row5555['id'];
                        $announcement_name        = $row5555['title'];
                        $announcement_description = $row5555['description'];
                        $announcement_created_at  = $row5555['created_at'];
                        $category_id              = $row5555['category_id'];
                        $status                   = $row5555['status'];

                        $sql4444 = mysqli_query($con, "SELECT * FROM categories WHERE id = '$category_id'");
                        $row4444 = mysqli_fetch_array($sql4444);

                        $category_name = $row4444['name'];

                    ?>

                    <div class="item-card">

                    <?php
                        $announcementsCreatedDate = new DateTime($marketplace_created_at);
                            $announcementplaceNow     = new DateTime();
                            $announcementsplaceDiff   = $announcementsCreatedDate->diff($announcementplaceNow);

                            if ($announcementsplaceDiff->d > 0) {
                                $announcementsplaceTimeAgo = $announcementsplaceDiff->d . ' days ago';
                            } elseif ($announcementsplaceDiff->h > 0) {
                                $announcementsplaceTimeAgo = $announcementsplaceDiff->h . ' hours ago';
                            } elseif ($announcementsplaceDiff->i > 0) {
                                $announcementsplaceTimeAgo = $announcementsplaceDiff->i . ' minutes ago';
                            } else {
                                $announcementsplaceTimeAgo = 'just now';
                            }
                        ?>


                        <h3><?php echo $announcement_name ?></h3>
                        <p><?php echo $announcement_description ?></p>
                        <div class="item-meta">
                            <span><i class="fa-solid fa-clock"></i>                                                                                                                                                                                                          <?php echo $announcementsplaceTimeAgo ?></span>
                            <span><?php echo $category_name ?></span>
                        </div>
                    </div>
                    <?php }?>
                </div>

                <div class="view-all">
                    <a href="./announcement.php">View All Announcements →</a>
                </div>
            </div>
        </div>
    </div>
    <script src="../js/home.js"></script>
</body>

</html>