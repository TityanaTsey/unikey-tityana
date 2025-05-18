
<?php
    session_start();

    include "../Connect.php";

    $S_ID   = $_SESSION['S_Log'];
    $filter = $_GET['filter'];
    $place  = $_GET['place'];

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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UniKey - Portals</title>
    <!-- favicon -->
    <link rel="icon" type="image/png" href="favicon/favicon-96x96.png" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="favicon/favicon.svg" />
    <link rel="shortcut icon" href="favicon/favicon.ico" />
    <!-- css -->
    <link rel="stylesheet" href="../css/portals.css">
    <link rel="stylesheet" href="../css/framework.css">
    <link rel="stylesheet" href="../css/side.css">
    <link rel="stylesheet" href="../css/all.min.css">
    <!-- fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <div class="page d-flex">
        <!-- Sidebar (identical to Lost & Found) -->
        <div class="sidebar bg-white p-20 p-relative">
            <h3 class="p-relative txt-c mt-0">UniKey</h3>
            <?php require './asaid.php'?>
        </div>

        <!-- Main Content -->
        <div class="content w-full">
            <!-- Header (identical to Lost & Found) -->
            <div class="head bg-white p-15 between-flex">
                <div class="user-display p-relative d-flex align-center">
                      <a href="./logout.php" title="Logout" style="color: inherit; margin-left: 15px;">
                    <i class="fa-solid fa-user-circle fa-lg c-main mr-10"></i>
                    </a>
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

            <!-- Page Title -->
            <div class="short-header">
                <h1 class="p-relative">Portals</h1>
            </div>

            <!-- Welcome Section -->
            <div class="welcome bg-white rad-10 p-20 mb-20 txt-c ">
                <h2>Access University Portals</h2>
                <p class="c-gray">Explore and access various university portals for students, faculty, and staff.</p>
            </div>

            <!-- Portals Grid (Fixed Structure) -->
            <div class="wrapper d-grid gap-20">
                <div class="portals-grid d-grid gap-20">
                    <div class="portal-box bg-white rad-10 p-20" id="studentPortal">
                        <i class="fa-solid fa-graduation-cap fa-3x c-olive"></i>
                        <h3 class="c-olive">Student Portal</h3>
                        <p class="c-gray">Access your academic records, register for courses, and view your schedule.</p>
                        <div class="extra-links">
                            <a href="#" class="d-block p-5 c-gray hover-c-black">Academic Records</a>
                            <a href="#" class="d-block p-5 c-gray hover-c-black">Course Registration</a>
                            <a href="#" class="d-block p-5 c-gray hover-c-black">Class Schedule</a>
                        </div>
                        <button class="btn-shape"
                            onclick="togglePortal('studentPortal')">See More</button>
                    </div>

                    <div class="portal-box bg-white rad-10 p-20" id="elearningPortal">
                        <i class="fa-solid fa-laptop-code fa-3x c-olive"></i>
                        <h3 class="c-olive">E-Learning Portal</h3>
                        <p class="c-gray">Access course materials, submit assignments, and interact with instructors.</p>
                        <div class="extra-links">
                            <a href="#" class="d-block p-5 c-gray hover-c-black">Moodle</a>
                            <a href="#" class="d-block p-5 c-gray hover-c-black">Lecture Slides</a>
                            <a href="#" class="d-block p-5 c-gray hover-c-black">Assignment Submission</a>
                        </div>
                        <button class="btn-shape"
                            onclick="togglePortal('elearningPortal')">See More</button>
                    </div>

                    <div class="portal-box bg-white rad-10 p-20" id="libraryPortal">
                        <i class="fa-solid fa-book fa-3x c-olive"></i>
                        <h3 class="c-olive">Library Portal</h3>
                        <p class="c-gray">Search for books, reserve materials, and access digital libraries.</p>
                        <div class="extra-links">
                            <a href="#" class="d-block p-5 c-gray hover-c-black">Book Search</a>
                            <a href="#" class="d-block p-5 c-gray hover-c-black">E-Journals</a>
                            <a href="#" class="d-block p-5 c-gray hover-c-black">Borrowed Books</a>
                        </div>
                        <button class="btn-shape"
                            onclick="togglePortal('libraryPortal')">See More</button>
                    </div>

                    <div class="portal-box bg-white rad-10 p-20" id="emailPortal">
                        <i class="fa-solid fa-envelope fa-3x c-olive"></i>
                        <h3 class="c-olive">Email Portal</h3>
                        <p class="c-gray">Check your university email and communicate with staff and peers.</p>
                        <div class="extra-links">
                            <a href="#" class="d-block p-5 c-gray hover-c-black">Inbox</a>
                            <a href="#" class="d-block p-5 c-gray hover-c-black">Compose</a>
                            <a href="#" class="d-block p-5 c-gray hover-c-black">Contacts</a>
                        </div>
                        <button class="btn-shape" onclick="togglePortal('emailPortal')">See
                            More</button>
                    </div>

                    <div class="portal-box bg-white rad-10 p-20" id="financialPortal">
                        <i class="fa-solid fa-wallet fa-3x c-olive"></i>
                        <h3 class="c-olive">Financial Services</h3>
                        <p class="c-gray">Pay tuition, view invoices, and manage financial aid or scholarships.</p>
                        <div class="extra-links">
                            <a href="#" class="d-block p-5 c-gray hover-c-black">Tuition Fees</a>
                            <a href="#" class="d-block p-5 c-gray hover-c-black">Payment History</a>
                            <a href="#" class="d-block p-5 c-gray hover-c-black">Scholarships</a>
                        </div>
                        <button class="btn-shape"
                            onclick="togglePortal('financialPortal')">See More</button>
                    </div>

                    <div class="portal-box bg-white rad-10 p-20" id="internshipPortal">
                        <i class="fa-solid fa-briefcase fa-3x c-olive"></i>
                        <h3 class="c-olive">Internship & Career Services</h3>
                        <p class="c-gray">Find internships, job opportunities, and attend career events.</p>
                        <div class="extra-links">
                            <a href="#" class="d-block p-5 c-gray hover-c-black">Job Listings</a>
                            <a href="#" class="d-block p-5 c-gray hover-c-black">Resume Builder</a>
                            <a href="#" class="d-block p-5 c-gray hover-c-black">Career Events</a>
                        </div>
                        <button class="btn-shape"
                            onclick="togglePortal('internshipPortal')">See More</button>
                    </div>

                    <div class="portal-box bg-white rad-10 p-20" id="housingPortal">
                        <i class="fa-solid fa-building fa-3x c-olive"></i>
                        <h3 class="c-olive">Housing Services</h3>
                        <p class="c-gray">Apply for dorms, submit maintenance requests, and view housing rules.</p>
                        <div class="extra-links">
                            <a href="#" class="d-block p-5 c-gray hover-c-black">Dorm Application</a>
                            <a href="#" class="d-block p-5 c-gray hover-c-black">Maintenance Requests</a>
                            <a href="#" class="d-block p-5 c-gray hover-c-black">Housing Handbook</a>
                        </div>
                        <button class="btn-shape"
                            onclick="togglePortal('housingPortal')">See More</button>
                    </div>

                    <div class="portal-box bg-white rad-10 p-20" id="healthPortal">
                        <i class="fa-solid fa-heartbeat fa-3x c-olive"></i>
                        <h3 class="c-olive">Health Services</h3>
                        <p class="c-gray">Book clinic appointments, view medical history, and get health advice.</p>
                        <div class="extra-links">
                            <a href="#" class="d-block p-5 c-gray hover-c-black">Appointments</a>
                            <a href="#" class="d-block p-5 c-gray hover-c-black">Medical Records</a>
                            <a href="#" class="d-block p-5 c-gray hover-c-black">Wellness Tips</a>
                        </div>
                        <button class="btn-shape"  onclick="togglePortal('healthPortal')">See
                            More</button>
                    </div>

                    <div class="portal-box bg-white rad-10 p-20" id="transportPortal">
                        <i class="fa-solid fa-bus fa-3x c-olive"></i>
                        <h3 class="c-olive">Transport Services</h3>
                        <p class="c-gray">Track university shuttles and manage parking permits.</p>
                        <div class="extra-links">
                            <a href="#" class="d-block p-5 c-gray hover-c-black">Shuttle Tracker</a>
                            <a href="#" class="d-block p-5 c-gray hover-c-black">Parking Application</a>
                            <a href="#" class="d-block p-5 c-gray hover-c-black">Transport Support</a>
                        </div>
                        <button class="btn-shape"
                            onclick="togglePortal('transportPortal')">See More</button>
                    </div>

                    <!-- ... other portal boxes ... -->
                </div>
            </div>
        </div>
    </div>

    <script>
        function togglePortal(id) {
            document.getElementById(id).classList.toggle("expanded");
        }
    </script>
</body>

</html>