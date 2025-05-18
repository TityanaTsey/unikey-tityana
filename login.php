<?php
    session_start();

    include "./Connect.php";

    if (isset($_POST['Submit'])) {

        $email    = $_POST['email'];
       # $password = $_POST['password'];
        $password = md5($_POST['password']);

        $query = mysqli_query($con, "SELECT * FROM students WHERE email ='$email' AND password = '$password'");

        if (mysqli_num_rows($query) > 0) {

            $row = mysqli_fetch_array($query);

            $id                = $row['id'];
            $active            = $row['active'];
            $_SESSION['S_Log'] = $id;

            if ($active == 1) {

                echo '<script language="JavaScript">
                document.location="./Student_Dashboard/";
                </script>';
            } else {

                echo '<script language="JavaScript">
                alert ("Acount Is Deativated !")
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

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UniKey - Login</title>
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
    <style>
       
    </style>
</head>

<body style="height: 800px;">

    <header class="new-header">
        <div class="header-container">
            <div class="logo-container">
                <a href="Student_Dashboard/landing.php" class="logo-link">
                    <img src="../imgs/logos/Unikey(large).jpg" alt="UniKey Logo" class="logo" onclick="window.location.href='Student_Dashboard/landing.php'">
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
            <form action="./login.php" method="post">
                <div class="form-group">
                    <label for="email">University Email</label>
                    <div class="input-wrapper" style="position: relative;">
                        <input type="text" id="username" placeholder="Student" name="username" style="padding-right: 110px;"
                            oninput="updateEmail()" required>
                        <span
                            style="position: absolute; right: 40px; top: 50%; transform: translateY(-50%); color: #777;">@ju.edu.jo</span>
                        <i class="fa-solid fa-envelope input-icon"></i>
                    </div>
                    <input type="hidden" id="email" name="email">
                    <small class="form-text text-muted">Enter only your username</small>         
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
                <button type="submit" name="Submit" class="sub">Login</button>
            </form>
            <div class="links">
                <a href="./signup.php">Create an account</a> •
                <a href="./Forgot-Password.php">Forgot password?</a>
            </div>
        </div>
    </div>

    <footer class="login-footer">
        <p>Having trouble logging in?</p>
        <p>Please contact us at <a href="mailto:support@unikey.edu">unihelpergp1@gmail.com</a></p>
        <p>&copy; 2025 UniKey. All rights reserved.</p>
    </footer>

    <script>
        // Password toggle
        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#password');

        togglePassword.addEventListener('click', function () {
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            this.classList.toggle('fa-eye-slash');
        });

        // Language switcher functionality
        const languageBtn = document.getElementById('languageBtn');
        const languageDropdown = document.getElementById('languageDropdown');
        
        // Toggle dropdown visibility
        languageBtn.addEventListener('click', () => {
            languageDropdown.classList.toggle('show');
        });
        
        // Close dropdown when clicking outside
        document.addEventListener('click', (e) => {
            if (!languageBtn.contains(e.target) && !languageDropdown.contains(e.target)) {
                languageDropdown.classList.remove('show');
            }
        });
        
        // Language selection
        document.querySelectorAll('.language-option').forEach(option => {
            option.addEventListener('click', () => {
                const selectedLang = option.getAttribute('data-lang');
                const selectedFlag = option.querySelector('.language-flag').src;
                const selectedText = option.querySelector('span').textContent;
                
                // Update button
                languageBtn.querySelector('.language-flag').src = selectedFlag;
                languageBtn.querySelector('span').textContent = selectedText;
                
                // Close dropdown
                languageDropdown.classList.remove('show');
                
                // Here you would implement actual language change logic
                console.log('Language changed to:', selectedLang);
            });
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