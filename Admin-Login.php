<?php
    session_start();

    include "./Connect.php";

    if (isset($_POST['Submit'])) {

        $email    = $_POST['email'];
        $password = ($_POST['password']);
        #$password = md5($_POST['password']);

        $query = mysqli_query($con, "SELECT * FROM administrator WHERE email ='$email' AND password = '$password'");

        if (mysqli_num_rows($query) > 0) {

            $row = mysqli_fetch_array($query);

            $id                = $row['id'];
            $_SESSION['A_Log'] = $id;

            echo '<script language="JavaScript">
          document.location="./Admin_Dashboard/";
          </script>';

        } else {

            echo '<script language="JavaScript">
	  alert ("Error ... Please Check Email Or Password !")
      </script>';
        }
    }
?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UniKey - Admin Login</title>
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
                <a href="landing.php" class="logo-link">
                    <img src="./imgs/logos/Unikey(large).jpg" alt="UniKey Logo" class="logo">
                    <span class="brand-name">UniKey</span>
                </a>
            </div>
            <div class="page-title">
                <h1>Login to Your Account</h1>
                <div class="title-underline"></div>
            </div>
        </div>
    </header>

    <div class="main-content">
        <div class="sign">
            <h2 class="form-title">Welcome Back</h2>
            <form action="./Admin-Login.php" method="post">
                <div class="form-group">
                    <label for="email">University Email</label>
                    <div class="input-wrapper">
                        <input type="email" id="email" placeholder="student@ju.edu.jo" name="email" required>
                        <i class="fa-solid fa-envelope input-icon"></i>
                    </div>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="input-wrapper">
                        <input type="password" id="password" placeholder="Enter your password" name="password" required>
                        <i class="fa-solid fa-lock input-icon"></i>
                        <i class="fa-solid fa-eye password-toggle" id="togglePassword"></i>
                    </div>
                </div>
                <div class="remember-me">
                    <input type="checkbox" class="ch" id="remember" name="remember">
                    <label for="remember">Remember me</label>
                </div>
                <!-- <input type="submit" value="Login" class="sub" name="insert"> -->
                 <button type="submit" name="Submit" class="sub">Login</button>
            </form>
            <div class="links">
                <a href="signup.php">Create an account</a> •
                <a href="pass.php">Forgot password?</a>
            </div>
        </div>
    </div>

    <script>
        // WARNING
        // document.addEventListener('DOMContentLoaded', function () {
        //         const loginForm = document.querySelector('form[method="post"]');

        //         if (loginForm) {
        //             loginForm.addEventListener('submit', function (e) {
        //                 e.preventDefault(); // Prevent actual form submission
        //                 window.location.href = 'dashboard.php'; // Change to your target page
        //             });
        //         }
        //     });
        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#password');

        togglePassword.addEventListener('click', function () {
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            this.classList.toggle('fa-eye-slash');
        });
    </script>
</body>

</html>
