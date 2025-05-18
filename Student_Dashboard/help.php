<?php
session_start();
 include "../Connect.php";

    $S_ID   = $_SESSION['S_Log'];
     if (! $S_ID) {

        echo '<script language="JavaScript">
     document.location="../login.php";
    </script>';

    } else {

        $sql1 = mysqli_query($con, "select * from students where id='$S_ID'");
        $row1 = mysqli_fetch_array($sql1);

        $name          = $row1['fname'] . ' ' . $row1['lname'];
    }
?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>UniKey - Help & Support</title>
    <!-- favicon -->
    <link rel="icon" type="image/png" href="favicon/favicon-96x96.png" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="favicon/favicon.svg" />
    <link rel="shortcut icon" href="favicon/favicon.ico" />
    <link rel="apple-touch-icon" sizes="180x180" href="favicon/apple-touch-icon.png" />
    <link rel="manifest" href="favicon/site.webmanifest" />
    <!-- css -->
    <link rel="stylesheet" href="../css/all.min.css" />
    <link rel="stylesheet" href="../css/framework.css" />
    <link rel="stylesheet" href="../css/help.css" />
    <link rel="stylesheet" href="../css/side.css" />
    <!-- <link rel="stylesheet" href="../css/master.css" /> -->
    <!-- fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;500&display=swap" rel="stylesheet" />
</head>

