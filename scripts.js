
document.addEventListener('DOMContentLoaded', function() {
    // Highlight input fields when focused
    const inputs = document.querySelectorAll('input, select, textarea');
    inputs.forEach(input => {
        input.addEventListener('focus', function() {
            this.style.borderColor = '#2E8B57';
        });
        input.addEventListener('blur', function() {
            this.style.borderColor = '#ccc';
        });
    });

    // Form validation
    const forms = document.querySelectorAll('form');
    forms.forEach(form => {
        form.addEventListener('submit', function(e) {
            const email = form.querySelector('input[name="email"]');
            const password = form.querySelector('input[name="mot_de_passe"]');
            
            if (email && !validateEmail(email.value)) {
                alert('Veuillez entrer un email valide.');
                e.preventDefault();
            }
            if (password && password.value.length < 6) {
                alert('Le mot de passe doit comporter au moins 6 caractères.');
                e.preventDefault();
            }
        });
    });

    // Function to validate email format
    function validateEmail(email) {
        const re = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
        return re.test(email);
    }
});
