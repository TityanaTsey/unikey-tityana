<?php
    session_start();

    include "../Connect.php";

    $S_ID    = $_SESSION['S_Log'];
    $item_id = $_GET['item_id'];

    if (! $S_ID) {

        echo '<script language="JavaScript">
     document.location="../login.php";
    </script>';

    } else {

        $sql1 = mysqli_query($con, "select * from students where id='$S_ID'");
        $row1 = mysqli_fetch_array($sql1);

        $name  = $row1['fname'] . ' ' . $row1['lname'];
        $email = $row1['email'];

        $sql222 = mysqli_query($con, "select * from lost_founds where id='$item_id'");
        $row222 = mysqli_fetch_array($sql222);

        $lost_category_id = $row222['category_id'];
        $lost_place_id    = $row222['place_id'];
        $item_name        = $row222['name'];

        if (isset($_POST['Submit'])) {

            $item_id     = $_POST['item_id'];
            $category_id = $_POST['category_id'];
            $place_id    = $_POST['place_id'];
            $name        = $_POST['name'];
            $image       = $_FILES["file"]["name"];

            if ($image) {

                $image = 'Losts_Images/' . $image;

                $stmt = $con->prepare("UPDATE lost_founds SET name = ?, category_id = ?, place_id = ?, image = ? WHERE id = ?");

                $stmt->bind_param("siisi", $name, $category_id, $place_id, $image, $item_id);
            } else {

                $stmt = $con->prepare("UPDATE lost_founds SET name = ?, category_id = ?, place_id = ? WHERE id = ?");

                $stmt->bind_param("siii", $name, $category_id, $place_id, $item_id);
            }

            if ($stmt->execute()) {

                if ($image) {

                    move_uploaded_file($_FILES["file"]["tmp_name"], "./Losts_Images/" . $_FILES["file"]["name"]);
                }

                echo "<script language='JavaScript'>
              alert ('Updated Successfully !');
         </script>";

                echo "<script language='JavaScript'>
        document.location='./index.php';
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
    <title>UniKey - Edit Item</title>
    <!-- favicon -->
    <link rel="icon" type="image/png" href="favicon/favicon-96x96.png" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="favicon/favicon.svg" />
    <link rel="shortcut icon" href="favicon/favicon.ico" />
    <link rel="apple-touch-icon" sizes="180x180" href="favicon/apple-touch-icon.png" />
    <link rel="manifest" href="favicon/site.webmanifest" />
    <!-- css -->
    <link rel="stylesheet" href="../css/all.min.css" />
    <link rel="stylesheet" href="../css/framework.css" />
    <link rel="stylesheet" href="../css/dashboard.css" />
    <link rel="stylesheet" href="../css/side.css" />
    <!-- fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet" />
</head>

<body>
    <div class="page d-flex">
        <!-- Sidebar Navigation -->
        <div class="sidebar bg-white p-20 p-relative" id="sidebar">
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
                        <i class="fa-solid fa-right-from-bracket"></i>
                    </span>
                </div>
            </div>

            <!-- Edit Form Section -->
            <div class="dashboard-section">
                <div class="edit-form" m,e id="editForm">



                <h2><i class="fa-solid fa-store"></i> Edit Marketplace Item</h2>
                <form id="itemForm" method="POST" action="./Edit-Lost-Item.php?item_id=<?php echo $item_id ?>" enctype="multipart/form-data">


                <input type="hidden" name="item_id" value="<?php echo $item_id ?>">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" id="name" name="name" value="<?php echo $item_name ?>" required>
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

<option value="<?php echo $category_id ?>"<?php echo($category_id == $marketplace_category_id ? 'selected' : '') ?>><?php echo $category_name ?></option>
<?php
}?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="place_id">Place</label>
                        <select id="place_id" name="place_id">
                        <?php
                            $sql1 = mysqli_query($con, "SELECT * from places");

                            while ($row1 = mysqli_fetch_array($sql1)) {

                                $place_id_filter   = $row1['id'];
                                $place_name_filter = $row1['name'];

                            ?>

<option value="<?php echo $place_id_filter ?>"<?php echo $lost_place_id == $place_id_filter ? 'selected' : '' ?>><?php echo $place_name_filter ?></option>
<?php
}?>
                        </select>
                    </div>



                    <div class="form-group">
                        <label for="image">Upload Image</label>
                        <input type="file" id="image" name="image">
                    </div>

                    <div class="form-actions">
                        <button type="button" class="btn btn-cancel" onclick="window.location.href='dashboard.html'">Cancel</button>
                        <button type="submit" name="Submit" class="btn btn-save">Save Changes</button>
                    </div>
                </form>




                </div>
            </div>
        </div>
    </div>


</body>

</html>