<?php
    session_start();

    include "../Connect.php";

    $S_ID        = $_SESSION['S_Log'];
    $category_id_selected = $_GET['category_id'];

    $eventsSql = "SELECT * from events WHERE status != 'Deleted' ORDER BY id DESC";

    if ($category_id_selected) {

        if ($category_id_selected == 'all') {
            $eventsSql = "SELECT * from events WHERE status != 'Deleted' ORDER BY id DESC";
        } else {
            $eventsSql = "SELECT * from events WHERE status != 'Deleted' AND category_id = '$category_id_selected' ORDER BY id DESC";
        }
    }

    if (! $S_ID) {

        echo '<script language="JavaScript">
     document.location="../login.php";
    </script>';

    } else {

        $sql1 = mysqli_query($con, "select * from students where id='$S_ID'");
        $row1 = mysqli_fetch_array($sql1);

        $name  = $row1['fname'] . ' ' . $row1['lname'];
        $email = $row1['email'];

    }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>UniKey - Events</title>
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
                          <a href="./logout.php" title="Logout" style="color: inherit; margin-left: 15px;">
                        <i class="fa-solid fa-right-from-bracket"></i>
                        </a>
                    </span>
                </div>
            </div>
            <!-- End Head -->
            <h1 class="p-relative">Upcoming Events</h1>
            <!-- Filter Section -->
            <div class="filter-section p-15 bg-white rad-6 m-20">
                <label for="category_id_filter">Filter by:</label>
                <select id="category_id_filter" class="p-10">
                    <option value="all">All</option>
                    <?php
                        $sql1 = mysqli_query($con, "SELECT * from categories WHERE type = 'events'");

                        while ($row1 = mysqli_fetch_array($sql1)) {

                            $category_id   = $row1['id'];
                            $category_name = $row1['name'];

                        ?>
<option value="<?php echo $category_id ?>" <?php echo $category_id_selected == $category_id ? 'selected' : ''?>><?php echo $category_name ?></option>
<?php
}?>
                </select>

                <script>

document.getElementById('category_id_filter').addEventListener('change', function() {
    document.location = `./event.php?category_id=${this.value}`
})
</script>
            </div>
            <div class="courses-page d-grid m-20 gap-20">

            <?php
                $sql1 = mysqli_query($con, $eventsSql);

                while ($row1 = mysqli_fetch_array($sql1)) {

                    $event_id    = $row1['id'];
                    $event_name  = $row1['name'];
                    $event_image = $row1['image'];
                    $status      = $row1['status'];
                    $count       = $row1['count'];
                    $date        = $row1['date'];
                    $description = $row1['description'];
                    $category_id = $row1['category_id'];

                    $sql2 = mysqli_query($con, "SELECT * from categories WHERE id = '$category_id'");
                    $row2 = mysqli_fetch_array($sql2);

                    $category_name = $row2['name'];

                    $sql3 = mysqli_query($con, "SELECT COUNT(id) AS members_count from student_events WHERE event_id = '$event_id'");
                    $row3 = mysqli_fetch_array($sql3);

                    $members_count = $row3['members_count'];

                ?>
                <div class="course bg-white rad-6 p-relative <?php echo $status === 'Expired' ? 'expired' : '' ?>">
                    <img class="cover" src="../Admin_Dashboard/<?php echo $event_image ?>" alt="" />
                    <div class="p-20">
                        <h4 class="m-0"><?php echo $name ?></h4>
                        <p class="description c-grey mt-15 fs-14">
                        <?php echo $description ?>
                        </p>
                        <div class="tags mt-10">
                        <span class="tag"><?php echo $category_name ?></span>
                            <!-- <span class="tag">Development</span> -->
                        </div>
                        <div class="reminder-icon">
                            <i class="fa-regular fa-bell bell"></i>
                        </div>
                    </div>
                    <div class="info p-15 p-relative between-flex">
                        <span class="title bg-blue c-white btn-shape" id="see-<?php echo $event_id ?>" onclick="onClick(<?php echo $event_id ?>)">More Details</span>
                        <span class="c-grey">
                            <i class="fa-regular fa-user"></i>
                            <?php echo $members_count ?>/<?php echo $count ?>
                        </span>
                        
                        <span class="c-grey">
                            <i class="fa-solid fa-calendar-days"></i>
                            <?php echo $date ?>
                        </span>
                        
                        <!-- <button class="reminder-btn bg-green c-white btn-shape">Set Up Reminder</button> -->
                    </div>
                </div>

                <?php
}?>


            </div>
        </div>
    </div>
    <script>
            const bellIcon = document.querySelector('.reminder-icon i');

            bellIcon.addEventListener('click', function () {
                if (bellIcon.classList.contains('fa-regular')) {
                    bellIcon.classList.remove('fa-regular');
                    bellIcon.classList.add('fa-solid');
                } else {
                    bellIcon.classList.remove('fa-solid');
                    bellIcon.classList.add('fa-regular');
                }
            });
            function navigateToPage(url) {
                    window.location.href = url;
                }
                const onClick = (id) => {
                    navigateToPage(`event_details.php?event_id=${id}`);
                }
            document.addEventListener("DOMContentLoaded", function () {
                document.getElementById("see").addEventListener("click", function () {
                    navigateToPage("event_details.html");
                });
            });
    </script>
</body>

</html>