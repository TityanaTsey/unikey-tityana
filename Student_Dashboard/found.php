<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UniKey - Lost & Found</title>
    <!-- favicon -->
    <link rel="icon" type="image/png" href="favicon/favicon-96x96.png" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="favicon/favicon.svg" />
    <link rel="shortcut icon" href="favicon/favicon.ico" />
    <!-- css -->
    <link rel="stylesheet" href="../css/lost_found.css">
    <link rel="stylesheet" href="../css/framework.css">
    <link rel="stylesheet" href="../css/side.css">
    <link rel="stylesheet" href="../css/all.min.css">
    <!-- fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>

    </style>
</head>

<body>
    <div class="page d-flex">
        <!-- Sidebar Navigation -->
        <div class="sidebar bg-white p-20 p-relative">
            <a href="landing.html">
                <h3 class="p-relative txt-c mt-0">UniKey</h3>
            </a>
            <ul>
                <li>
                    <a class="d-flex align-center fs-14 c-black rad-6 p-10" href="dashboard.html">
                        <i class="fa-regular fa-chart-bar fa-fw"></i>
                        <span>Home</span>
                    </a>
                </li>
                <li>
                    <a class="d-flex align-center fs-14 c-black rad-6 p-10" href="settings.html">
                        <i class="fa-solid fa-gear fa-fw"></i>
                        <span>Settings</span>
                    </a>
                </li>
                <li>
                    <a class="d-flex align-center fs-14 c-black rad-6 p-10" href="map.html">
                        <i class="fa-solid fa-map"></i>
                        <span>Map</span>
                    </a>
                </li>
                <li>
                    <a class="active d-flex align-center fs-14 c-black rad-6 p-10" href="lost.html">
                        <i class="fa-solid fa-magnifying-glass"></i>
                        <span>Lost/Found</span>
                    </a>
                </li>
                <li>
                    <a class="d-flex align-center fs-14 c-black rad-6 p-10" href="portals.html">
                        <i class="fa-solid fa-door-open"></i>
                        <span>Portals</span>
                    </a>
                </li>
                <li>
                    <a class="d-flex align-center fs-14 c-black rad-6 p-10" href="event.html">
                        <i class="fa-regular fa-calendar"></i>
                        <span>Events</span>
                    </a>
                </li>
                <li>
                    <a class="d-flex align-center fs-14 c-black rad-6 p-10" href="announcement.html">
                        <i class="fa-solid fa-bullhorn"></i>
                        <span>Announcements</span>
                    </a>
                </li>
                <li>
                    <a class="d-flex align-center fs-14 c-black rad-6 p-10" href="marketplace.html">
                        <i class="fa-solid fa-store"></i>
                        <span>Marketplace</span>
                    </a>
                </li>
                <li>
                    <a class="d-flex align-center fs-14 c-black rad-6 p-10" href="help.html">
                        <i class="fa-solid fa-circle-info"></i>
                        <span>Help</span>
                    </a>
                </li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="content w-full">
            <!-- Header -->
            <div class="head bg-white p-15 between-flex">
                <div class="user-display p-relative d-flex align-center">
                    <i class="fa-solid fa-user-circle fa-lg c-main mr-10"></i>
                    <span class="fs-14 fw-500">Tala Hammami</span> <!-- Replace with dynamic username -->
                </div>
                <div class="icons d-flex align-center">
                    <span class="notification p-relative">
                        <i class="fa-regular fa-bell fa-lg"></i>
                        <i class="fa-solid fa-right-from-bracket"></i>
                    </span>
                </div>
            </div>

            <!-- Main Content -->
            <div class="short-header">
                <h1 class="p-relative">Found Items</h1>
                <!-- <button id="btn-found" class="btn-shape new-btn">Found Items <i
                        class="fa-solid fa-circle-chevron-right"></i></button> -->
            </div>

            <div class="wrapper">
                <!-- Filter Section -->
                <div class="filter-section">
                    <select name="type" id="filter-type" onchange="filterItems()">
                        <option value="" disabled selected>Filter by Type</option>
                        <option value="Electronics">Electronics</option>
                        <option value="Clothes">Clothes</option>
                        <option value="Wallet">Wallet</option>
                        <option value="jacket">Wallet</option>
                        <option value="other">Other</option>
                    </select>
                    <button class="add-card-btn" id="addCardBtn">Add Your Own Card</button>
                </div>

                <!-- Card Container -->
                <div class="card-container">
                    <div class="card" data-type="scarf" data-location="lab">
                        <img src="imgs/scarf.jpg" alt="Scarf">
                        <div class="info">
                            <h5><i class="fa-solid fa-shirt"></i> Found Scarf</h5>
                            <p>Colored scarf</p>
                        </div>
                        <div class="info">
                            <h5><i class="fa-solid fa-location-dot"></i> Found Location</h5>
                            <p>Lab 203</p>
                        </div>
                        <div class="info">
                            <h5><i class="fa-solid fa-tag"></i> Category</h5>
                            <p>Accessories</p>
                        </div>
                        <form action="chat.html">
                            <input type="submit" value="Contact Finder" class="sub">
                        </form>
                    </div>

                    <!-- Card 2 -->
                    <div class="card" data-type="keys" data-location="eng-street">
                        <img src="imgs/carkey.jpg" alt="Car Keys">
                        <div class="info">
                            <h5><i class="fa-solid fa-key"></i> Found Keys</h5>
                            <p>Car keys</p>
                        </div>
                        <div class="info">
                            <h5><i class="fa-solid fa-location-dot"></i> Found Location</h5>
                            <p>Eng street</p>
                        </div>
                        <div class="info">
                            <h5><i class="fa-solid fa-tag"></i> Category</h5>
                            <p>Electronics</p>
                        </div>
                        <form action="chat.html">
                            <input type="submit" value="Contact Finder" class="sub">
                        </form>
                    </div>

                    <!-- Card 3 -->
                    <div class="card" data-type="phone" data-location="cafeteria">
                        <img src="imgs/phone2.jpg" alt="Phone">
                        <div class="info">
                            <h5><i class="fa-solid fa-mobile"></i> Found Phone</h5>
                            <p>S12 Samsung</p>
                        </div>
                        <div class="info">
                            <h5><i class="fa-solid fa-location-dot"></i> Found Location</h5>
                            <p>Cafeteria</p>
                        </div>
                        <div class="info">
                            <h5><i class="fa-solid fa-tag"></i> Category</h5>
                            <p>Phone</p>
                        </div>
                        <form action="chat.html">
                            <input type="submit" value="Contact Finder" class="sub">
                        </form>
                    </div>

                    <!-- Card 4 -->
                    <div class="card " data-type="wallet" data-location="library">
                        
                        <img src="imgs/wallet.jpg" alt="Wallet">
                        <div class="info">
                            <h5><i class="fa-solid fa-wallet"></i> Found Wallet</h5>
                            <p>Black Wallet</p>
                        </div>
                        <div class="info">
                            <h5><i class="fa-solid fa-location-dot"></i> Found Location</h5>
                            <p>Library</p>
                        </div>
                        <div class="info">
                            <h5><i class="fa-solid fa-tag"></i> Category</h5>
                            <p>Accessories</p>
                        </div>
                        <form action="chat.html">
                            <input type="submit" value="Contact Finder" class="sub">
                        </form>
                    </div>
                    <!-- Card 1 -->
                    <div class="card" data-type="phone" data-location="library">
                        <img src="imgs/phone.jpg" alt="Phone">
                        <div class="info">
                            <h5><i class="fa-solid fa-mobile"></i> Found Phone</h5>
                            <p>iPhone 12 black</p>
                        </div>
                        <div class="info">
                            <h5><i class="fa-solid fa-location-dot"></i> Last Seen</h5>
                            <p>Library</p>
                        </div>
                        <div class="info">
                            <h5><i class="fa-solid fa-tag"></i> Category</h5>
                            <p>Phone</p>
                        </div>
                        <form action="chat.html">
                            <input type="submit" value="Contact Finder" class="sub">
                        </form>
                    </div>

                    <!-- Card 2 -->
                    <div class="card" data-type="charger" data-location="cafeteria">
                        <img src="imgs/charger.jpg" alt="Charger">
                        <div class="info">
                            <h5><i class="fa-solid fa-bolt"></i> Found Charger</h5>
                            <p>Type C Charger</p>
                        </div>
                        <div class="info">
                            <h5><i class="fa-solid fa-location-dot"></i> Last Seen</h5>
                            <p>Cafeteria</p>
                        </div>
                        <div class="info">
                            <h5><i class="fa-solid fa-tag"></i> Category</h5>
                            <p>Electronics</p>
                        </div>
                        <form action="chat.html">
                            <input type="submit" value="Contact Finder" class="sub">
                        </form>
                    </div>

                    <!-- Card 3 -->
                    <div class="card expired" data-type="notebook" data-location="zaza">
                        <i class="fa-solid fa-clock expired-icon"></i>
                        <img src="imgs/notebook.jpg" alt="Notebook">
                        <div class="info">
                            <h5><i class="fa-solid fa-book"></i> Found Notebook</h5>
                            <p>Brown large notebook</p>
                        </div>
                        <div class="info">
                            <h5><i class="fa-solid fa-location-dot"></i> Last Seen</h5>
                            <p>ZAZA</p>
                        </div>
                        <div class="info">
                            <h5><i class="fa-solid fa-tag"></i> Category</h5>
                            <p>Stationery</p>
                        </div>
                        <form action="chat.html">
                            <input type="submit" value="Contact Finder" class="sub">
                        </form>
                    </div>

                    <!-- Card 4 -->
                    <div class="card expired" data-type="jacket" data-location="lab">
                        <i class="fa-solid fa-clock expired-icon"></i>
                        <img src="imgs/jacket.jpg" alt="Jacket">
                        <div class="info">
                            <h5><i class="fa-solid fa-shirt"></i> Found Jacket</h5>
                            <p>Black Jacket</p>
                        </div>
                        <div class="info">
                            <h5><i class="fa-solid fa-location-dot"></i> Last Seen</h5>
                            <p>Lab 101</p>
                        </div>
                        <div class="info">
                            <h5><i class="fa-solid fa-tag"></i> Category</h5>
                            <p>Clothes</p>
                        </div>
                        <form action="chat.html">
                            <input type="submit" value="Contact Finder" class="sub">
                        </form>
                    </div>

                    <!-- Card 5 -->
                    <div class="card expired" data-type="bag" data-location="it-faculty">
                        <i class="fa-solid fa-clock expired-icon"></i>
                        <img src="imgs/bag.jpg" alt="Bag">
                        <div class="info">
                            <h5><i class="fa-solid fa-suitcase"></i> Found Bag</h5>
                            <p>Navy pack bag</p>
                        </div>
                        <div class="info">
                            <h5><i class="fa-solid fa-location-dot"></i> Last Seen</h5>
                            <p>IT faculty</p>
                        </div>
                        <div class="info">
                            <h5><i class="fa-solid fa-tag"></i> Category</h5>
                            <p>Accessories</p>
                        </div>
                        <form action="chat.html">
                            <input type="submit" value="Contact Finder" class="sub">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- New Card Form -->
    <div id="card" class="new-card hidden">
        <h2>Report Found Item</h2>
        <form action="">
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" placeholder="Add Title to the item" name="title">
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <input type="text" placeholder="Description of the item" name="description">
            </div>
            <div class="form-group">
                <label for="category">Last Seen</label>
                <select id="category" name="category" class="styled-select">
                    <option value="" disabled selected>Select your faculty</option>
                    <option value="IT">King Abdullah II for Information Technology</option>
                    <option value="Sci">Science</option>
                    <option value="Agr">Agriculture</option>
                    <option value="Eng">Engineering</option>
                    <option value="Arts">Arts</option>
                    <option value="Business">Business</option>
                    <option value="Sharia">Sharia</option>
                    <option value="EduS">Educational Sciences</option>
                    <option value="Law">Law</option>
                    <option value="PE">Physical Education</option>
                    <option value="A&D">Arts and Design</option>
                    <option value="IS">International Studies</option>
                    <option value="FL">Foreign Languages</option>
                    <option value="A&T">Archaeology and Tourism</option>
                    <option value="Nurs">Nursing</option>
                    <option value="Med">Medicine</option>
                    <option value="Phar">Pharmacy</option>
                    <option value="Dent">Dentistry</option>
                    <option value="RS">Rehabilitation Sciences</option>
                    <option value="other">Other</option>
                </select>
            </div>
            <div class="form-group">
                <label for="category">Category</label>
                <select id="category" name="category" class="styled-select">
                    <option value="acc">Accessories</option>
                    <option value="sta">Stationery</option>
                    <option value="phone" selected>Phones</option>
                    <option value="elec">Electronics</option>
                    <option value="clothes">Clothes</option>
                </select>
            </div>
            <div class="form-group">
                <label for="last-seen">Upload Image</label>
                <input type="file" placeholder="Last Seen location" name="last-seen">
            </div>
        </form>
        <div class="last-btn">
            <button id="closeCardBtn" class="btn-shape add-btn">Add</button>
        </div>
    </div>

    <script>

        document.addEventListener("DOMContentLoaded", function () {


            document.getElementById('addCardBtn').addEventListener('click', function () {
                document.getElementById('card').classList.remove('hidden');
                document.querySelector('.content').classList.add('blur');
            });

            document.getElementById('closeCardBtn').addEventListener('click', function () {
                document.getElementById('card').classList.add('hidden');
                document.querySelector('.content').classList.remove('blur');
            });

            // Filter function placeholder
            function filterItems() {
                const filterValue = document.getElementById('filter-type').value.toLowerCase();
                const cards = document.querySelectorAll('.card');

                cards.forEach(card => {
                    const cardType = card.getAttribute('data-type').toLowerCase();
                    if (filterValue === "" || cardType.includes(filterValue)) {
                        card.style.display = 'block';
                    } else {
                        card.style.display = 'none';
                    }
                });
            }
        });
    </script>
</body>

</html>