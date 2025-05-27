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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UniKey - Portals</title>
    <!-- favicon -->
    <link rel="icon" type="image/png" href="../favicon/favicon-96x96.png" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="../favicon/favicon.svg" />
    <link rel="shortcut icon" href="../favicon/favicon.ico" />
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
            <a href="landing.html">
                <h3 class="p-relative txt-c mt-0">UniKey</h3>
            </a>
            <?php require './asaid.php'?>
        </div>

        <!-- Main Content -->
        <div class="content w-full">
            <!-- Header (identical to Lost & Found) -->
              <?php require './navbar.php'?>

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
                            <a href="https://regapp.ju.edu.jo/regapp/" class="d-block p-5 c-gray hover-c-black">student registration </a>
                            <a href="https://juexams.com/moodle/" class="d-block p-5 c-gray hover-c-black">juexames</a>
                            <a href="https://elearning.ju.edu.jo/" class="d-block p-5 c-gray hover-c-black"> e-learning</a>
                        </div>
                        <button class="btn-shape" 
                            onclick="togglePortal('studentPortal')">See More</button>
                    </div>
                    
                    <div class="portal-box bg-white rad-10 p-20" id="elearningPortal">
                        <i class="fa-solid fa-building-columns  fa-3x c-olive"></i>
                     
                        <h3 class="c-olive">University Portal</h3>
                        <p class="c-gray">Official JU links for website access, complaints, and LinkedIn updates..</p>
                        <div class="extra-links">
                            <a href="https://www.ju.edu.jo/ar/arabic/Home.aspx" class="d-block p-5 c-gray hover-c-black">official website for univirsity</a>
                            <a href="https://eservices.ju.edu.jo/complaintsys/login.aspx" class="d-block p-5 c-gray hover-c-black">complaints (مركز الشكاوي والاقتراحات )</a>
                            <a href="https://www.linkedin.com/school/university-of-Jordan/posts/?feedView=all" class="d-block p-5 c-gray hover-c-black">JU on linkedin</a>
                        </div>
                        <button class="btn-shape"
                            onclick="togglePortal('elearningPortal')">See More</button>
                    </div>
                    
                    <div class="portal-box bg-white rad-10 p-20" id="libraryPortal">
                        <i class="fa-solid fa-book fa-3x c-olive"></i>
                        <h3 class="c-olive">Library Portal</h3>
                        <p class="c-gray">Search for books, reserve materials, and access digital libraries.</p>
                        <div class="extra-links">
                            <a href=" https://library.ju.edu.jo/NEWLIBRARY/EN_Library/Default.aspx" class="d-block p-5 c-gray hover-c-black">Library</a>
                           <!-- <a href="#" class="d-block p-5 c-gray hover-c-black">E-Journals</a>
                            <a href="#" class="d-block p-5 c-gray hover-c-black">Borrowed Books</a>-->
                        </div>
                        <button class="btn-shape" 
                            onclick="togglePortal('libraryPortal')">See More</button>
                    </div>
                    
                  <!--  <div class="portal-box bg-white rad-10 p-20" id="emailPortal">
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
                    -->
                    <div class="portal-box bg-white rad-10 p-20" id="financialPortal">
                        <i class="fa-solid fa-user-tie fa-3x c-olive"></i>
                        
                        <h3 class="c-olive">Deanship of Student Affairs</h3>
                        <p class="c-gray">Manage student services, activities,with the Deanship of Student Affairs.</p>
                        <div class="extra-links">
                            <a href="https://studentaffairs.ju.edu.jo/Home.aspx" class="d-block p-5 c-gray hover-c-black">Official Deanship of Student Affairs</a>
                            <a href="https://eservices.ju.edu.jo/JUCS/login.aspx" class="d-block p-5 c-gray hover-c-black">Community service and activities</a>
                            <a href="https://eservices.ju.edu.jo/WebYearBook/" class="d-block p-5 c-gray hover-c-black">Web year book</a>
                        </div>
                        <button class="btn-shape" 
                            onclick="togglePortal('financialPortal')">See More</button>
                    </div>
                    
                    <div class="portal-box bg-white rad-10 p-20" id="internshipPortal">
                        <i class="fa-solid fa-book-open fa-3x c-olive"></i>
                      
                        <h3 class="c-olive">Researches</h3>
                        <p class="c-gray">Support and resources for academic research, publications, and research funding opportunities.</p>
                        <div class="extra-links">
                            <a href="https://research.ju.edu.jo/Home.aspx" class="d-block p-5 c-gray hover-c-black">Scientific Research Deanship</a>
                            <a href="https://actsau.ju.edu.jo/Home.aspx" class="d-block p-5 c-gray hover-c-black">Arab Council for Training & Student Creativity</a>
                            
                        </div>
                        <button class="btn-shape"
                            onclick="togglePortal('internshipPortal')">See More</button>
                    </div>
                    
                    <div class="portal-box bg-white rad-10 p-20" id="housingPortal">
                      
                        <i class="fa-solid fa-building fa-3x c-olive"></i>
                        <h3 class="c-olive">Scholarships & Loans</h3>
                        <p class="c-gray">Explore available scholarships and loan programs to support your academic journey.</p>
                        <div class="extra-links">
                            <a href="https://www.dsamohe.gov.jo/" class="d-block p-5 c-gray hover-c-black">Scholarships & Loans</a>
                            <a href=" https://offices.ju.edu.jo/en/oir/lists/erasmusplus/alluni.aspx :" class="d-block p-5 c-gray hover-c-black">Erasmus</a>
                        </div>
                        <button class="btn-shape"
                            onclick="togglePortal('housingPortal')">See More</button>
                    </div>
                    
                    <div class="portal-box bg-white rad-10 p-20" id="healthPortal">
                        <i class="fa-solid fa-heartbeat fa-3x c-olive"></i>
                        <h3 class="c-olive">Health Services</h3>
                        <p class="c-gray">Book clinic appointments, view medical history, and get health advice.</p>
                        <div class="extra-links">
                            <a href="https://hospital.ju.edu.jo/Home.aspx" class="d-block p-5 c-gray hover-c-black">The university hospital</a>
                            <a href="https://eservices.ju.edu.jo/ClinicApp/" class="d-block p-5 c-gray hover-c-black">Student clinic</a>
                            <a href="https://apphosp.ju.edu.jo/Appointment/" class="d-block p-5 c-gray hover-c-black">Test results and appointments</a>
                        </div>
                        <button class="btn-shape"  onclick="togglePortal('healthPortal')">See
                            More</button>
                    </div>
                    
                   <!-- <div class="portal-box bg-white rad-10 p-20" id="transportPortal">
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
                    </div>-->
                    
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