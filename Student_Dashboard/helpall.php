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
    <title>UniKey - Frequently Asked Questions</title>     
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
    <style>
        .faq-category {
            margin-bottom: 30px;
        }
        .faq-item {
            background: white;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 15px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
        }
        .faq-question {
            font-weight: 600;
            color: #333;
            margin-bottom: 10px;
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .faq-question:after {
            content: '\f078';
            font-family: 'Font Awesome 6 Free';
            font-weight: 900;
            transition: transform 0.3s;
        }
        .faq-question.active:after {
            transform: rotate(180deg);
        }
        .faq-answer {
            display: none;
            padding-top: 10px;
            border-top: 1px solid #eee;
            margin-top: 10px;
            color: #555;
        }
        .search-container {
            margin-bottom: 30px;
        }
        .search-container input {
            width: 100%;
            max-width: 600px;
            padding: 12px 20px;
            border-radius: 30px;
            border: 1px solid #ddd;
            font-size: 16px;
        }
        .no-results {
            text-align: center;
            padding: 40px;
            color: #666;
        }
    </style>
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
            <h1 class="p-relative">Frequently Asked Questions</h1>             
            <div class="wrapper d-grid gap-20">                  
                <!-- Back to Help link -->
                <div class="back-link mb-20">
                    <a href="help.php" class="d-flex align-center fs-14 c-olive">
                        <i class="fa-solid fa-arrow-left mr-5"></i>
                        <span>Back to Help Center</span>
                    </a>
                </div>
                
                <!-- Search Section -->
                <div class="search-container">
                    <input type="text" id="faq-search" placeholder="Search FAQs..." class="p-10">
                </div>
                
                <!-- FAQ Categories -->
                <div class="faq-category">
                    <h2 class="mb-20 c-main"><i class="fa-solid fa-key mr-10"></i>Account & Login</h2>
                    <div class="faq-list">
                        <div class="faq-item">
                            <div class="faq-question">How do I reset my password?</div>
                            <div class="faq-answer">
                                <p>To reset your password:</p>
                                <ol>
                                    <li>Go to the login page and click "Forgot Password"</li>
                                    <li>Enter your university email address</li>
                                    <li>Check your email for a password reset link</li>
                                    <li>Follow the instructions to create a new password</li>
                                </ol>
                                <p class="mt-10"><strong>Note:</strong> Reset links expire after 24 hours.</p>
                            </div>
                        </div>
                        <div class="faq-item">
                            <div class="faq-question">How do I change my email address?</div>
                            <div class="faq-answer">
                                <p>Email addresses can only be changed by visiting the IT Help Desk in person with your student ID.</p>
                            </div>
                        </div>
                        <div class="faq-item">
                            <div class="faq-question">Why am I locked out of my account?</div>
                            <div class="faq-answer">
                                <p>Accounts are temporarily locked after 5 failed login attempts. To unlock:</p>
                                <ol>
                                    <li>Wait 30 minutes and try again, or</li>
                                    <li>Use the password reset feature, or</li>
                                    <li>Contact IT support at support@unikey.edu</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="faq-category">
                    <h2 class="mb-20 c-main"><i class="fa-solid fa-magnifying-glass mr-10"></i>Lost & Found</h2>
                    <div class="faq-list">
                        <div class="faq-item">
                            <div class="faq-question">How do I report a lost item?</div>
                            <div class="faq-answer">
                                <p>To report a lost item:</p>
                                <ol>
                                    <li>Go to the Lost/Found section</li>
                                    <li>Click "Report Lost Item"</li>
                                    <li>Fill in the details (description, location, time)</li>
                                    <li>Upload a photo if available</li>
                                    <li>Submit the report</li>
                                </ol>
                                <p class="mt-10">You'll be notified if your item is found.</p>
                            </div>
                        </div>
                        <div class="faq-item">
                            <div class="faq-question">Where do found items get stored?</div>
                            <div class="faq-answer">
                                <p>Found items are kept at the Campus Security Office (Building A, Room 101) for 30 days.</p>
                            </div>
                        </div>
                        <div class="faq-item">
                            <div class="faq-question">How do I claim a found item?</div>
                            <div class="faq-answer">
                                <p>To claim an item:</p>
                                <ol>
                                    <li>Visit the Campus Security Office</li>
                                    <li>Bring your student ID</li>
                                    <li>Provide proof of ownership if possible</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="faq-category">
                    <h2 class="mb-20 c-main"><i class="fa-solid fa-map mr-10"></i>Campus Navigation</h2>
                    <div class="faq-list">
                        <div class="faq-item">
                            <div class="faq-question">How do I access the university map?</div>
                            <div class="faq-answer">
                                <p>The interactive campus map can be accessed:</p>
                                <ol>
                                    <li>From the main menu, click "Map"</li>
                                    <li>Use the search bar to find locations</li>
                                    <li>Zoom in/out with the + and - buttons</li>
                                    <li>Click "Locate Me" to find your position</li>
                                </ol>
                            </div>
                        </div>
                        <div class="faq-item">
                            <div class="faq-question">How do I find accessible routes?</div>
                            <div class="faq-answer">
                                <p>On the map:</p>
                                <ol>
                                    <li>Click the accessibility icon (wheelchair symbol)</li>
                                    <li>Accessible routes will highlight in blue</li>
                                    <li>Elevators and ramps will be marked</li>
                                </ol>
                            </div>
                        </div>
                        <div class="faq-item">
                            <div class="faq-question">Where can I find parking information?</div>
                            <div class="faq-answer">
                                <p>Parking lots are color-coded on the map:</p>
                                <ul>
                                    <li><span class="c-red">Red</span> - Faculty parking</li>
                                    <li><span class="c-blue">Blue</span> - Student parking</li>
                                    <li><span class="c-green">Green</span> - Visitor parking</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="faq-category">
                    <h2 class="mb-20 c-main"><i class="fa-solid fa-calendar mr-10"></i>Events & Activities</h2>
                    <div class="faq-list">
                        <div class="faq-item">
                            <div class="faq-question">How do I find upcoming events?</div>
                            <div class="faq-answer">
                                <p>All events are listed in the Events section. You can:</p>
                                <ol>
                                    <li>Browse by date using the calendar</li>
                                    <li>Filter by event type (academic, social, sports)</li>
                                    <li>Search for specific events</li>
                                </ol>
                            </div>
                        </div>
                        <div class="faq-item">
                            <div class="faq-question">How do I RSVP for an event?</div>
                            <div class="faq-answer">
                                <p>To RSVP:</p>
                                <ol>
                                    <li>Find the event in the Events section</li>
                                    <li>Click on the event to see details</li>
                                    <li>Click "Attend" or "RSVP"</li>
                                    <li>You'll receive a confirmation</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="faq-category">
                    <h2 class="mb-20 c-main"><i class="fa-solid fa-book mr-10"></i>BookTrade</h2>
                    <div class="faq-list">
                        <div class="faq-item">
                            <div class="faq-question">How do I sell my textbooks?</div>
                            <div class="faq-answer">
                                <p>To sell books:</p>
                                <ol>
                                    <li>Go to BookTrade</li>
                                    <li>Click "Sell Items"</li>
                                    <li>Enter book details (ISBN, condition, price)</li>
                                    <li>Upload photos</li>
                                    <li>Submit the listing</li>
                                </ol>
                            </div>
                        </div>
                        <div class="faq-item">
                            <div class="faq-question">How do I contact a seller?</div>
                            <div class="faq-answer">
                                <p>Click on any book listing to see the "Contact Seller" button. Messages go through our secure system.</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="contact-support mt-30 p-20 bg-eee rad-6">
                    <h3 class="mt-0 mb-15">Still need help?</h3>
                    <p>Contact our support team for personalized assistance:</p>
                    <p>Email: <a href="mailto:support@unikey.edu" class="c-olive">support@unikey.edu</a><br>
                    Phone: <a href="tel:+96265355000" class="c-olive">+962 6 535 5000</a> (ext. 1234)</p>
                    <button class="save fs-14 bg-olive c-beige b-none w-fit btn-shape mt-10" style="cursor: pointer;" onclick="sendEmail()">Contact Support</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function sendEmail() {
            window.location.href = "mailto:unikey2025@gmail.com?subject=Contact Us&body=Please Tell Us Your Suggestion.";
        }
        
        // FAQ toggle functionality
        document.querySelectorAll('.faq-question').forEach(question => {
            question.addEventListener('click', () => {
                question.classList.toggle('active');
                const answer = question.nextElementSibling;
                if (answer.style.display === 'block') {
                    answer.style.display = 'none';
                } else {
                    answer.style.display = 'block';
                }
            });
        });
        
        // FAQ search functionality
        document.getElementById('faq-search').addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            let hasResults = false;
            
            document.querySelectorAll('.faq-item').forEach(item => {
                const question = item.querySelector('.faq-question').textContent.toLowerCase();
                const answer = item.querySelector('.faq-answer').textContent.toLowerCase();
                
                if (question.includes(searchTerm) || answer.includes(searchTerm)) {
                    item.style.display = 'block';
                    hasResults = true;
                } else {
                    item.style.display = 'none';
                }
            });
            
            // Show/hide category headers based on visible items
            document.querySelectorAll('.faq-category').forEach(category => {
                const visibleItems = category.querySelectorAll('.faq-item[style="display: block"]').length;
                if (visibleItems > 0) {
                    category.style.display = 'block';
                } else {
                    category.style.display = 'none';
                }
            });
            
            // Show no results message if needed
            const noResults = !hasResults && searchTerm.length > 0;
            if (noResults) {
                if (!document.getElementById('no-results')) {
                    const noResultsDiv = document.createElement('div');
                    noResultsDiv.id = 'no-results';
                    noResultsDiv.className = 'no-results';
                    noResultsDiv.textContent = 'No FAQs match your search. Try different keywords.';
                    document.querySelector('.wrapper').appendChild(noResultsDiv);
                }
            } else {
                const noResultsDiv = document.getElementById('no-results');
                if (noResultsDiv) {
                    noResultsDiv.remove();
                }
            }
        });
    </script>
</body>
</html>