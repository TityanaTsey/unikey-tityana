<?php
    session_start();

    include "../Connect.php";

    $S_ID                 = $_SESSION['S_Log'];
    $category_id_selected = $_GET['category_id'];

    $annSql = "SELECT * FROM announcements WHERE status != 'DELETED' ORDER BY id DESC";

    if ($category_id_selected) {

        $annSql = "SELECT * FROM announcements WHERE status != 'DELETED' AND category_id = '$category_id_selected' ORDER BY id DESC";
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
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>UniKey - Announcements</title>
    <!-- favicon -->
    <link rel="icon" type="image/png" href="favicon/favicon-96x96.png" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="favicon/favicon.svg" />
    <link rel="shortcut icon" href="favicon/favicon.ico" />
    <link rel="apple-touch-icon" sizes="180x180" href="favicon/apple-touch-icon.png" />
    <link rel="manifest" href="favicon/site.webmanifest" />
    <!-- css -->
    <link rel="stylesheet" href="../css/announcement.css" />
    <link rel="stylesheet" href="../css/all.min.css" />
    <link rel="stylesheet" href="../css/framework.css" />
    <link rel="stylesheet" href="../css/side.css" />
    <!-- google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <div class="page d-flex content">
        <!-- Sidebar -->
        <div class="sidebar bg-white p-20 p-relative">
            <a href="landing.html">
                <h3 class="p-relative txt-c mt-0">UniKey</h3>
            </a>
            <?php require './asaid.php'?>
        </div>

        <!-- Content -->
        <div class="content w-full full-content">
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

            <!-- Main Content -->
        <div class="wrapper">
            <div class="short-header">
                <h1 class="p-relative">Announcements</h1>
            </div>
            <div class="filter-section">
                <!-- <select name="type" id="filter-type" onchange="filterItems()">
                    <option value="" disabled selected>Filter By</option>
                    <option value="Electronics">Electronics</option>
                    <option value="Clothes">Clothes</option>
                    <option value="Wallet">Wallet</option>
                    <option value="jacket">Wallet</option>
                    <option value="other">Other</option>
                </select> -->
                <a href="./announcement.php" class="add-card-btn">All</a>
                <?php
                    $sql1 = mysqli_query($con, "SELECT * from categories WHERE type = 'events'");

                    while ($row1 = mysqli_fetch_array($sql1)) {

                        $category_id   = $row1['id'];
                        $category_name = $row1['name'];

                    ?>
                            <a href="./announcement.php?category_id=<?php echo $category_id; ?>" class="add-card-btn"><?php echo $category_name; ?></a>
<?php
}?>

            </div>
            <div class="latest-news p-20 bg-white rad-10 txt-c-mobile">
                <h2 class="mt-0 mb-20">Latest News</h2>

                <?php
                    $sql1 = mysqli_query($con, $annSql);

                    while ($row1 = mysqli_fetch_array($sql1)) {

                        $ann_id      = $row1['id'];
                        $ann_title   = $row1['title'];
                        $ann_image   = $row1['image'];
                        $status      = $row1['status'];
                        $description = $row1['description'];
                        $content     = $row1['content'];
                        $category_id = $row1['category_id'];
                        $date        = $row1['date'];

                        $sql2 = mysqli_query($con, "SELECT * from categories WHERE id = '$category_id'");
                        $row2 = mysqli_fetch_array($sql2);

                        $category_name = $row2['name'];

                    ?>

<?php if ($status == 'Available') {?>

                <div class="news-row d-flex align-center">
                    <!-- <i class="fa-solid fa-thumbtack"></i> -->
                    <img src="../Admin_Dashboard/<?php echo $ann_image ?>" alt="" />
                    <div class="info">
                        <h3><?php echo $ann_title ?></h3>
                        <p class="m-0 fs-14 c-grey"><?php echo $description ?></p>
                        <div class="tags">
                        <span class="tag"><?php echo $category_name ?></span>
                        </div>
                    </div>
                    <div class="for-left">
                        <div class="btn-shape bg-eee fs-13 label mb-5 "><?php echo $date ?></div>
                        <div class="btn-shape fs-13 label c-beige see" style="background-color: #314528;" id="btn-found" onclick="navigate(<?php echo $ann_id ?>)">See More...</div>
                    </div>
                </div>
                <?php } else {?>

                    <i class="fa-solid fa-circle-xmark time"></i>
                <div class="news-row d-flex align-center expired">
                    <img src="../Admin_Dashboard/<?php echo $ann_image ?>" alt="" />
                    <div class="info">
                        <h3><?php echo $ann_title ?></h3>
                        <p class="m-0 fs-14 c-grey"><?php echo $description ?></p>
                        <div class="tags">
                        <span class="tag"><?php echo $category_name ?></span>
                        </div>
                    </div>
                    <div class="for-left">
                        <div class="btn-shape bg-eee fs-13 label mb-5 ">8/7/2024</div>

                        
                    </div>
                </div>

                    <?php }}?>

                <!-- <div class="news-row d-flex align-center">
                    <img src="imgs/JU1.jpg" alt="" />
                    <div class="info">
                        <h3>Admission and Registration Unit</h3>
                        <p class="m-0 fs-14 c-grey">​Course Add/Drop Dates and Instructions</p>
                        <div class="tags">
                            <span class="tag">All</span>
                        </div>
                    </div>
                    <div class="for-left">
                        <div class="btn-shape bg-eee fs-13 label mb-5 ">7/3/2025</div>
                        <div class="btn-shape bg-eee fs-13 label c-beige see" style="background-color: #314528;">See More...</div>
                    </div>
                </div>
                <div class="news-row d-flex align-center">
                    <img src="imgs/JU2.JPG" alt="" />
                    <div class="info">
                        <h3>Graduate Programs For The Second Semester</h3>
                        <p class="m-0 fs-14 c-grey">(UJ) School of Graduate Studies has opened applications for admission to graduate programs for the second semester</p>
                        <div class="tags">
                            <span class="tag">Graduate</span>
                            <span class="tag">Business</span>
                            <span class="tag">Law</span>
                        </div>
                    </div>
                    <div class="for-left">
                        <div class="btn-shape bg-eee fs-13 label mb-5 ">11/2/2025</div>
                        <div class="btn-shape bg-eee fs-13 label c-beige see" style="background-color: #314528;">See More...</div>
                    </div>
                </div>
                <div class="news-row d-flex align-center">
                    <img src="imgs/whatsapp.jpeg" alt="" />
                    <div class="info">
                        <h3>UJ's Official WhatsApp Channel Launched</h3>
                        <p class="m-0 fs-14 c-grey">​The Media and Public Relations Unit at the University of Jordan (UJ) launched its official channel on WhatsApp.</p>
                        <div class="tags">
                            <span class="tag">All</span>
                            <span class="tag">IT</span>
                        </div>
                    </div>
                    <div class="for-left">
                        <div class="btn-shape bg-eee fs-13 label mb-5 ">3/2/2025</div>
                        <div class="btn-shape bg-eee fs-13 label c-beige see" style="background-color: #314528;">See More...</div>
                    </div>
                </div>
                <div class="news-row d-flex align-center">
                    <img src="imgs/JU3.jpeg" alt="" />
                    <div class="info">
                        <h3>Application For Admission To Graduate Programs Now Open</h3>
                        <p class="m-0 fs-14 c-grey">applications for admission to graduate programs for the first semester of the 2024/2025 academic year are now open.</p>
                        <div class="tags">
                            <span class="tag">Graduate</span>
                        </div>
                    </div>
                    <div class="for-left">
                        <div class="btn-shape bg-eee fs-13 label mb-5 ">16/1/2025</div>
                        <div class="btn-shape bg-eee fs-13 label c-beige see" style="background-color: #314528;">See More...</div>
                    </div>

                </div>
                <i class="fa-solid fa-circle-xmark time"></i>
                <div class="news-row d-flex align-center expired">

                    <img src="imgs/Dr. Yazan Hasouneh.jpg" alt="" />
                    <div class="info">
                        <h3>Workshop </h3>
                        <p class="m-0 fs-14 c-grey">Workshop By Prof. Yazan Hassona</p>
                        <div class="tags">
                            <span class="tag">Medicine</span>
                        </div>
                    </div>
                    <div class="for-left">
                        <div class="btn-shape bg-eee fs-13 label mb-5 ">3/1/2025</div>
                        <div class="btn-shape bg-eee fs-13 label c-beige see" style="background-color: #314528;">See More...</div>
                    </div>
                </div>
                <i class="fa-solid fa-circle-xmark time"></i>
                <div class="news-row d-flex align-center expired">
                    <img src="imgs/test.jpg" alt="" />
                    <div class="info">
                        <h3>Students Who Missed The University Proficiency Exam</h3>
                        <p class="m-0 fs-14 c-grey">​​It will be allowed for students who missed the university proficiency exam, to apply for make-up exam (in person) at
                        HEAC</p>
                        <div class="tags">
                            <span class="tag">Languages</span>
                        </div>
                    </div>
                    <div class="for-left">
                        <div class="btn-shape bg-eee fs-13 label mb-5 ">20/12/2024</div>
                        <div class="btn-shape bg-eee fs-13 label c-beige see" style="background-color: #314528;">See More...</div>
                    </div>
                </div>
                <i class="fa-solid fa-circle-xmark time"></i>
                <div class="news-row d-flex align-center expired">
                    <img src="imgs/students.jpg" alt="" />
                    <div class="info">
                        <h3>Information For New Students</h3>
                        <p class="m-0 fs-14 c-grey">Fees And Specialization Information for students in school of Arts</p>
                        <div class="tags">
                            <span class="tag">Art</span>
                        </div>
                    </div>
                    <div class="for-left">
                        <div class="btn-shape bg-eee fs-13 label mb-5 ">8/7/2024</div>
                        <div class="btn-shape bg-eee fs-13 label c-beige see" style="background-color: #314528;">See More...</div>
                    </div>
                </div> -->
            </div>

        </div>
        </div>

    <script>
            function navigateToPage(url) {
                window.location.href = url;
            }

            const navigate = (id) => {

navigateToPage(`./ann-details.php?ann_id=${id}`)
}

            // document.addEventListener("DOMContentLoaded", function () {
            //     document.getElementById("btn-found").addEventListener("click", function () {
            //         navigateToPage("ann-details.html");
            //     });
            // });
    </script>

</body>

</html>
