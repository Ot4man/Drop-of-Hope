document.addEventListener('DOMContentLoaded', () => {
    // ELIGIBILITY CHECK LOGIC
    const eligibilityForm = document.getElementById('eligibility-form');
    if (eligibilityForm) {
        eligibilityForm.addEventListener('submit', (e) => {
            e.preventDefault();
            const age = parseInt(document.getElementById('age').value);
            const weight = parseInt(document.getElementById('weight').value);
            const health = document.getElementById('health').value;
            const surgery = document.getElementById('surgery').value;

            let isEligible = true;
            let errors = [];

            if (age < 17 || age > 65) {
                isEligible = false;
                errors.push("Age must be between 17 and 65.");
            }
            if (weight < 50) {
                isEligible = false;
                errors.push("Weight must be at least 50kg.");
            }
            if (health === "yes") {
                isEligible = false;
                errors.push("Major health conditions are a deferral factor.");
            }
            if (surgery === "yes") {
                isEligible = false;
                errors.push("Recent surgery requires a waiting period.");
            }

            if (isEligible) {
                // Success! Redirect to register
                window.location.href = "/register";
            } else {
                alert("Eligibility Status:\n\n" + errors.join("\n"));
            }
        });
    }

    // PASSWORD STRENGTH INDICATOR
    const passwordInput = document.getElementById('password');
    const strengthBar = document.getElementById('strength-bar');

    if (passwordInput && strengthBar) {
        passwordInput.addEventListener('input', () => {
            const val = passwordInput.value;
            let strength = 0;
            if (val.length >= 8) strength++;
            if (/[A-Z]/.test(val)) strength++;
            if (/[0-9]/.test(val)) strength++;
            if (/[^A-Za-z0-9]/.test(val)) strength++;

            strengthBar.className = "password-strength-bar";
            if (val.length === 0) {
                strengthBar.style.width = "0%";
            } else if (strength < 2) {
                strengthBar.classList.add('strength-weak');
            } else if (strength < 4) {
                strengthBar.classList.add('strength-medium');
            } else {
                strengthBar.classList.add('strength-strong');
            }
        });
    }

    // REGISTRATION FORM VALIDATION 
    const registerForm = document.getElementById('register-form');
    if (registerForm) {
        registerForm.addEventListener('submit', (e) => {
            const pass = document.getElementById('password').value;
            const confirm = document.getElementById('repeat-password').value;

            if (pass !== confirm) {
                e.preventDefault();
                alert("Passwords do not match!");
            }
        });
    }
});

