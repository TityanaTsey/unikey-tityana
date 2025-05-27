<!--
<?php session_start();  
include "../Connect.php";      
$S_ID = $_SESSION['S_Log'];      
if (! $S_ID) {          
    echo '<script language="JavaScript">document.location="../login.php";</script>';      
} else {          
    $sql1 = mysqli_query($con, "select * from students where id='$S_ID'");         
    $row1 = mysqli_fetch_array($sql1);          
    $name = $row1['fname'] . ' ' . $row1['lname'];     
} 
?>
-->
<!DOCTYPE html> 
<html lang="en">  
<head>     
    <meta charset="UTF-8">     
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />     
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />     
    <title>UniKey - Help & Support</title>     
    <!-- favicon -->     
    <link rel="icon" type="image/png" href="../favicon/favicon-96x96.png" sizes="96x96" />     
    <link rel="icon" type="image/svg+xml" href="../favicon/favicon.svg" />     
    <link rel="shortcut icon" href="../favicon/favicon.ico" />     
    <link rel="apple-touch-icon" sizes="180x180" href="../favicon/apple-touch-icon.png" />     
    <link rel="manifest" href="../favicon/site.webmanifest" />     
    <!-- css -->     
    <link rel="stylesheet" href="../css/all.min.css" />     
    <link rel="stylesheet" href="../css/framework.css" />     
    <link rel="stylesheet" href="../css/help.css" />     
    <link rel="stylesheet" href="../css/side.css" />     
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
                <!-- Back to FAQ link -->
                <div class="back-link mb-20">
                    <a href="help.php" class="d-flex align-center fs-14 c-olive">
                        <i class="fa-solid fa-arrow-left mr-5"></i>
                        <span>Back to Help Center</span>
                    </a>
                </div>
                
                <!-- FAQ Question Section -->
                <div class="faq-detail bg-white rad-10 p-20">
                    <h2 class="mt-0 mb-20">How do I access the university map?</h2>
                    
                    <div class="answer mb-20">
                        <p class="fs-16">UniKey provides an interactive campus map to help you navigate the university facilities. Here's how to access and use it:</p>
                        
                        <div class="steps p-20 bg-eee rad-6 mt-20">
                            <h3 class="mt-0 mb-15">Accessing the University Map:</h3>
                            <ol class="m-0 pl-20">
                                <li class="mb-10">From the main menu, click on <a href="map.php" class="c-olive">Map</a> in the navigation sidebar</li>
                                <li class="mb-10">The interactive map will load showing all campus buildings and facilities</li>
                                <li class="mb-10">Use these controls to navigate:
                                    <ul class="mt-5 pl-20">
                                        <li class="mb-5"><i class="fa-solid fa-magnifying-glass-plus c-blue mr-5"></i> Zoom in/out using the + and - buttons</li>
                                        <li class="mb-5"><i class="fa-solid fa-location-crosshairs c-blue mr-5"></i> Click "Locate Me" to find your current position (requires location permissions)</li>
                                        <li class="mb-5"><i class="fa-solid fa-search c-blue mr-5"></i> Search for specific locations using the search bar</li>
                                    </ul>
                                </li>
                                <li class="mb-10">Click on any building to see more details and get directions</li>
                            </ol>
                        </div>
                    </div>
                    
                    <div class="additional-info mt-30">
                        <h3 class="mb-15">Map Features:</h3>
                        <div class="features-grid d-grid gap-20" style="grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));">
                            <div class="feature-box p-15 bg-eee rad-6">
                                <h4 class="mt-0 mb-10 c-blue"><i class="fa-solid fa-route mr-10"></i>Directions</h4>
                                <p>Get step-by-step walking directions between any two points on campus.</p>
                            </div>
                            <div class="feature-box p-15 bg-eee rad-6">
                                <h4 class="mt-0 mb-10 c-green"><i class="fa-solid fa-utensils mr-10"></i>Facilities</h4>
                                <p>Find dining locations, restrooms, libraries, and other key facilities.</p>
                            </div>
                            <div class="feature-box p-15 bg-eee rad-6">
                                <h4 class="mt-0 mb-10 c-orange"><i class="fa-solid fa-wheelchair mr-10"></i>Accessibility</h4>
                                <p>View accessible routes and facilities for differently-abled individuals.</p>
                            </div>
                        </div>
                        
                        <div class="info-box p-15 bg-eee rad-6 mt-20">
                            <h4 class="mt-0 mb-10"><i class="fa-solid fa-circle-exclamation c-orange mr-10"></i>Important Notes</h4>
                            <ul class="m-0 pl-20">
                                <li class="mb-5">For best results, enable location services on your device</li>
                                <li class="mb-5">The map works best on modern browsers (Chrome, Firefox, Edge)</li>
                                <li class="mb-5">Some features may be limited on mobile devices</li>
                            </ul>
                        </div>
                        
                        <div class="info-box p-15 bg-eee rad-6 mt-20">
                            <h4 class="mt-0 mb-10"><i class="fa-solid fa-question-circle c-blue mr-10"></i>Need More Help?</h4>
                            <p class="m-0">If you're having trouble with the map or need special assistance, contact campus facilities at <a href="tel:+96265355000" class="c-olive">+962 6 535 5000</a> ext. 4567 or visit the information desk in the Student Center.</p>
                        </div>
                    </div>
                    
                    <div class="helpful mt-30 p-15 bg-eee rad-6">
                        <h4 class="mt-0 mb-10">Was this answer helpful?</h4>
                        <button class="vote-btn mr-10 p-5-15 bg-blue c-white b-none rad-6"><i class="fa-solid fa-thumbs-up mr-5"></i>Yes</button>
                        <button class="vote-btn p-5-15 bg-red c-white b-none rad-6"><i class="fa-solid fa-thumbs-down mr-5"></i>No</button>
                    </div>
                </div>
                
                <!-- Related Questions -->
                <div class="related-questions mt-30">
                    <h3 class="mb-20">Related Questions</h3>
                    <div class="questions-list bg-white rad-10 p-20">
                        <ul class="m-0">
                            <li class="mb-10 p-10 hover-bg-eee rad-6">
                                <a href="#" class="d-flex align-center fs-14 c-black">
                                    <i class="fa-solid fa-question-circle c-blue mr-10"></i>
                                    <span>How do I find accessible routes on campus?</span>
                                </a>
                            </li>
                            <li class="mb-10 p-10 hover-bg-eee rad-6">
                                <a href="#" class="d-flex align-center fs-14 c-black">
                                    <i class="fa-solid fa-question-circle c-blue mr-10"></i>
                                    <span>Where can I find parking information on the map?</span>
                                </a>
                            </li>
                            <li class="p-10 hover-bg-eee rad-6">
                                <a href="#" class="d-flex align-center fs-14 c-black">
                                    <i class="fa-solid fa-question-circle c-blue mr-10"></i>
                                    <span>How do I report an error in the campus map?</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function sendEmail() {
            window.location.href = "mailto:unikey2025@gmail.com?subject=Contact Us&body=Please Tell Us Your Suggestion.";
        }
        
        // Add functionality for the vote buttons
        document.querySelectorAll('.vote-btn').forEach(button => {
            button.addEventListener('click', function() {
                if (this.classList.contains('bg-blue')) {
                    alert('Thank you for your feedback! We\'re glad this was helpful.');
                } else {
                    alert('We\'re sorry this wasn\'t helpful. Our team will review this answer.');
                }
            });
        });
    </script>
</body>
</html>