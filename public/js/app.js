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

    

    
});

