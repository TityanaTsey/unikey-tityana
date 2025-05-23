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
                    <h2 class="mt-0 mb-20">How do I reset my password?</h2>
                    
                    <div class="answer mb-20">
                        <p class="fs-16">If you've forgotten your password or need to reset it for security reasons, follow these steps:</p>
                        
                        <div class="steps p-20 bg-eee rad-6 mt-20">
                            <h3 class="mt-0 mb-15">Steps to reset your password:</h3>
                            <ol class="m-0 pl-20">
                                <li class="mb-10">Go to the login page and click on "Forgot Password"</li>
                                <li class="mb-10">Enter your university email address associated with your account</li>
                                <li class="mb-10">Check your email for a password reset link (check spam folder if you don't see it)</li>
                                <li class="mb-10">Click the link in the email and follow the instructions to create a new password</li>
                                <li class="mb-10">Log in with your new password</li>
                            </ol>
                        </div>
                    </div>
                    
                    <div class="additional-info mt-30">
                        <h3 class="mb-15">Additional Information:</h3>
                        <div class="info-box p-15 bg-eee rad-6 mb-15">
                            <h4 class="mt-0 mb-10"><i class="fa-solid fa-circle-exclamation c-orange mr-10"></i>Important Notes</h4>
                            <ul class="m-0 pl-20">
                                <li class="mb-5">Password reset links expire after 24 hours</li>
                                <li class="mb-5">Your new password must be at least 8 characters long</li>
                                <li class="mb-5">Include a mix of uppercase, lowercase, numbers, and special characters</li>
                            </ul>
                        </div>
                        
                        <div class="info-box p-15 bg-eee rad-6">
                            <h4 class="mt-0 mb-10"><i class="fa-solid fa-question-circle c-blue mr-10"></i>Still having trouble?</h4>
                            <p class="m-0">If you're unable to reset your password or didn't receive the reset email, please contact our support team at <a href="mailto:support@unikey.edu" class="c-olive">support@unikey.edu</a> or call +962 6 535 5000 during business hours.</p>
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
                                    <span>How do I change my password if I remember my current one?</span>
                                </a>
                            </li>
                            <li class="mb-10 p-10 hover-bg-eee rad-6">
                                <a href="#" class="d-flex align-center fs-14 c-black">
                                    <i class="fa-solid fa-question-circle c-blue mr-10"></i>
                                    <span>What should I do if my account is locked?</span>
                                </a>
                            </li>
                            <li class="p-10 hover-bg-eee rad-6">
                                <a href="#" class="d-flex align-center fs-14 c-black">
                                    <i class="fa-solid fa-question-circle c-blue mr-10"></i>
                                    <span>How do I update my email address for password resets?</span>
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