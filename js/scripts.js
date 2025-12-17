// Example: Form validation for login
document.getElementById('loginForm')?.addEventListener('submit', function(e) {
    const password = document.getElementById('password').value;
    if (password.length < 6) {
        alert('Password must be at least 6 characters.');
        e.preventDefault();
    }
});