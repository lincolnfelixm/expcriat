function login() {
  const form = document.getElementById('login-form');
  const formData = new FormData(form);

  const hashedPassword = CryptoJS.SHA256(formData.get('password')).toString();
  formData.set('password', hashedPassword);

  fetch('../php/login.php', {
    method: 'POST',
    body: formData
  })
    .then(response => {
      if (response.ok) {
        alert('Login successful!');
        window.location.href = 'main.html';
      } else {
        alert("Login failed. Try again.")
      }
    });
}
