async function login() {
  const form = document.getElementById('login-form');
  const formData = new FormData(form);

  const username = formData.get('username');
  const password = formData.get('password');

  // Fetch the public key from the server
  const publicKeyResponse = await fetch('../php/public_key.pem');
  const publicKey = await publicKeyResponse.text();

  const encrypt = new JSEncrypt();
  encrypt.setPublicKey(publicKey);

  // Encrypt all data
  const encryptedUsername = encrypt.encrypt(username);
  const encryptedPassword = encrypt.encrypt(password);

  formData.set('username', encryptedUsername);
  formData.set('password', encryptedPassword);

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
