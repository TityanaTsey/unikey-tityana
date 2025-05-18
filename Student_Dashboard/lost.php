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

        $itemsSql = "SELECT lf.*
FROM lost_founds lf
JOIN students s ON lf.student_id = s.id
WHERE lf.status = 1
  AND s.active = 1
ORDER BY lf.id DESC;"; 
        #"SELECT * from lost_founds ORDER BY id DESC";

        if ($place && $filter) {
            $itemsSql = "SELECT lf.*
FROM lost_founds lf
JOIN students s ON lf.student_id = s.id
WHERE lf.category_id = '$filter'
  AND lf.place_id = '$place'
  AND lf.status = 1
  AND s.active = 1
ORDER BY lf.id DESC;";
            #"SELECT * from lost_founds WHERE category_id = '$filter' AND place_id = '$place' ORDER BY id DESC";
        } else if ($filter) {
            $itemsSql ="SELECT lf.*
FROM lost_founds lf
JOIN students s ON lf.student_id = s.id
WHERE lf.category_id = '$filter'
  AND lf.status = 1
  AND s.active = 1
ORDER BY lf.id DESC;"; 
            #"SELECT * from lost_founds WHERE category_id = '$filter' ORDER BY id DESC";
        } else if ($place) {
            $itemsSql ="SELECT lf.*
FROM lost_founds lf
JOIN students s ON lf.student_id = s.id
WHERE lf.place_id = '$place'
  AND lf.status = 1
  AND s.active = 1
ORDER BY lf.id DESC;"; 
            #"SELECT * from lost_founds WHERE place_id = '$place' ORDER BY id DESC";
        }

        if (isset($_POST['Submit'])) {

            $category_id  = $_POST['category_id'];
            $student_id   = $_POST['student_id'];
            $place_id     = $_POST['place_id'];
            $name         = $_POST['name'];
            $type         = $_POST['type'];
            $last_seen_in = $_POST['last_seen_in'];
            $image        = $_FILES["file"]["name"];
            $image        = 'Losts_Images/' . $image;
            $status       = 1;
            

            $stmt = $con->prepare("INSERT INTO lost_founds (category_id, place_id, student_id, name, description, image, status) VALUES (?, ?, ?, ?, ?, ?, ?)");

            $stmt->bind_param("iiisssi", $category_id, $place_id, $student_id, $name, $description, $image, $status);

            if ($stmt->execute()) {

                move_uploaded_file($_FILES["file"]["tmp_name"], "./Losts_Images/" . $_FILES["file"]["name"]);

                echo "<script language='JavaScript'>
              alert ('Item Added Successfully !');
         </script>";

                echo "<script language='JavaScript'>
        document.location='./lost.php';
           </script>";

            }
        }
    }

?>


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
            <?php require './asaid.php'?>
        </div>

        <!-- Main Content -->
        <div class="content w-full">
            <!-- Header -->
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

            <!-- Main Content -->
            <div class="short-header">
                <h1 class="p-relative">Found Items</h1>
                <!-- <button id="btn-found" class="btn-shape new-btn">Found Items <i
                        class="fa-solid fa-circle-chevron-right"></i></button> -->
            </div>

            <div class="wrapper">
                <!-- Filter Section -->
                <div class="filter-section">
                    <select name="type" id="filter-type">
                        <option value="">Filter by Type</option>
                        <?php
                            $sql1 = mysqli_query($con, "SELECT * from categories WHERE type = 'losts'");

                            while ($row1 = mysqli_fetch_array($sql1)) {

                                $category_id_filter   = $row1['id'];
                                $category_name_filter = $row1['name'];

                            ?>

<option value="<?php echo $category_id_filter ?>"<?php echo $filter == $category_id_filter ? 'selected' : '' ?>><?php echo $category_name_filter ?></option>
<?php
}?>
                    </select>




                    <select name="place" id="place">
                        <option value="">Filter by Place</option>
                        <?php
                            $sql1 = mysqli_query($con, "SELECT * from places");

                            while ($row1 = mysqli_fetch_array($sql1)) {

                                $place_id_filter   = $row1['id'];
                                $place_name_filter = $row1['name'];

                            ?>

<option value="<?php echo $place_id_filter ?>"<?php echo $place == $place_id_filter ? 'selected' : '' ?>><?php echo $place_name_filter ?></option>
<?php
}?>
                    </select>

                    <script>

