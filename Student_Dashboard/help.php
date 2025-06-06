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
    <style>.ul {color: #314528;}</style>

    <style>
        .ul {
            color: #314528;
        }
        .notification{
            margin-right: 10px;
        }
        .notification-count {
            position: absolute;
            top: -6px;
            right: -6px;
            background-color: red;
            color: white;
            border-radius: 50%;
            font-size: 10px;
            width: 18px;
            height: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
        }

        .notification-bar {
            position: absolute;
            top: 60px;
            right: 0;
            width: 350px;
            background-color: #fff;
            border: 1px solid #ccc;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
            display: none;
            z-index: 1000;
            font-family: 'Open Sans', sans-serif;
        }

        .notification-bar header {
            padding: 12px 16px;
            border-bottom: 1px solid #eee;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-weight: 600;
            font-size: 16px;
        }

        .notification-bar ul {
            list-style: none;
            margin: 0;
            padding: 0;
            max-height: 300px;
            overflow-y: auto;
        }

        .notification-bar li {
            padding: 10px 16px;
            border-bottom: 1px solid #eee;
            font-size: 14px;
        }

        .notification-bar li:last-child {
            border-bottom: none;
        }

        .notification-bar .footer {
            padding: 10px 16px;
            text-align: center;
            background-color: #314528;
            border-top: 1px solid #eee;
        }

        .notification-bar .footer a {
            text-decoration: none;
            color: #f3f4e7;
            font-weight: 500;
        }
        @media (max-width: 460px){
            .notification-bar{
                right: -40px;
                width: 300px;
            }
        }
    </style>
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
             <?php require './navbar.php'?>
            <h1 class="p-relative">Help & Support</h1>
            <div class="wrapper d-grid gap-20">
            
                <!-- Section 1: Welcome Section -->
                <div class="welcome-section">
                    <h1>How can we help?</h1>
                    <input type="text" id="helpSearch" class="p-10" placeholder="Describe your issue or question..."
                        style="width: 100%; max-width: 600px; margin-top: 20px;">
                    <div id="searchResults" class="search-results"></div>
                </div>
            
                <!-- Section 2: Services Grid -->
                <div class="services-grid">
                    <!-- FAQ Box -->
                    <div class="service-box faq" id="faqSection">
                        <img src="../imgs/faq.png" alt="FAQ">
                        <h3>FAQ</h3>
                        <p>Find answers to frequently asked questions about UniKey.</p>
                        <ul>
                            <li data-search-term="reset password"><a href="helpn.php" class="ul">How do I reset my
                                    password?</a>
            
                            </li>
            
                            <li data-search-term="report lost item"><a href="helpn1.php" class="ul">How do I report a
                                    lost
                                    item?</a></li>
                            <li data-search-term="access university map"><a href="helpn2.php" class="ul">How do I access
                                    the
                                    university map?</a></li>
                        </ul>
                        <button class="save fs-14 bg-olive c-beige b-none w-fit btn-shape" style="cursor: pointer;"><a
                                href="helpall.php" style="color:#f3f4e7 !important">View FAQ</a></button>
                    </div>
            
                    <!-- User Guide & Tutorials Box -->
                    <div class="service-box" id="tutorialsSection">
                        <img src="../imgs/guide.png" alt="User Guide">
                        <h3>User Guide & Tutorials</h3>
                        <p>Step-by-step guides and tutorials to help you use UniKey.<br> Here you'll find detailed
                            instructions on how to use UniKey's features.</p>
                        <button class="save fs-14 bg-olive c-beige b-none w-fit btn-shape" style="cursor: pointer;">View
                            Tutorials</button>
                    </div>
            
                    <!-- Contact Support Box -->
                    <div class="service-box" id="contactSection">
                        <img src="../imgs/contact.png" alt="Contact Support">
                        <h3>Contact Support</h3>
                        <p>Reach out to our support team for personalized assistance.</p>
                        <p>Email: support@unikey.edu<br>Phone: +962 6 535 5000</p>
                        <button class="save fs-14 bg-olive c-beige b-none w-fit btn-shape" style="cursor: pointer;"
                            onclick="sendEmail()">Contact Us</button>
                    </div>
            
                    <!-- Feedback & Suggestions Box -->
                    <div class="service-box" id="feedbackSection">
                        <img src="../imgs/feed.png" alt="Feedback">
                        <h3>Feedback & Suggestions</h3>
                        <p>Share your feedback and suggestions to improve UniKey.</p>
                        <form>
                            <input class="d-block mb-20 w-full p-10 b-none bg-eee rad-6" type="text" placeholder="Title" />
                            <textarea class="d-block mb-20 w-full p-10 b-none bg-eee rad-6" placeholder="Your Thought"></textarea>
                            <button class="save fs-14 bg-olive c-beige b-none w-fit btn-shape"
                                style="cursor: pointer;">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
   <script>
        function sendEmail() {
                window.location.href = "mailto:unikey2025@gmail.com?subject=Contact Us&body=Please Tell Us Your Suggestion.";
            }

            // Search functionality
            document.addEventListener('DOMContentLoaded', function () {
                const searchInput = document.getElementById('helpSearch');
                const searchResults = document.getElementById('searchResults');
                const notifBtn = document.getElementById('notifBtn');
                const notifBar = document.getElementById('notificationBar');
                const notifCount = document.getElementById('notificationCount');
        
                notifBtn.addEventListener('click', function (e) {
                    e.stopPropagation();
                    notifBar.style.display = notifBar.style.display === 'block' ? 'none' : 'block';
                });

                document.addEventListener('click', function (e) {
                    if (!notifBar.contains(e.target) && e.target !== notifBtn) {
                        notifBar.style.display = 'none';
                    }
                });

                // Example count control
                const count = 3;
                notifCount.textContent = count;
                notifCount.style.display = count > 0 ? 'flex' : 'none';
                // Sample data for search - you can expand this with more content
                const searchData = [
                    {
                        title: "Reset Password",
                        content: "Learn how to reset your UniKey password",
                        section: "faqSection",
                        terms: "reset password change credentials"
                    },
                    {
                        title: "Report Lost Item",
                        content: "Instructions for reporting lost items on campus",
                        section: "faqSection",
                        terms: "report lost item missing belongings"
                    },
                    {
                        title: "University Map",
                        content: "How to access and use the interactive campus map",
                        section: "faqSection",
                        terms: "university map campus navigation directions"
                    },
                    {
                        title: "Login Issues",
                        content: "Troubleshooting steps for login problems",
                        section: "troubleshootingSection",
                        terms: "login issues sign in problems authentication"
                    },
                    {
                        title: "Lost & Found Errors",
                        content: "Solutions for common Lost & Found system errors",
                        section: "troubleshootingSection",
                        terms: "lost found errors system issues"
                    },
                    {
                        title: "Slow Performance",
                        content: "How to improve UniKey app performance",
                        section: "troubleshootingSection",
                        terms: "slow performance lagging loading issues"
                    },
                    {
                        title: "User Guides",
                        content: "Comprehensive guides for all UniKey features",
                        section: "tutorialsSection",
                        terms: "user guides tutorials how-to instructions"
                    },
                    {
                        title: "Contact Support",
                        content: "Get direct help from our support team",
                        section: "contactSection",
                        terms: "contact support help email phone"
                    },
                    {
                        title: "Feedback",
                        content: "Share your suggestions to improve UniKey",
                        section: "feedbackSection",
                        terms: "feedback suggestions improvements ideas"
                    }
                ];

                searchInput.addEventListener('input', function () {
                    const searchTerm = this.value.toLowerCase().trim();
                    searchResults.innerHTML = '';

                    if (searchTerm.length < 2) {
                        searchResults.style.display = 'none';
                        return;
                    }

                    const results = searchData.filter(item =>
                        item.terms.includes(searchTerm) ||
                        item.title.toLowerCase().includes(searchTerm) ||
                        item.content.toLowerCase().includes(searchTerm)
                    );

                    if (results.length > 0) {
                        results.forEach(result => {
                            const resultItem = document.createElement('div');
                            resultItem.className = 'search-result-item';
                            resultItem.innerHTML = `
                            <h4>${highlightMatches(result.title, searchTerm)}</h4>
                            <p>${highlightMatches(result.content, searchTerm)}</p>
                        `;
                            resultItem.addEventListener('click', function () {
                                // Scroll to the relevant section
                                document.getElementById(result.section).scrollIntoView({
                                    behavior: 'smooth'
                                });
                                searchResults.style.display = 'none';
                            });
                            searchResults.appendChild(resultItem);
                        });
                        searchResults.style.display = 'block';
                    } else {
                        const noResults = document.createElement('div');
                        noResults.className = 'search-result-item';
                        noResults.innerHTML = '<p>No results found. Try different keywords or contact support.</p>';
                        searchResults.appendChild(noResults);
                        searchResults.style.display = 'block';
                    }
                });

                // Hide results when clicking outside
                document.addEventListener('click', function (e) {
                    if (e.target !== searchInput) {
                        searchResults.style.display = 'none';
                    }
                });

                // Highlight matching text in search results
                function highlightMatches(text, term) {
                    if (!term) return text;
                    const regex = new RegExp(term, 'gi');
                    return text.replace(regex, match => `<span class="highlight">${match}</span>`);
                }

                // Also search the FAQ items and troubleshooting items
                const allSearchableItems = document.querySelectorAll('[data-search-term]');

                searchInput.addEventListener('input', function () {
                    const searchTerm = this.value.toLowerCase().trim();

                    if (searchTerm.length < 2) {
                        // Reset all items if search is empty
                        allSearchableItems.forEach(item => {
                            item.style.display = '';
                        });
                        return;
                    }

                    // Search through items with data-search-term attribute
                    allSearchableItems.forEach(item => {
                        const itemSearchTerm = item.getAttribute('data-search-term').toLowerCase();
                        if (itemSearchTerm.includes(searchTerm)) {
                            item.style.display = '';
                            // Scroll parent into view if it's hidden
                            item.closest('.service-box').style.display = 'flex';
                        } else {
                            item.style.display = 'none';
                        }
                    });
                });
            });
 
    </script>
</body>

</html>