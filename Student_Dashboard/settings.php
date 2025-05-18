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

        $name          = $row1['fname'] . ' ' . $row1['lname'];
        $email         = $row1['email'];
        $user_image    = $row1['image'];
        $department_id = $row1['department_id'];
        $major_id      = $row1['major_id'];

        $sql222 = mysqli_query($con, "select * from departments where id='$department_id'");
        $row222 = mysqli_fetch_array($sql222);

        $dep_name = $row222['name'];

        $sql33333 = mysqli_query($con, "select * from majors where id='$major_id'");
        $row3333  = mysqli_fetch_array($sql33333);

        $major_name = $row3333['name'];

        $eventsSql = mysqli_query($con, "select COUNT(id) AS count_events from student_events where student_id='$S_ID'");
        $eventsRow = mysqli_fetch_array($eventsSql);

        $count_events = $eventsRow['count_events'];

        $lostsSql = mysqli_query($con, "select COUNT(id) AS count_losts from lost_founds where student_id='$S_ID'");
        $lostsRow = mysqli_fetch_array($lostsSql);

        $count_losts = $lostsRow['count_losts'];

        $marketPlaceSql = mysqli_query($con, "select COUNT(id) AS count_marketplaces from marketplaces where student_id='$S_ID'");
        $marketPlaceRow = mysqli_fetch_array($marketPlaceSql);

        $count_marketplaces = $marketPlaceRow['count_marketplaces'];

    }

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>UniKey - Settings</title>
  <!-- favicon -->
  <link rel="icon" type="image/png" href="favicon/favicon-96x96.png" sizes="96x96" />
  <link rel="icon" type="image/svg+xml" href="favicon/favicon.svg" />
  <link rel="shortcut icon" href="favicon/favicon.ico" />
  <!-- css -->
  <link rel="stylesheet" href="../css/settings.css">
  <link rel="stylesheet" href="../css/framework.css">
  <link rel="stylesheet" href="../css/side.css">
  <link rel="stylesheet" href="../css/all.min.css">

  <!-- fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <style>

  </style>
</head>

