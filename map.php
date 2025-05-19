<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="thunderforest:transport" content="6eb394707edd47e7a75125281e232875">
    <title>UniKey - Map</title>
    <!-- favicon -->
    <link rel="icon" type="image/png" href="../favicon/favicon-96x96.png" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="../favicon/favicon.svg" />
    <link rel="shortcut icon" href="../favicon/favicon.ico" />
    <link rel="apple-touch-icon" sizes="180x180" href="../favicon/apple-touch-icon.png" />
    <link rel="manifest" href="../favicon/site.webmanifest" />
    <!-- google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- css -->
    <link rel="stylesheet" href="../css/map.css" />
    <link rel="stylesheet" href="../css/side.css" />
    <link rel="stylesheet" href="../css/framework.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

    <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@3.2.12/dist/leaflet-routing-machine.css" />
</head>

<body>
    <div class="page d-flex">
        <div class="sidebar p-20 p-relative">
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
                    <a class="d-flex align-center fs-14 c-black rad-6 p-10" href="lost.html">
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
                    <a class="active d-flex align-center fs-14 c-black rad-6 p-10" href="event.html">
                        <i class="fa-regular fa-calendar"></i>
                        <span>Events</span>
                    </a>
                </li>
                <li>
                    <a class=" d-flex align-center fs-14 c-black rad-6 p-10" href="announcement.html">
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
        <div class="content w-full">
            <!-- Start Head -->
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
            <h1>University of Jordan Campus Map</h1>
            <div class="map-filters">
                <div class="filter-options">
                    <!-- Libraries -->
                    <button class="filter-btn active" data-type="library">
                        <i class="fas fa-book"></i> Libraries
                    </button>
            
                    <!-- Faculties -->
                    <button class="filter-btn active" data-type="faculty">
                        <i class="fas fa-graduation-cap"></i> Faculties
                    </button>
            
                    <!-- Mosques -->
                    <button class="filter-btn active" data-type="mosque">
                        <i class="fas fa-mosque"></i> Mosques
                    </button>
            
                    <!-- Restrooms -->
                    <button class="filter-btn active" data-type="restroom">
                        <i class="fas fa-restroom"></i> Restrooms
                    </button>
            
                    <!-- Cafeterias -->
                    <button class="filter-btn active" data-type="cafeteria">
                        <i class="fas fa-utensils"></i> Cafeterias
                    </button>
            
                    <!-- Administrative -->
                    <button class="filter-btn active" data-type="admin">
                        <i class="fas fa-building"></i> Administrative
                    </button>
            
                    <!-- Health Center -->
                    <button class="filter-btn active" data-type="health">
                        <i class="fas fa-hospital"></i> Health Center
                    </button>
                    <!-- inventories -->
                    <button class="filter-btn active" data-type="inventories">
                        <i class="fa-solid fa-warehouse"></i> Inventories
                    </button>
                </div>      </div>
            <!-- <button id="find-nearest" class="map-control-button">
                Find Nearest Library
            </button> -->
            <div id="location-error" style="display:none; color:red;"></div>
            <div id="map"></div>
            <!-- <div id="map-legend">
                <div><span class="faculty-legend"></span> Faculties</div>
                <div><span class="library-legend"></span> Libraries</div>
            </div> -->

    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet-routing-machine@3.2.12/dist/leaflet-routing-machine.js"></script>
    <script src="../js/map.js"></script>
</body>

</html>