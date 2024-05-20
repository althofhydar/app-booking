document.querySelector('form').addEventListener('submit', function(e) {
    var username = document.getElementById('username').value;
    var password = document.getElementById('password').value;
    if (username === '' || password === '') {
        e.preventDefault();
        alert('Please fill in both fields');
    }
});
