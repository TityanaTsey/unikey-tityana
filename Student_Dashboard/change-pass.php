<?php
    session_start();

    include "../Connect.php";

    $S_ID = $_SESSION['S_Log'];

    if (! $S_ID) {

        echo '<script language="JavaScript">
     document.location="../login.php";
    </script>';

    } else {

        $sql1 = mysqli_query($con, "select * from students where id='$S_ID'");
        $row1 = mysqli_fetch_array($sql1);

        $name = $row1['fname'] . ' ' . $row1['lname'];

        if (isset($_POST['Submit'])) {

            $student_id       = $_POST['student_id'];
            $password         = md5($_POST['password']);
            $confirm_password = md5($_POST['confirm_password']);

            if ($password != $confirm_password) {

                echo "<script language='JavaScript'>
                alert ('Passwords does not match !');
           </script>";

            } else {

                $stmt = $con->prepare("UPDATE students SET password = ? WHERE id = ?");

                $stmt->bind_param("si", $password, $student_id);
                $stmt->execute();


                echo '<script language="JavaScript">
                alert ("Password Changed !")
                </script>';

                echo '<script language="JavaScript">
                  document.location="./change-pass.php";
                  </script>';

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
    <title>UniKey - Change Password</title>
    <!-- favicon -->
    <link rel="icon" type="image/png" href="favicon/favicon-96x96.png" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="favicon/favicon.svg" />
    <link rel="shortcut icon" href="favicon/favicon.ico" />
    <link rel="apple-touch-icon" sizes="180x180" href="favicon/apple-touch-icon.png" />
    <link rel="manifest" href="favicon/site.webmanifest" />
    <!-- css -->
    <link rel="stylesheet" href="../css/all.min.css" />
    <link rel="stylesheet" href="../css/framework.css" />
    <link rel="stylesheet" href="../css/side.css" />
    <!-- fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet" />
        <style>
            .change-password-section {
                background: white;
                border-radius: 8px;
                padding: 30px;
                margin: 30px auto;
                box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
                width: 600px;
                max-width: 90%;
            }

            .password-form-container {
                width: 100%;
            }

            .password-input {
                position: relative;
                margin-bottom: 20px;
            }

            .password-input input {
                width: 100%;
                padding: 12px 40px 12px 15px;
                border: 1px solid #ddd;
                border-radius: 6px;
                font-size: 16px;
                transition: border-color 0.3s;
            }

            .password-input input:focus {
                border-color: #314528;
                outline: none;
            }

            .toggle-password {
                position: absolute;
                right: 15px;
                top: 50%;
                transform: translateY(-50%);
                cursor: pointer;
                color: #777;
                transition: color 0.2s;
            }

            .toggle-password:hover {
                color: #314528;
            }

            .match-indicator {
                font-size: 13px;
                margin-top: 5px;
                color: #314528;
                display: none;
            }

            .match-indicator i {
                margin-right: 5px;
            }

            .form-actions {
                display: flex;
                justify-content: flex-end;
                gap: 15px;
                margin-top: 25px;
            }

            .btn-shape {
                padding: 10px 20px;
                border-radius: 6px;
                font-weight: 500;
                cursor: pointer;
                transition: all 0.2s;
            }

            .cancel-btn {
                background-color: #f1f1f1;
                border: 1px solid #ddd;
                color: #333;
            }

            .cancel-btn:hover {
                background-color: #e5e5e5;
            }

            .confirm-btn {
                background-color: #314528;
                color: white;
                border: none;
            }

            .confirm-btn:hover {
                background-color: #1e2a1a;
            }

            /* Responsive adjustments */
            @media (max-width: 600px) {
                .change-password-section {
                    padding: 20px;
                    width: 90%;
                }

                .form-actions {
                    flex-direction: column;
                }

                .btn-shape {
                    width: 100%;
                }
            }</style>
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

            <div class="change-password-section">
                <h2 class="section-title">
                    <i class="fa-solid fa-lock"></i> Change Password
                </h2>

                <div class="password-form-container">
                    <form id="changePasswordForm" action="./change-pass.php" method="POST">

                    <input type="hidden" name="student_id" value="<?php echo $S_ID ?>">

                        <div class="form-group">
                            <label for="newPassword">New Password</label>
                            <div class="password-input">
                                <input type="password" id="newPassword" name="password" required>
                                <i class="fa-solid fa-eye toggle-password"></i>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="confirmPassword">Confirm New Password</label>
                            <div class="password-input">
                                <input type="password" id="confirmPassword" name="confirm_password" required>
                                <i class="fa-solid fa-eye toggle-password"></i>
                            </div>
                            <p class="match-indicator"><i class="fa-solid fa-check"></i> Passwords match</p>
                        </div>

                        <div class="form-actions">
                            <button type="button" class="btn-shape cancel-btn">Cancel</button>
                            <button type="submit" name="Submit" class="btn-shape confirm-btn" id="savePasswordBtn" style="background-color: #314528;">Change Password</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script >
    // Password toggle visibility
        document.querySelectorAll('.toggle-password').forEach(icon => {
            icon.addEventListener('click', function () {
                const input = this.previousElementSibling;
                if (input.type === 'password') {
                    input.type = 'text';
                    this.classList.replace('fa-eye', 'fa-eye-slash');
                } else {
                    input.type = 'password';
                    this.classList.replace('fa-eye-slash', 'fa-eye');
                }
            });
        });

        // Password match indicator
        document.getElementById('confirmPassword').addEventListener('input', function () {
            const newPassword = document.getElementById('newPassword').value;
            const confirmPassword = this.value;
            const matchIndicator = document.querySelector('.match-indicator');

            if (confirmPassword.length === 0) {
                matchIndicator.style.display = 'none';
                return;
            }

            if (newPassword === confirmPassword) {
                matchIndicator.style.display = 'block';
                matchIndicator.style.color = '#314528';
                matchIndicator.innerHTML = '<i class="fa-solid fa-check"></i> Passwords match';
            } else {
                matchIndicator.style.display = 'block';
                matchIndicator.style.color = '#ff4d4d';
                matchIndicator.innerHTML = '<i class="fa-solid fa-times"></i> Passwords do not match';
            }
        });

        // Form submission
        // document.getElementById('changePasswordForm').addEventListener('submit', function (e) {
        //     e.preventDefault();

        //     const currentPassword = document.getElementById('currentPassword').value;
        //     const newPassword = document.getElementById('newPassword').value;
        //     const confirmPassword = document.getElementById('confirmPassword').value;

        //     if (newPassword !== confirmPassword) {
        //         alert('Passwords do not match!');
        //         return;
        //     }

        //     // Here you would typically make an API call to change the password
        //     alert('Password changed successfully!');
        //     this.reset();
        //     document.querySelector('.password-strength').style.display = 'none';
        //     document.querySelector('.match-indicator').style.display = 'none';
        // });

        // Cancel button
        document.querySelector('.cancel-btn').addEventListener('click', function () {
            document.getElementById('changePasswordForm').reset();
            document.querySelector('.password-strength').style.display = 'none';
            document.querySelector('.match-indicator').style.display = 'none';
        });</script>
</body>

</html>