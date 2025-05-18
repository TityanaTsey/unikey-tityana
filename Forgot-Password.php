<?php
    session_start();

    include "./Connect.php";
      use PHPMailer\PHPMailer\PHPMailer;

    require './phpmailer/src/Exception.php';
    require './phpmailer/src/PHPMailer.php';
    require './phpmailer/src/SMTP.php';

    if (isset($_POST['submit'])) {

        $email            = $_POST['email'];
        // $otp_code         = $_POST['otp_code'];
        // $password         = md5($_POST['password']);
        // $confirm_password = md5($_POST['confirm_password']);


            $query = mysqli_query($con, "SELECT * FROM students WHERE email ='$email'");

            if (mysqli_num_rows($query) > 0) {

                $row = mysqli_fetch_array($query);

                $student_id = $row['id'];
                $student_email = $row['email'];
                $otpCode = rand(1000, 9999);

                        $stmt = $con->prepare("UPDATE students SET otp_code = ? WHERE id = ?");

                        $stmt->bind_param("si", $otpCode, $student_id);
                        $stmt->execute();

                try {

                       

                        $mail = new PHPMailer(true);

                        

                        $mail->isSMTP();
                        $mail->Host       = 'smtp.gmail.com';
                        $mail->SMTPAuth   = true;
                        $mail->Username   = 'projectunikey@gmail.com';
                        $mail->Password   = 'ocnabhqxscjnfxfn';
                        $mail->SMTPSecure = 'ssl';
                        $mail->Port       = 465;

                        $mail->setFrom("projectunikey@gmail.com");

                        $mail->addAddress($student_email);

                        $mail->isHTML(true);

                        $mail->Subject = "OTP Verify";
                        $mail->Body    = "Your OTP Code is {$otpCode}";

                        $mail->send();

                        echo "<script language='JavaScript'>
                document.location='./Verify-OTP.php?email={$student_email}';
                   </script>";

                    } catch (Exception $e) {

                        echo "<script language='JavaScript'>
                        alert ('Something went wrong With sending OTP !');
                   </script>";
                    }

            } else {

                echo '<script language="JavaScript">
          alert ("Error ... Account Does not exist !")
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
    <title>UniKey - Forgot Password</title>
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
                <h1>Forgot Password</h1>
                <div class="title-underline"></div>
            </div>
        </div>
    </header>

    <div class="main-content">
        <div class="sign">
            <h2 class="form-title">Forgot Password</h2>
            <form action="/Forgot-Password.php" method="post">

                <div class="form-group">
                    <label for="email">University Email</label>
                    <div class="input-wrapper" style="position: relative;">
                        <input type="text" id="username" placeholder="Student" name="email" style="padding-right: 110px;"
                            oninput="updateEmail()" required>
                        <span
                            style="position: absolute; right: 40px; top: 50%; transform: translateY(-50%); color: #777;">@ju.edu.jo</span>
                        <i class="fa-solid fa-envelope input-icon"></i>
                    </div>
                    <input type="hidden" id="email" name="email">
                    <small class="form-text text-muted">Enter only your username</small>         
                 </div>

               


               

                <button type="submit"  class="sub" name="submit">Submit</button>
              
                
            </form>
            <div class="links">
                <a href="./signup.php">Create an account</a> •
                <a href="pass.html">Forgot password?</a>
            </div>
        </div>
    </div>

    <script>
        // WARNING
        document.addEventListener('DOMContentLoaded', function () {
                const loginForm = document.querySelector('form[method="post"]');

            
            });
        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#password');

        togglePassword.addEventListener('click', function () {
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            this.classList.toggle('fa-eye-slash');
            
        });
        function updateEmail() {
                const usernameInput = document.getElementById('username');
                const emailInput = document.getElementById('email');

                // Remove any @ or spaces from the username
                const cleanUsername = usernameInput.value.replace(/[@\s]/g, '').toLowerCase();
                usernameInput.value = cleanUsername;

                // Combine with fixed domain
                emailInput.value = cleanUsername + '@ju.edu.jo';
               }
               
    </script>
</body>

</html>
