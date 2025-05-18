<?php
    session_start();

    include "../Connect.php";

    $S_ID = $_SESSION['S_Log'];

    $category_id_selected   = $_GET['category_id'];
    $department_id_selected = $_GET['department_id'];

    $marketplacesSql = #"SELECT * FROM marketplaces ORDER BY id DESC";
    "SELECT m.*
FROM marketplaces m
JOIN students s ON m.student_id = s.id
WHERE m.status != 'Expired'
  AND s.active = 1
ORDER BY m.id DESC;";
  

    if ($category_id_selected && $department_id_selected) {

        $marketplacesSql = #"SELECT * from marketplaces WHERE category_id = '$category_id_selected' AND department_id = '$department_id_selected' ORDER BY id DESC";
        "SELECT * from marketplaces WHERE category_id = '$category_id_selected'   AND department_id = '$department_id_selected'AND status != 'Expired'ORDER BY id DESC";
       

    } else if ($category_id_selected) {

        $marketplacesSql = #"SELECT * from marketplaces WHERE category_id = '$category_id_selected' ORDER BY id DESC";
        "SELECT * from marketplaces WHERE category_id = '$category_id_selected'   AND status != 'Expired'   ORDER BY id DESC";
       

    } else if ($department_id_selected) {

        $marketplacesSql =#"SELECT * from marketplaces WHERE department_id = '$department_id_selected' ORDER BY id DESC";
        "SELECT * from marketplaces  WHERE department_id = '$department_id_selected'   AND status != 'Expired'    ORDER BY id DESC";
       

    }

    if (! $S_ID) {

        echo '<script language="JavaScript">
     document.location="../login.php";
    </script>';

    } else {

        $sql1 = mysqli_query($con, "select * from students where id='$S_ID'");
        $row1 = mysqli_fetch_array($sql1);

        $name  = $row1['fname'] . ' ' . $row1['lname'];
        $email = $row1['email'];

        if (isset($_POST['Submit'])) {

            $department_id = $_POST['department_id'];
            $category_id   = $_POST['category_id'];
            $student_id    = $_SESSION['S_Log'];
            $name          = $_POST['name'];
            $description   = $_POST['description'];
            $status        = $_POST['status'];
            $image         = $_FILES["file"]["name"];
            $image         = 'MarketPlaces_Images/' . $image;

            $stmt = $con->prepare("INSERT INTO marketplaces (category_id, student_id, department_id, name, description, image) VALUES (?, ?, ?, ?, ?, ?) ");

            $stmt->bind_param("iiisss", $category_id, $student_id, $department_id, $name, $description, $image);

            if ($stmt->execute()) {

                move_uploaded_file($_FILES["file"]["tmp_name"], "./MarketPlaces_Images/" . $_FILES["file"]["name"]);

                echo "<script language='JavaScript'>
              alert ('Item Added Successfully !');
         </script>";

                echo "<script language='JavaScript'>
        document.location='./marketplace.php';
           </script>";

            }
        }

    }

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>UniKey - BookTrade</title>
    <!-- favicon -->
    <link rel="icon" type="image/png" href="favicon/favicon-96x96.png" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="favicon/favicon.svg" />
    <link rel="shortcut icon" href="favicon/favicon.ico" />
    <link rel="apple-touch-icon" sizes="180x180" href="favicon/apple-touch-icon.png" />
    <link rel="manifest" href="favicon/site.webmanifest" />
    <!-- css -->
    <link rel="stylesheet" href="../css/marketplace.css" />
    <link rel="stylesheet" href="../css/all.min.css" />
    <link rel="stylesheet" href="../css/framework.css" />
    <link rel="stylesheet" href="../css/side.css" />
    <!-- google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;500&display=swap" rel="stylesheet" />
    <style>

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
            <h1 class="p-relative">BookTrade</h1>
            <!-- Filter Section -->
            <div class="filter-section ">
                <select name="department_id" id="filter-type" >
                    <option value=""  >Filter by Faculty</option>
                    <?php
                        $sql1 = mysqli_query($con, "SELECT * from departments");

                        while ($row1 = mysqli_fetch_array($sql1)) {

                            $department_id_filter   = $row1['id'];
                            $department_name_filter = $row1['name'];

                        ?>

<option value="<?php echo $department_id_filter ?>"<?php echo $department_id_filter == $department_id_selected ? 'selected' : '' ?>><?php echo $department_name_filter ?></option>
<?php
}?>
                </select>

                <select name="category_id" id="category_id">
                    <option value=""  >Filter by Category</option>
                    <?php
                        $sql1 = mysqli_query($con, "SELECT * from categories WHERE type = 'losts'");

                        while ($row1 = mysqli_fetch_array($sql1)) {

                            $category_id_filter   = $row1['id'];
                            $category_name_filter = $row1['name'];

                        ?>

<option value="<?php echo $category_id_filter ?>"<?php echo $category_id_filter == $category_id_selected ? 'selected' : '' ?>><?php echo $category_name_filter ?></option>
<?php
}?>
                </select>


                <script>

                        let categoryId =                                                                                                                                                                 <?php echo json_encode($category_id_selected ?? null); ?>;
                        let depId =                                                                                                                                             <?php echo json_encode($department_id_selected ?? null); ?>;


                        document.getElementById('filter-type').addEventListener('change', function() {

                            depId = this.value;

                            if(!categoryId) {

                                document.location = `./marketplace.php?department_id=${this.value}`;
                            } else {
                                document.location = `./marketplace.php?department_id=${this.value}&category_id=${categoryId}`;

                            }
                        });

                        document.getElementById('category_id').addEventListener('change', function() {

                            categoryId = this.value;

                            if(!depId) {

                                document.location = `./marketplace.php?category_id=${this.value}`;
                            } else {
                                document.location = `./marketplace.php?department_id=${depId}&category_id=${this.value}`;

                            }
                        });
                    </script>
                <button class="add-card-btn" id="addCardBtn" onclick="openAddCardForm()">Add Your Own Card</button>
            </div>

            <div class="friends-page d-grid m-20 gap-20">
                <!-- First 5 available items -->

                <?php
                    $sql1 = mysqli_query($con, $marketplacesSql);

                    while ($row1 = mysqli_fetch_array($sql1)) {

                        $marketplace_id    = $row1['id'];
                        $marketplace_name  = $row1['name'];
                        $marketplace_image = $row1['image'];
                        $status            = $row1['status'];
                        $description       = $row1['description'];
                        $category_id       = $row1['category_id'];
                        $student_id        = $row1['student_id'];

                        $sql2 = mysqli_query($con, "SELECT * from categories WHERE id = '$category_id'");
                        $row2 = mysqli_fetch_array($sql2);

                        $category_name = $row2['name'];

                        $sql3 = mysqli_query($con, "SELECT * from students WHERE id = '$student_id'");
                        $row3 = mysqli_fetch_array($sql3);

                        $student_name = $row3['name'];

                    ?>
                <div class="friend bg-white rad-6 p-20 p-relative <?php echo ($status == 'Expired' ? 'expired' : '' )?>">

                <?php if($status == 'Expired') {?>
                    <div class="expired-tag">EXPIRED</div>
                <?php }?>
                    <div class="txt-c">
                        <div class="notebook-image-container">
                            <img class="notebook-image" src="<?php echo $marketplace_image ?>" alt="<?php echo $marketplace_name ?>" />
                        </div>
                        <h4 class="mt-10"><?php echo $marketplace_name ?></h4>
                        <p class="c-grey fs-13 mt-5 mb-0"><?php echo $description ?></p>
                    </div>
                    <div class="tags mt-10 mb-10">
                    <span class="tag"><?php echo $category_name ?></span>
                    </div>
                    <span class="availability c-grey mb-10 mt-10">Available for Exchange</span>
                    <div class="contact">

                    <?php if ($student_id != $S_ID) {?>


<div class="contact">
    <button class="save  fs-14 bg-olive c-beige b-none w-fit btn-shape mt-10 btnmarketchat" id="btnmarketchat"
        style="cursor: pointer;" data-market-id="<?php echo $marketplace_id ?>">Contact Owner</button>
</div>

<?php }?>
                    </div>
                </div>
                <?php
                }?>




                <!-- <div class="friend bg-white rad-6 p-20 p-relative">
                    <div class="txt-c">
                        <div class="notebook-image-container">
                            <img class="notebook-image" src="imgs/book2.png" alt="Cryptography Notebook" />
                        </div>
                        <h4 class="mt-10">Cryptography</h4>
                        <p class="c-grey fs-13 mt-5 mb-0">Notebook by Ayham Ayman 2024</p>
                    </div>
                    <div class="tags mt-10 mb-10">
                        <span class="tag">Cyber</span>
                        <span class="tag">Security</span>
                    </div>
                    <span class="availability c-grey mb-10 mt-10">Available for Exchange</span>
                    <div class="contact">
                        <button class="save fs-14 bg-olive c-beige b-none w-fit btn-shape mt-10" id="btn-found"
                            style="cursor: pointer;">Contact</button>
                    </div>
                </div>

                <div class="friend bg-white rad-6 p-20 p-relative">
                    <div class="txt-c">
                        <div class="notebook-image-container">
                            <img class="notebook-image" src="imgs/book3.png" alt="Statistics Notebook" />
                        </div>
                        <h4 class="mt-10">Statistics</h4>
                        <p class="c-grey fs-13 mt-5 mb-0">Notebook by Abdallah Bassam 2022</p>
                    </div>
                    <div class="tags mt-10 mb-10">
                        <span class="tag">CS</span>
                        <span class="tag">CIS</span>
                        <span class="tag">AI</span>
                        <span class="tag">DS</span>
                        <span class="tag">Cyber</span>
                    </div>
                    <span class="availability c-grey mb-10 mt-10">Available for Exchange</span>
                    <div class="contact">
                        <button class="save fs-14 bg-olive c-beige b-none w-fit btn-shape mt-10" id="btn-found"
                            style="cursor: pointer;">Contact</button>
                    </div>
                </div>

                <div class="friend bg-white rad-6 p-20 p-relative">
                    <div class="txt-c">
                        <div class="notebook-image-container">
                            <img class="notebook-image" src="imgs/book4.png" alt="Operation System Notebook" />
                        </div>
                        <h4 class="mt-10">Operation System</h4>
                        <p class="c-grey fs-13 mt-5 mb-0">Notebook by Jomman Salamah 2023</p>
                    </div>
                    <div class="tags mt-10 mb-10">
                        <span class="tag">CS</span>
                        <span class="tag">CIS</span>
                        <span class="tag">BIT</span>
                        <span class="tag">Cyber</span>
                    </div>
                    <span class="availability c-grey mb-10 mt-10">Available for Exchange</span>
                    <div class="contact">
                        <button class="save fs-14 bg-olive c-beige b-none w-fit btn-shape mt-10" id="btn-found"
                            style="cursor: pointer;">Contact</button>
                    </div>
                </div>

                <div class="friend bg-white rad-6 p-20 p-relative">
                    <div class="txt-c">
                        <div class="notebook-image-container">
                            <img class="notebook-image" src="imgs/book7.png" alt="C++ Notebook" />
                        </div>
                        <h4 class="mt-10">C++</h4>
                        <p class="c-grey fs-13 mt-5 mb-0">Notebook by Roaa Bassam 2023</p>
                    </div>
                    <div class="tags mt-10 mb-10">
                        <span class="tag">Web Design</span>
                        <span class="tag">Design</span>
                    </div>
                    <span class="availability c-grey mb-10 mt-10">Available for Exchange</span>
                    <div class="contact">
                        <button class="save fs-14 bg-olive c-beige b-none w-fit btn-shape mt-10" id="btn-found"
                            style="cursor: pointer;">Contact</button>
                    </div>
                </div>

                <div class="friend bg-white rad-6 p-20 p-relative expired">
                    <div class="expired-tag">EXPIRED</div>
                    <div class="txt-c">
                        <div class="notebook-image-container">
                            <img class="notebook-image" src="imgs/book6.png" alt="Web Development Notebook" />
                        </div>
                        <h4 class="mt-10">Web Development</h4>
                        <p class="c-grey fs-13 mt-5 mb-0">Notebook by Aya Zeyad 2022</p>
                    </div>
                    <div class="tags mt-10 mb-10">
                        <span class="tag">CS</span>
                        <span class="tag">CIS</span>
                    </div>
                    <span class="availability c-grey mb-10 mt-10">No Longer Available</span>
                    <div class="contact">
                        <button class="save fs-14 bg-olive c-beige b-none w-fit btn-shape mt-10" id="btn-found"
                            style="cursor: not-allowed;" disabled>Contact</button>
                    </div>
                </div>

                <div class="friend bg-white rad-6 p-20 p-relative expired">
                    <div class="expired-tag">EXPIRED</div>
                    <div class="txt-c">
                        <div class="notebook-image-container">
                            <img class="notebook-image" src="imgs/book5.png" alt="Networks Notebook" />
                        </div>
                        <h4 class="mt-10">Networks</h4>
                        <p class="c-grey fs-13 mt-5 mb-0">Notebook by Ayham Almahsery 2023</p>
                    </div>
                    <div class="tags mt-10 mb-10">
                        <span class="tag">CS</span>
                        <span class="tag">CIS</span>
                        <span class="tag">BIT</span>
                        <span class="tag">DS</span>
                        <span class="tag">Cyber</span>
                        <span class="tag">AI</span>
                    </div>
                    <span class="availability c-grey mb-10 mt-10">No Longer Available</span>
                    <div class="contact">
                        <button class="save fs-14 bg-olive c-beige b-none w-fit btn-shape mt-10" id="btn-found"
                            style="cursor: not-allowed;" disabled>Contact</button>
                    </div>
                </div> -->
            </div>
        </div>
    </div>
    <div id="card" class="new-card hidden" style="height: 535px !important;">
        <div class="card-header">
            <h2>Report Found Item</h2>
            <button id="closeCardBtn" class="close-btn">&times;</button>
        </div>
        <form action="./marketplace.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" placeholder="Add Title to the item" name="name">
            </div>
            <div class="form-group">
                <label for="fn">Desciption</label>
                <input type="text" placeholder="Desciption of the item" name="description">
            </div>
            <div class="form-group">
                <label for="category_id">Category</label>
                <select id="category_id" name="category_id">
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
                <label for="department_id">Faculty</label>
                <select id="department_id" name="department_id">
                <?php
                    $sql1 = mysqli_query($con, "SELECT * from departments");

                    while ($row1 = mysqli_fetch_array($sql1)) {

                        $department_id   = $row1['id'];
                        $department_name = $row1['name'];

                    ?>

<option value="<?php echo $department_id ?>"><?php echo $department_name ?></option>
<?php
}?>
                </select>
            </div>
            <div class="form-group" >
                <label for="fn">Upload Image</label>
                <input type="file" name="file">
            </div>
            <div class="last-btn">
                <button type="submit" name="Submit" class="btn-shape add-btn">Add</button>
            </div>
        </form>
    </div>
    <script>
        function navigateToPage(url) {
            window.location.href = url;
        }

        document.addEventListener("DOMContentLoaded", function () {
            const buttons = document.querySelectorAll('.btnmarketchat');

            buttons.forEach(btn => {
    btn.addEventListener('click', async (e) => {

 
  
  const market_id = btn.dataset.marketId;

  if (!market_id) {
    alert('market ID not set!');
    return;
  }

  try {
    console.log("Sending")
    const params = new URLSearchParams({ market_id: market_id });
    const response = await fetch('chat_api_about_marketplace.php', {
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
            })
            });
       

        document.getElementById('addCardBtn').addEventListener('click', function () {
            // Show the card
            document.getElementById('card').classList.remove('hidden');
            // Add blur effect to the background
            document.querySelector('.content').classList.add('blur');
        });

        document.getElementById('closeCardBtn').addEventListener('click', function () {
            // Hide the card
            document.getElementById('card').classList.add('hidden');
            // Remove blur effect from the background
            document.querySelector('.content').classList.remove('blur');
        });
        document.getElementById('closeCardBtn').addEventListener('click', function () {
                document.getElementById('card').classList.add('hidden');
            });
    </script>
</body>

</html>