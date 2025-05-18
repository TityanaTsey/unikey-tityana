
<?php
    session_start();

    include "./Connect.php";

    use PHPMailer\PHPMailer\PHPMailer;

    require './phpmailer/src/Exception.php';
    require './phpmailer/src/PHPMailer.php';
    require './phpmailer/src/SMTP.php';

    if (isset($_POST['Submit'])) {

        $fn            = $_POST['fn'];
        $ln            = $_POST['ln'];
        $email         = $_POST['email'];
        $pass          = md5($_POST['pass']);
        $confirm_pass  = md5($_POST['confirm_pass']);
        $department_id = $_POST['department_id'];
        $major_id      = $_POST['major_id'];

        $query = mysqli_query($con, "SELECT * FROM students WHERE email ='$email'");

        if (mysqli_num_rows($query) > 0) {

            echo '<script language="JavaScript">
            alert ("Account Already exist !")
            </script>';

        } else {

            if ($pass != $confirm_pass) {

                echo "<script language='JavaScript'>
                alert ('Passwords does not match !');
           </script>";

            } else {

                $stmt = $con->prepare("INSERT INTO students (department_id, major_id, fname, lname, email, password) VALUES (?, ?, ?, ?, ?, ?) ");

                $stmt->bind_param("iissss", $department_id, $major_id, $fn, $ln, $email, $pass);
                $stmt->execute();
                 echo '<script language="JavaScript">
              document.location="./login.php";
              </script>';

                    

                } 
            }
        }
    
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UniKey - Sign Up</title>
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

<body>
    <header class="new-header">
        <div class="header-container">
            <div class="logo-container">
                <a href="Student_Dashboard/landing.php" class="logo-link">
                    <img src="../imgs/logos/Unikey(large).jpg" alt="UniKey Logo" class="logo">
                    <span class="brand-name">UniKey</span>
                </a>
            </div>
            <div class="page-title">
                <h1>Create Your Account</h1>
                <div class="title-underline"></div>
            </div>
        </div>
    </header>

    <div class="main-content">
        <div class="sign">
            <h2 class="form-title">Get Started</h2>
            <form action="/signup.php" method="post">
                <div class="form-group">
                    <label for="fn">First Name</label>
                    <div class="input-wrapper">
                    <input type="text" id="fn" placeholder="Enter your first name" name="fn" required>
                        <i class="fa-solid fa-user input-icon"></i>
                    </div>
                </div>
                <div class="form-group">
                    <label for="ln">Last Name</label>
                    <div class="input-wrapper">
                    <input type="text" id="ln" placeholder="Enter your last name" name="ln" required>
                        <i class="fa-solid fa-user input-icon"></i>
                    </div>
                </div>
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
                    <label for="pass">Password</label>
                    <div class="input-wrapper">
                    <input type="password" id="pass" placeholder="Create a password" name="pass" required>
                        <i class="fa-solid fa-lock input-icon"></i>
                        <i class="fa-solid fa-eye password-toggle" id="togglePassword1"></i>
                    </div>
                </div>
                <div class="form-group">
                    <label for="confirm-pass">Confirm Password</label>
                    <div class="input-wrapper">
                    <input type="password" id="confirm-pass" placeholder="Confirm your password" name="confirm_pass"
                    required>
                        <i class="fa-solid fa-lock input-icon"></i>
                        <i class="fa-solid fa-eye password-toggle" id="togglePassword2"></i>
                    </div>
                </div>
                 <!-- <div class="form-group">
                    <label for="confirm-pass">Confirm Password</label>
                    <div class="input-wrapper">
                    <input type="text" id="id" placeholder="StudentID" name="confirm_pass"
                    required>
                        <i class="fa-solid fa-lock input-icon"></i>
                        <i class="fa-solid fa-eye password-toggle" id="togglePassword2"></i>
                    </div>
                </div> -->
                <div class="form-group">
                    <label for="department_id">Faculty</label>
                    <div class="input-wrapper">
                    <select id="department_id" name="department_id" required>
                            <option value="" disabled selected>Select your faculty</option>
                            <?php
                                $sql1 = mysqli_query($con, "SELECT * from departments ORDER BY id DESC");

                                while ($row1 = mysqli_fetch_array($sql1)) {

                                    $dep_id   = $row1['id'];
                                    $dep_name = $row1['name'];

                                ?>

                            <option value="<?php echo $dep_id ?>"><?php echo $dep_name ?></option>

                            <?php }?>
                        </select>
                        <i class="fa-solid fa-graduation-cap input-icon"></i>
                    </div>
                </div>

                <div class="form-group">
                    <label for="major_id">Major</label>
                     
                    <div class="input-wrapper">
                        <select id="major_id" name="major_id" required>
                            <option value="" disabled selected>Select your Major</option>
                        </select>
                        <i class="fa-solid fa-graduation-cap input-icon"></i>
                    </div>
                </div>



                <script>
                    document.getElementById('department_id').addEventListener('change', function() {

                        fetch(`./Get_Majors.php?department_id=${this.value}`)
                        .then(res => res.json())
                        .then(data => {

                            let majorsSelect = document.getElementById('major_id');
                            majorsSelect.innerHTML = '';

                            let defaultOption = document.createElement('option');
                            defaultOption.value = '';
                            defaultOption.textContent = 'Select Major';
                            majorsSelect.appendChild(defaultOption);

                            data.forEach(item => {
                                let option = document.createElement('option');
                                option.value = item.id;
                                option.textContent = item.name;
                                majorsSelect.appendChild(option);
                            });

                        })

                    })
                  </script>


                <div class="remember-me">
                    <input type="checkbox" id="terms" class="ch" required>
                    <label for="terms">I agree to the <a href="#" style="color: var(--olive);">Terms of Service</a> and
                        <a href="#" style="color: var(--olive);">Privacy Policy</a></label>
                </div>
                <button type="submit" name="Submit" class="sub">Sign up</button>
            </form>
            <div class="links">
                <p>Already have an account? <a href="../login.php">Log in</a></p>
            </div>
        </div>
    </div>
     <footer class="login-footer">
        <p>Having trouble signing up?</p>
        <p>Please contact us at <a href="mailto:support@unikey.edu">unihelpergp1@gmail.com</a></p>
        <p>&copy; 2025 UniKey. All rights reserved.</p>
    </footer>

    <script>
       // WARNING
        // const form = document.querySelector('form');
        // form.addEventListener('submit', goToPage);

        // function goToPage(event) {
        //     event.preventDefault(); // stop form from submitting
        // window.location.href = "Student_Dashboard";
        // }
        const togglePassword1 = document.querySelector('#togglePassword1');
        const password1 = document.querySelector('#pass');
        const togglePassword2 = document.querySelector('#togglePassword2');
        const password2 = document.querySelector('#confirm-pass');

        togglePassword1.addEventListener('click', function () {
        const type = password1.getAttribute('type') === 'password' ? 'text' : 'password';
        password1.setAttribute('type', type);
        this.classList.toggle('fa-eye-slash');
        });

        togglePassword2.addEventListener('click', function () {
        const type = password2.getAttribute('type') === 'password' ? 'text' : 'password';
        password2.setAttribute('type', type);
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