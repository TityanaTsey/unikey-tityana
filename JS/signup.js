document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form');
    const passwordInput = document.getElementById('pass');
    const confirmPasswordInput = document.getElementById('confirm-pass');
    const strengthMeter = document.getElementById('password-strength-meter');
    const strengthMeterFill = document.querySelector('.strength-meter-fill');
    const passwordRules = document.getElementById('password-rules');
    const passwordMatch = document.getElementById('password-match');
    const matchIcon = document.getElementById('match-icon');
    const matchText = document.getElementById('match-text');
    
    // Form submission handler
    form.addEventListener('submit', function(event) {
        event.preventDefault();
        
        const password = passwordInput.value;
        const confirmPassword = confirmPasswordInput.value;
        
        if (!isPasswordStrong(password)) {
            alert('Please create a stronger password that meets all requirements.');
            return;
        }
        
        if (password !== confirmPassword) {
            alert('Passwords do not match!');
            confirmPasswordInput.focus();
            return;
        }
        
        window.location.href = "dashboard.html";
    });
    
    // Show/hide password rules on focus/blur
    passwordInput.addEventListener('focus', function() {
        passwordRules.classList.add('visible');
        strengthMeter.classList.add('visible');
    });
    
    passwordInput.addEventListener('blur', function() {
        if (passwordInput.value === '' || isPasswordStrong(passwordInput.value)) {
            passwordRules.classList.remove('visible');
            strengthMeter.classList.remove('visible');
        }
    });
    
    // Password strength checker
    passwordInput.addEventListener('input', function() {
        const password = passwordInput.value;
        const strength = calculatePasswordStrength(password);
        
        strengthMeterFill.setAttribute('data-strength', strength);
        updateRequirementsChecklist(password);
        
        // Check password match if confirmation field has value
        if (confirmPasswordInput.value) {
            checkPasswordMatch();
        }
    });
    
    // Password confirmation validation
    confirmPasswordInput.addEventListener('input', checkPasswordMatch);
    confirmPasswordInput.addEventListener('focus', function() {
        if (passwordInput.value) {
            passwordMatch.classList.add('visible');
        }
    });
    
    confirmPasswordInput.addEventListener('blur', function() {
        if (passwordInput.value === confirmPasswordInput.value || confirmPasswordInput.value === '') {
            passwordMatch.classList.remove('visible');
        }
    });
    
    function checkPasswordMatch() {
        const password = passwordInput.value;
        const confirmPassword = confirmPasswordInput.value;
        
        if (confirmPassword === '') {
            passwordMatch.classList.remove('visible');
            return;
        }
        
        passwordMatch.classList.add('visible');
        
        if (password === confirmPassword) {
            matchIcon.className = 'fas fa-check-circle valid';
            matchText.textContent = 'Passwords match';
            matchText.className = 'valid';
        } else {
            matchIcon.className = 'fas fa-times-circle invalid';
            matchText.textContent = 'Passwords do not match';
            matchText.className = 'invalid';
        }
    }
    
    // Password toggle functionality
    const togglePassword1 = document.querySelector('#togglePassword1');
    const togglePassword2 = document.querySelector('#togglePassword2');
    
    togglePassword1.addEventListener('click', function() {
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
        this.classList.toggle('fa-eye-slash');
    });
    
    togglePassword2.addEventListener('click', function() {
        const type = confirmPasswordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        confirmPasswordInput.setAttribute('type', type);
        this.classList.toggle('fa-eye-slash');
    });
    
    // Email generation
    function updateEmail() {
        const usernameInput = document.getElementById('username');
        const emailInput = document.getElementById('email');
        const cleanUsername = usernameInput.value.replace(/[@\s]/g, '').toLowerCase();
        usernameInput.value = cleanUsername;
        emailInput.value = cleanUsername + '@ju.edu.jo';
    }
    
    // Password strength calculation
    function calculatePasswordStrength(password) {
        let strength = 0;
        if (password.length >= 8) strength++;
        if (/[A-Z]/.test(password)) strength++;
        if (/[a-z]/.test(password)) strength++;
        if (/[0-9]/.test(password)) strength++;
        if (/[^A-Za-z0-9]/.test(password)) strength++;
        return strength;
    }
    
    // Check if password meets all requirements
    function isPasswordStrong(password) {
        return password.length >= 8 &&
               /[A-Z]/.test(password) &&
               /[a-z]/.test(password) &&
               /[0-9]/.test(password) &&
               /[^A-Za-z0-9]/.test(password);
    }
    
    // Update requirements checklist
    function updateRequirementsChecklist(password) {
        document.getElementById('req-length').classList.toggle('valid', password.length >= 8);
        document.getElementById('req-uppercase').classList.toggle('valid', /[A-Z]/.test(password));
        document.getElementById('req-lowercase').classList.toggle('valid', /[a-z]/.test(password));
        document.getElementById('req-number').classList.toggle('valid', /[0-9]/.test(password));
        document.getElementById('req-special').classList.toggle('valid', /[^A-Za-z0-9]/.test(password));
    }
    
    // Initialize email field
    document.getElementById('username').addEventListener('input', updateEmail);
});