let placeId    =                 <?php echo json_encode($place ?? null); ?>;
let categoryId =                 <?php echo json_encode($filter ?? null); ?>;

                        document.getElementById('filter-type').addEventListener('change', function() {

                            categoryId = this.value

                            if(!placeId) {

                                document.location = `./lost.php?filter=${this.value}`;
                            } else {
                                document.location = `./lost.php?filter=${this.value}&place=${placeId}`;

                            }
                        });

                        document.getElementById('place').addEventListener('change', function() {

                            placeId = this.value

                            if(!categoryId) {

                                document.location = `./lost.php?place=${this.value}`;
                            } else {
                                document.location = `./lost.php?filter=${categoryId}&place=${placeId}`;

                            }
                        });

                    </script>

                    <button class="add-card-btn" id="addCardBtn">Add Your Own Card</button>
                </div>

                <!-- Card Container -->
                <div class="card-container">


                <?php
                    $sql1 = mysqli_query($con, $itemsSql);

                    while ($row1 = mysqli_fetch_array($sql1)) {

                        $item_id     = $row1['id'];
                        $category_id = $row1['category_id'];
                        $student_id  = $row1['student_id'];
                        $place_id    = $row1['place_id'];
                        $item_name   = $row1['name'];
                        $item_image  = $row1['image'];
                        $type        = $row1['type'];
                        $status      = $row1['status'];
                       
                        

                        $sql2 = mysqli_query($con, "SELECT * from categories WHERE id = '$category_id'");
                        $row2 = mysqli_fetch_array($sql2);

                        $category_name = $row2['name'];

                        $sql3 = mysqli_query($con, "SELECT * from places WHERE id = '$place_id'");
                        $row3 = mysqli_fetch_array($sql3);

                        $place_name = $row3['name'];

                    ?>


                    <div class="card                                                                                                                                                                                                                                                                                                                                     <?php echo $status == 2 ? 'expired' : '' ?>" data-type="<?php echo $type; ?>" data-location="<?php echo $last_seen_in ?>">
                        <img src="<?php echo $item_image; ?>" alt="<?php echo $type; ?>">
                        <div class="info">
                           <h5><i class="fa-solid fa-shirt"></i> <?php echo $item_name ?> </h5>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             <?php echo $type ?></h5>
                            <p><?php echo $item_name ?></p>
                        </div>
                        <div class="info">
                            <h5><i class="fa-solid fa-location-dot"></i> Found Location</h5>
                            <p><?php echo $place_name; ?></p>
                        </div>
                        <div class="info">
                            <h5><i class="fa-solid fa-tag"></i> Category</h5>
                            <p><?php echo $category_name; ?></p>
                        </div>
                        
  
                            <?php if ($student_id != $S_ID) {?>


<div class="contact">
    <button class="save  fs-14 bg-olive c-beige b-none w-fit btn-shape mt-10" id="btnFound"
        style="cursor: pointer;" data-item-id="<?php echo $item_id ?>">Contact Finder</button>
</div>

<?php }?>


                      
                          
                       
                    </div>
                         <?php
                         }?>

                </div>
            </div>
        </div>
    </div>

    <!-- New Card Form -->
    <div id="card" class="new-card hidden">
      <div class="card-header">
            <h2>Report Found Item</h2>
            <button id="closeCardBtn" class="close-btn">&times;</button>
        </div>
        <form action="./lost.php" method="POST" enctype="multipart/form-data">

        <input type="hidden" value="<?php echo $S_ID ?>" name="student_id">

            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" placeholder="Add Title to the item" name="name" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <input type="text" placeholder="Description of the item" name="description">
            </div>
            <div class="form-group">
                <label for="place_id">Last Seen</label>
                <select id="place_id" name="place_id" class="styled-select">
                    <option value="" disabled selected>Select your faculty</option>
                    <?php
                        $sql1 = mysqli_query($con, "SELECT * from places");

                        while ($row1 = mysqli_fetch_array($sql1)) {

                            $place_id   = $row1['id'];
                            $place_name = $row1['name'];

                        ?>

<option value="<?php echo $place_id ?>"><?php echo $place_name ?></option>
<?php
}?>
                </select>
            </div>
            <div class="form-group">
                <label for="category_id">Category</label>
                <select id="category_id" name="category_id" class="styled-select">
                <?php
                    $sql1 = mysqli_query($con, "SELECT * from categories WHERE type = 'losts'");

                    while ($row1 = mysqli_fetch_array($sql1)) {

                        $category_id   = $row1['id'];
                        $category_name = $row1['name'];

                    ?>

<option value="<?php echo $category_id ?>"><?php echo $category_name ?></option>
<?php
}?>
                </select>
            </div>
            <div class="form-group">
                <label for="last-seen">Upload Image</label>
                <input type="file" name="file" required>
            </div>
            <div class="last-btn">
                <button type="submit" name="Submit" class="btn-shape add-btn">Add</button>
            </div>
        </form>

    </div>

    <script>

        document.addEventListener("DOMContentLoaded", function () {

            document.getElementById('btnFound').addEventListener('click', async () => {
  // Assuming you have the item ID somewhere accessible in JS,
  // e.g., as a data attribute on the button or elsewhere
  const itemId = btnFound.dataset.itemId;  // example if stored in data-item-id attr
                console.log(itemId)
  if (!itemId) {
    alert('Item ID not set!');
    return;
  }

  try {
    console.log("Sending")
    const params = new URLSearchParams({ item_id: itemId });
    const response = await fetch('chat_api_about_lost.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
      body: params
    });
    console.log(response)

    if (!response.ok) throw new Error('Failed to create chat');

    const result = await response.json();
console.log(result)
    if (result.success && result.room_id) {
      // Redirect to chat.php with the new room (if needed, you can pass the room_id as param)
      console.log(result)
      
      window.location.href = 'chat.php?room=' + encodeURIComponent(result.room_id);
    } else {
      alert('Error: ' + (result.message || 'Unknown error'));
    }
  } catch (error) {
    alert('Request failed: ' + error.message);
  }
});


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
        document.getElementById('closeCardBtn').addEventListener('click', function () {
                document.getElementById('card').classList.add('hidden');
            });
    </script>
</body>

</html>