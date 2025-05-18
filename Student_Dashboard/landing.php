<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UniKey</title>
    <!-- favicon -->
    <link rel="icon" type="image/png" href="favicon/favicon-96x96.png" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="favicon/favicon.svg" />
    <link rel="shortcut icon" href="favicon/favicon.ico" />
    <link rel="apple-touch-icon" sizes="180x180" href="favicon/apple-touch-icon.png" />
    <link rel="manifest" href="favicon/site.webmanifest" />
    <!-- css -->
    <link rel="stylesheet" href="../css/all.min.css">
    <link rel="stylesheet" href="../css/framework.css">
    <link rel="stylesheet" href="../css/landing.css">
    <!-- google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
</head>

<body>
    <!-- Language Switcher -->
    <div class="language-switcher">
        <button class="language-btn" id="languageBtn">
            <span>English</span>
            <i class="fa-solid fa-chevron-down"></i>
        </button>
        <div class="language-dropdown" id="languageDropdown">
            <div class="language-option" data-lang="en">
                <span>English</span>
            </div>
                        <div class="language-option" data-lang="ar">
                <span>العربية</span>
            </div>
            <div class="language-option" data-lang="es">
                <span>中文 </span>
            </div>
            <div class="language-option" data-lang="fr">
                <span>Français</span>
            </div>
        </div>
    </div>

    <!-- Hero Section -->
    <section class="hero">
        <video autoplay muted loop playsinline class="background-video">
            <source src="../imgs/UJ_home.mp4" type="video/mp4" />
            Your browser does not support the video tag.
        </video>

        <h1>Your Campus, Connected</h1>
        <p>UniKey is the all-in-one platform that simplifies navigation, improves communication, and provides seamless
            access to
            essential university resources.
        </p>
        <div class="cta-buttons">
            <a href="../login.php" class="btn btn-primary">Login</a>
            <a href="../signup.php" class="btn btn-secondary">Sign Up</a>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features">
        <div class="section-title">
            <h2>Everything You Need for Campus Life</h2>
            <p>UniKey brings together all essential university services into one intuitive platform, saving you time and
                keeping you connected.</p>
        </div>

        <div class="features-grid">
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fa-solid fa-map-location-dot"></i>
                </div>
                <h3>Campus Navigation</h3>
                <p>Interactive maps with directions to classrooms, offices, and facilities across campus.</p>
            </div>

            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </div>
                <h3>Lost & Found</h3>
                <p>Report lost items or help reunite others with their belongings through our secure platform.</p>
            </div>

            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fa-solid fa-calendar-check"></i>
                </div>
                <h3>Event Management</h3>
                <p>Discover, organize, and manage campus events with integrated RSVP.</p>
            </div>

            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fa-solid fa-bullhorn"></i>
                </div>
                <h3>Announcements</h3>
                <p>Stay updated with official university communications and important campus news.</p>
            </div>

            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fa-solid fa-graduation-cap"></i>
                </div>
                <h3>Academic Portals</h3>
                <p>Quick access to all your academic resources and university services in one place.</p>
            </div>

            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fa-solid fa-shuffle"></i>
                </div>
                <h3>BookTrade</h3>
                <p>Exchange textbooks, notes and more with fellow students.</p>
            </div>
        </div>
    </section>

    <footer>
        <p>&copy; 2025 UniKey. All rights reserved.</p>
    </footer>

    <script>
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

                // Here you would typically implement language change logic
                console.log('Language changed to:', selectedLang);
                // You would need to implement actual language switching functionality
                // This might involve reloading the page with a language parameter
                // or using a frontend i18n library
            });
        });
    </script>
</body>

</html>