<body>
  <div class="page d-flex">
    <!-- Sidebar Navigation -->
    <div class="sidebar bg-white p-20 p-relative">
      <a href="./index.php">
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

      <h1 class="p-relative">Settings</h1>
 
      <div class="settings-container">
        <!-- Account Settings -->
        <div class="settings-box">
          <h2 class="settings-title"><i class="fa-solid fa-user"></i> Account Settings</h2>
          <p class="settings-description">Manage your profile information</p>

          <div class="form-group">
            <label for="firstName">First Name</label>
            <input type="text" id="firstName" placeholder="First Name"  value="<?php echo $row1['fname'] ?>">
          </div>

          <div class="form-group">
            <label for="lastName">Last Name</label>
            <input type="text" id="lastName" placeholder="Last Name"  value="<?php echo $row1['lname'] ?>">
          </div>

          <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" placeholder="Email" value="<?php echo $row1['email'] ?>" disabled >
          </div>

          <div class="form-group">
            <label for="department_id">Faculty</label>
            <select id="department_id" name="department_id">
            <?php
                $sql3333 = mysqli_query($con, "SELECT * from departments ORDER BY id DESC");

                while ($row33333 = mysqli_fetch_array($sql3333)) {

                    $dep_id   = $row33333['id'];
                    $dep_name = $row33333['name'];

                ?>

                            <option value="<?php echo $dep_id ?>"<?php echo $dep_id == $department_id ? 'selected' : '' ?>><?php echo $dep_name ?></option>

                            <?php }?>
            </select>
          </div>

          <div class="form-group">
            <label for="major_id">Major</label>
            <select id="major_id" name="major_id">
            <?php
                $sql3333 = mysqli_query($con, "SELECT * from majors WHERE department_id = '$department_id' ORDER BY id DESC");

                while ($row33333 = mysqli_fetch_array($sql3333)) {

                    $major_id   = $row33333['id'];
                    $major_name = $row33333['name'];

                ?>

                            <option value="<?php echo $major_id ?>"<?php echo $major_id == $row1['major_id'] ? 'selected' : '' ?>><?php echo $major_name ?></option>

                            <?php }?>
            </select>
          </div>

          <div class="form-group">
            <label for="profile_image">Profile</label>
            <input type="file" id="profile_image">
          </div>

          <script>
                    document.getElementById('department_id').addEventListener('change', function() {

                        fetch(`../Get_Majors.php?department_id=${this.value}`)
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

          <!-- <div class="setting-item">
            <div class="setting-info">
              <span class="setting-label">Profile Picture</span>
              <p class="setting-description">Update your profile photo</p>
            </div>
            <button class="save-changes-btn">Change</button>
          </div> -->

          <div class="setting-item">
            <div class="setting-info">
              <span class="setting-label">Change Password</span>
              <p class="setting-description">Last changed 3 months ago</p>
            </div>
            <button class="save-changes-btn"><a href="change-pass.php" style="color: #f3f4e7;">Change</a></button>
          </div>
        </div>

        <!-- Notification Preferences -->
        <div class="settings-box">
          <h2 class="settings-title"><i class="fa-solid fa-bell"></i> Notification Preferences</h2>
          <p class="settings-description">Choose how you receive notifications</p>

          <div class="setting-item">
            <div class="setting-info">
              <span class="setting-label">Email Notifications</span>
              <p class="setting-description">Receive notifications via email</p>
            </div>
            <label class="toggle-switch">
              <input type="checkbox" id="emailNotifications" checked>
              <span class="slider"></span>
            </label>
          </div>

          <div class="setting-item">
            <div class="setting-info">
              <span class="setting-label">Push Notifications</span>
              <p class="setting-description">Receive notifications on your device</p>
            </div>
            <label class="toggle-switch">
              <input type="checkbox" id="pushNotifications" checked>
              <span class="slider"></span>
            </label>
          </div>

          <div class="setting-item notification-type" id="announcementNotifications">
            <div class="setting-info">
              <span class="setting-label">Announcements</span>
              <p class="setting-description">University announcements</p>
            </div>
            <label class="toggle-switch">
              <input type="checkbox" checked>
              <span class="slider"></span>
            </label>
          </div>

          <div class="setting-item notification-type" id="eventNotifications">
            <div class="setting-info">
              <span class="setting-label">Events</span>
              <p class="setting-description">Upcoming university events</p>
            </div>
            <label class="toggle-switch">
              <input type="checkbox" checked>
              <span class="slider"></span>
            </label>
          </div>

          <div class="setting-item notification-type" id="marketplaceNotifications">
            <div class="setting-info">
              <span class="setting-label">Marketplace</span>
              <p class="setting-description">New items in marketplace</p>
            </div>
            <label class="toggle-switch">
              <input type="checkbox">
              <span class="slider"></span>
            </label>
          </div>

          <div class="setting-item notification-type" id="lostFoundNotifications">
            <div class="setting-info">
              <span class="setting-label">Lost/Found</span>
              <p class="setting-description">Updates on lost and found items</p>
            </div>
            <label class="toggle-switch">
              <input type="checkbox" checked>
              <span class="slider"></span>
            </label>
          </div>
        </div>

        <!-- Privacy Settings -->
        <div class="settings-box">
          <h2 class="settings-title"><i class="fa-solid fa-lock"></i> Privacy Settings</h2>
          <p class="settings-description">Manage your account privacy and security</p>

          <div class="setting-item">
            <div class="setting-info">
              <span class="setting-label">Log Out of All Devices</span>
              <p class="setting-description">Sign out from all logged in devices</p>
            </div>
            <a href="./Logout.php" class="save-changes-btn">Log Out</a>
          </div>

          <div class="setting-item">
            <div class="setting-info">
              <span class="setting-label">Deactivate Account</span>
              <p class="setting-description">Temporarily Disable Access</p>
            </div>
            <a href="./Deactivate.php" class="save-changes-btn">Deactivate</a>
          </div>
        </div>

        <!-- Application Customization -->
        <div class="settings-box">
          <h2 class="settings-title"><i class="fa-solid fa-paintbrush"></i> Application Customization</h2>
          <p class="settings-description">Personalize your app experience</p>

          <div class="setting-item">
            <div class="setting-info">
              <span class="setting-label">Theme</span>
              <p class="setting-description">Choose between light and dark mode</p>
            </div>
            <div class="input-wrapper">
            <select id="themePreference" class="custom-select ">
              <option value="light">Light Mode</option>
              <option value="dark">Dark Mode</option>
              <option value="system">System Default</option>
            </select>
            </div>
          </div>

          <div class="setting-item">
            <div class="setting-info">
              <span class="setting-label">Language</span>
              <p class="setting-description">Select your preferred language</p>
            </div>
            <div class="input-wrapper">
              <select id="languagePreference" class="custom-select ">
                <option value="en">English</option>
                <option value="ar">Arabic</option>
                <option value="fr">French</option>
                <option value="es">Spanish</option>
              </select>
              </div>
          </div>
        </div>

      </div>

      <!-- Save Changes Button -->
      <div class="save-changes">
        <button class="save-changes-btn saveData">
          <i class="fas fa-save"></i> Save Changes
        </button>
      </div>
    </div>
  </div>

  <script>
    // Notification logic
    const emailNotifications = document.getElementById('emailNotifications');
    const pushNotifications = document.getElementById('pushNotifications');
    const notificationTypes = document.querySelectorAll('.notification-type');

    function updateNotificationTypes() {
      const anyEnabled = emailNotifications.checked || pushNotifications.checked;

      notificationTypes.forEach(type => {
        if (anyEnabled) {
          type.classList.remove('disabled-setting');
          type.querySelector('input').disabled = false;
        } else {
          type.classList.add('disabled-setting');
          type.querySelector('input').disabled = true;
          type.querySelector('input').checked = false;
        }
      });
    }

    emailNotifications.addEventListener('change', updateNotificationTypes);
    pushNotifications.addEventListener('change', updateNotificationTypes);

    // Initialize on page load
    updateNotificationTypes();

    // Save changes button functionality
    document.querySelector('.saveData').addEventListener('click', function () {
      // Here you would typically send the form data to your backend


      const form = new FormData();

        form.append('fname', document.getElementById('firstName').value);
        form.append('lname', document.getElementById('lastName').value);
        form.append('email', document.getElementById('email').value);
        form.append('department_id', document.getElementById('department_id').value);
        form.append('major_id', document.getElementById('major_id').value);
        form.append('student_id', <?php echo json_encode($S_ID) ?>);

        const imageFile = document.getElementById('profile_image').files[0] ?? null;
            if (imageFile) {
              form.append('image', imageFile);
            }

       fetch('./UpdateAccount.php', {
        method: 'POST',
        body: form
      })
      .then(res => res.json())
      .then(res => {

        if(!res.error) {

          alert('Your settings have been saved successfully!');
          window.location.reload();
          return;
        }

        alert('Something went wrong');
        return;
      })

    });
  </script>
</body>

</html>