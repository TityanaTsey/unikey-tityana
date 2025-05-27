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
    <link rel="stylesheet" href="../css/all.min.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

    <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@3.2.12/dist/leaflet-routing-machine.css" />
</head>

<body>
    <div class="page d-flex">
        <div class="sidebar p-20 p-relative">
            <a href="landing.html">
                <h3 class="p-relative txt-c mt-0">UniKey</h3>
            </a>
            <?php require './asaid.php'?>
        </div>
        <div class="content w-full">
            <!-- Start Head -->
               <?php require './navbar.php'?>
            <h1>University of Jordan Campus Map</h1>
            <div class="map-filters">
                <div class="filter-options">
                    <button class="filter-btn " data-type="library">
                        <i class="fas fa-book"></i> Libraries
                    </button>
                    <button class="filter-btn " data-type="faculty">
                        <i class="fas fa-graduation-cap"></i> Faculties
                    </button>
                    <button class="filter-btn " data-type="mosque">
                        <i class="fas fa-mosque"></i> Mosques
                    </button>
                    <button class="filter-btn " data-type="restroom">
                        <i class="fas fa-restroom"></i> Restrooms
                    </button>
                    <button class="filter-btn " data-type="cafeteria">
                        <i class="fas fa-utensils"></i> Cafeterias
                    </button>
                    <button class="filter-btn " data-type="admin">
                        <i class="fas fa-building"></i> Administrative
                    </button>
                    <button class="filter-btn " data-type="health">
                        <i class="fas fa-hospital"></i> Health Center
                    </button>
                    <button class="filter-btn " data-type="warehouse">
                        <i class="fa-solid fa-warehouse"></i> Warehouses
                    </button>
                    <button class="filter-btn " data-type="parking">
                        <i class="fa-solid fa-square-parking"></i> Parkings
                    </button>
                    <button class="filter-btn " data-type="housing">
                        <i class="fa-solid fa-house"></i> Housing Centers
                    </button>
                </div>      
            </div>
            <div class="search-container">
                <input type="text" id="location-search" placeholder="Search for locations...">
                <button id="search-button"><i class="fas fa-search"></i></button>
            </div>

            <div id="location-error" style="display:none; color:red;"></div>
            <div id="map"></div>

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet-routing-machine@3.2.12/dist/leaflet-routing-machine.js"></script>
    <script src="../js/map.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fuse.js@6.6.2"></script>
</body>

</html>