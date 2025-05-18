<?php
    session_start();

    include "./Connect.php";

    $email = $_GET['email'];
    

    if (isset($_POST['Submit'])) {

        $otp_code = $_POST['otp_code'];
        $pass   = md5($_POST['pass']);
        $confirm_pass  = md5($_POST['confirm_pass']);

        $query = mysqli_query($con, "SELECT id, otp_code FROM students WHERE email ='$email'");

        if (mysqli_num_rows($query) > 0) {

            $row = mysqli_fetch_array($query);

            $OTPCode    = $row['otp_code'];
            $student_id = $row['id'];

            if ($otp_code != $OTPCode) {

                echo '<script language="JavaScript">
                alert ("Wrong OTP, Please Try Again !")
                </script>';
            } else {

                $active = 1;

                $stmt = $con->prepare("UPDATE students SET password = ? WHERE id = ?");

                $stmt->bind_param("si", $pass, $student_id);
                $stmt->execute();

                echo '<script language="JavaScript">
              document.location="./login.php";
              </script>';
            }

        } else {

            echo '<script language="JavaScript">
	  alert ("Error ... Please Check Email Or Password !")
      </script>';
        }
    }
?>


<!DOCTYPE html>
<html lang="en">
<!-- ocnabhqxscjnfxfn -->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UniKey - Verify OTP</title>
    <!-- favicon -->
    <link rel="icon" type="image/png" href="favicon/favicon-96x96.png" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="favicon/favicon.svg" />
    <link rel="shortcut icon" href="favicon/favicon.ico" />
    <link rel="apple-touch-icon" sizes="180x180" href="favicon/apple-touch-icon.png" />
    <link rel="manifest" href="favicon/site.webmanifest" />
    <!-- css -->
    <link rel="stylesheet" href="css/login_signup.css">
    <link rel="stylesheet" href="css/framework.css">
    <link rel="stylesheet" href="css/all.min.css">
    <!-- google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body style="height: 800px;">
    <header class="new-header">
        <div class="header-container">
            <div class="logo-container">
                <a href="landing.html" class="logo-link">
                    <img src="imgs/logos/Unikey(large).jpg" alt="UniKey Logo" class="logo">
                    <span class="brand-name">UniKey</span>
                </a>
            </div>
            <div class="page-title">
                <h1>Verify OTP Form</h1>
                <div class="title-underline"></div>
            </div>

        </div>
    </header>

    <div class="main-content">
        <div class="sign">
            <h2 class="form-title">Welcome Back</h2>
            <form action="./Verify-OTP.php?email=<?php echo $email ?>" method="post">


            <input type="hidden" name="email" value="<?php echo $email ?>">

                <div class="form-group">
                    <label for="otp_code">OTP code</label>
                    <div class="input-wrapper">
                        <input type="otp_code" id="otp_code" name="otp_code" required>
                        <i class="fa-solid fa-envelope input-icon"></i>
                    </div>
                </div>
                 <div class="form-group">
                    <label for="pass">New Password</label>
                    <div class="input-wrapper">
                    <input type="password" id="pass" placeholder="Create a password" name="pass" required>
                        <i class="fa-solid fa-lock input-icon"></i>
                        <i class="fa-solid fa-eye password-toggle" id="togglePassword1"></i>
                    </div>
                </div>
                <div class="form-group">
                    <label for="confirm-pass">Confirm New Password</label>
                    <div class="input-wrapper">
                    <input type="password" id="confirm-pass" placeholder="Confirm your password" name="confirm_pass"
                    required>
                        <i class="fa-solid fa-lock input-icon"></i>
                        <i class="fa-solid fa-eye password-toggle" id="togglePassword2"></i>
                    </div>
                </div>

                <!-- <input type="submit" value="Verify" class="sub" name="Submit"> -->
                 <button type="submit" name="Submit" class="sub">Verify</button>
            </form>
            <div class="links">
                <a href="./signup.php">Create an account</a> •
                <a href="./Forgot-Password.php">Forgot password?</a>
            </div>
        </div>
    </div>

    <!-- <script>
        // WARNING
        document.addEventListener('DOMContentLoaded', function () {
                const loginForm = document.querySelector('form[method="post"]');

                if (loginForm) {
                    loginForm.addEventListener('submit', function (e) {
                        e.preventDefault(); // Prevent actual form submission
                        window.location.href = 'dashboard.html'; // Change to your target page
                    });
                }
            });
        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#password');

        togglePassword.addEventListener('click', function () {
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            this.classList.toggle('fa-eye-slash');
        });
    </script> -->
</body>

</html>