<body>
    <div class="page d-flex">
        <div class="sidebar bg-white p-20 p-relative">
            <a href="landing.html"><h3 class="p-relative txt-c mt-0">UniKey</h3></a>
            <ul>
                <li>
                    <a class="d-flex align-center fs-14 c-black rad-6 p-10" href="index.php">
                        <i class="fa-regular fa-chart-bar fa-fw"></i>
                        <span>Home</span>
                    </a>
                </li>
              
                
                <li>
                    <a class="d-flex align-center fs-14 c-black rad-6 p-10" href="lost.php">
                        <i class="fa-solid fa-magnifying-glass"></i>
                        <span>Lost/Found</span>
                    </a>
                </li>
               
                <li>
                    <a class="d-flex align-center fs-14 c-black rad-6 p-10" href="event.php">
                        <i class="fa-regular fa-calendar"></i>
                        <span>Events</span>
                    </a>
                </li>
                <li>
                    <a class="d-flex align-center fs-14 c-black rad-6 p-10" href="announcement.php">
                        <i class="fa-solid fa-bullhorn"></i>
                        <span>Announcements</span>
                    </a>
                </li>
                <li>
                    <a class="d-flex align-center fs-14 c-black rad-6 p-10" href="marketplace.php">
                        <i class="fa-solid fa-store"></i>
                        <span>BookTrade</span>
                    </a>
                </li>
                 <li>
                    <a class="d-flex align-center fs-14 c-black rad-6 p-10" href="portals.php">
                        <i class="fa-solid fa-door-open"></i>
                        <span>Portals</span>
                    </a>
                </li>
                <li>
                    <a class="d-flex align-center fs-14 c-black rad-6 p-10" href="map.php">
                        <i class="fa-solid fa-map"></i>
                        <span>Map</span>
                    </a>
                </li>
                <li>
                    <a class="d-flex align-center fs-14 c-black rad-6 p-10" href="settings.php">
                        <i class="fa-solid fa-gear fa-fw"></i>
                        <span>Settings</span>
                    </a>
                </li>
                <li>
                    <a class="active d-flex align-center fs-14 c-black rad-6 p-10" href="help.php">
                        <i class="fa-solid fa-circle-info"></i>
                        <span>Help</span>
                    </a>
                </li>
            </ul>
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
            <h1 class="p-relative">Help & Support</h1>
            <div class="wrapper d-grid gap-20">

                <!-- Section 1: Welcome Section -->
                <div class="welcome-section">
                    <h1>How can we help?</h1>
                    <input type="text" class="p-10" placeholder="Describe your issue or question..."
                        style="width: 100%; max-width: 600px; margin-top: 20px;">
                </div>

                <!-- Section 2: Services Grid -->
                <div class="services-grid">
                    <!-- FAQ Box -->
                    <div class="service-box faq">
                        <img src="../imgs/faq.png" alt="FAQ">
                        <h3>FAQ</h3>
                        <p>Find answers to frequently asked questions about UniKey.</p>
                        <ul>
                            <li>How do I reset my password?</li>
                            <li>How do I report a lost item?</li>
                            <li>How do I access the university map?</li>
                        </ul>
                        <button  class="save fs-14 bg-olive c-beige b-none w-fit btn-shape" style="cursor: pointer;">View FAQ</button>

                    </div>

                    <!-- User Guide & Tutorials Box -->
                    <div class="service-box">
                        <img src="../imgs/guide.png" alt="User Guide">
                        <h3>User Guide & Tutorials</h3>
                        <p>Step-by-step guides and tutorials to help you use UniKey.<br> Here you'll find detailed instructions on how to use UniKey's features.</p>
                        <button class="save fs-14 bg-olive c-beige b-none w-fit btn-shape" style="cursor: pointer;">View Tutorials</button>

                    </div>

                    <!-- Contact Support Box -->
                    <div class="service-box">
                        <img src="../imgs/contact.png" alt="Contact Support">
                        <h3>Contact Support</h3>
                        <p>Reach out to our support team for personalized assistance.</p>
                        <p>Email: support@unikey.edu<br>Phone: +962 6 535 5000</p>
                        <button class="save fs-14 bg-olive c-beige b-none w-fit btn-shape" style="cursor: pointer;" onclick="sendEmail()">Contact Us</button>                            
                    </div>

                    <!-- Troubleshooting Guide Box -->
                    <div class="service-box">
                        <img src="../imgs/trouble.png" alt="Troubleshooting">
                        <h3>Troubleshooting Guide</h3>
                        <p>Solve common issues with UniKey.</p>
                        <div class="reminders p-20 bg-white rad-10 p-relative">
                            <ul class="m-0">
                                <li class="d-flex align-center mt-15">
                                    <span class="key bg-olive mr-15 d-block rad-half"></span>
                                    <div class="pl-15 olive">
                                        <p class="fs-14 fw-bold mt-0 mb-5">Login Issues</p>
                                    </div>
                                </li>
                                <li class="d-flex align-center mt-15">
                                    <span class="key bg-olive mr-15 d-block rad-half"></span>
                                    <div class="pl-15 olive">
                                        <p class="fs-14 fw-bold mt-0 mb-5">Lost & Found Errors</p>
                                    </div>
                                </li>
                                <li class="d-flex align-center mt-15">
                                    <span class="key bg-olive mr-15 d-block rad-half"></span>
                                    <div class="pl-15 olive">
                                        <p class="fs-14 fw-bold mt-0 mb-5">Slow Performance</p>
                                    </div>
                                </li>
                                <li class="d-flex align-center mt-15">
                                    <span class="key bg-olive mr-15 d-block rad-half"></span>
                                    <div class="pl-15 olive">
                                        <p class="fs-14 fw-bold mt-0 mb-5">More</p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Feedback & Suggestions Box -->
                    <div class="service-box ">
                        <img src="../imgs/feed.png" alt="Feedback">
                        <h3>Feedback & Suggestions</h3>
                        <p>Share your feedback and suggestions to improve UniKey.</p>
                        <form>
                            <input class="d-block mb-20 w-full p-10 b-none bg-eee rad-6" type="text" placeholder="Title" />
                            <textarea class="d-block mb-20 w-full p-10 b-none bg-eee rad-6" placeholder="Your Thought"></textarea>
                            <button class="save fs-14 bg-olive c-beige b-none w-fit btn-shape" style="cursor: pointer;">Save</button>                            
                        </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script>
        function sendEmail() {
                window.location.href = "mailto:unikey2025@gmail.com?subject=Contact Us&body=Please Tell Us Your Suggestion.";
            }

    </script>
</body>

</html>