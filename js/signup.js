async function validateForm() {
  const username = document.getElementById('username').value;
  const email = document.getElementById('email').value;
  const password = document.getElementById('password').value;
  const confirm_password = document.getElementById('confirm-password').value;
  const cpf = document.getElementById('cpf').value;
  const phone = document.getElementById('phone').value;

  const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,24}$/;
  const cpfRegex = /^\d{3}\.\d{3}\.\d{3}-\d{2}$/;
  const phoneRegex = /^\(\d{2}\) \d{4,5}-\d{4}$/;

  if (!username || !email || !password || !confirm_password || !cpf || !phone) {
    alert('Please fill in all fields');
    return false;
  }

  if (password !== confirm_password) {
    alert('Passwords do not match');
    return false;
  }

  if (!passwordRegex.test(password)) {
    alert('Password must contain between 8-24 characters, including at least one uppercase letter, one lowercase letter, and one digit');
    return false;
  }

  if (!cpfRegex.test(cpf)) {
    alert('CPF must be in the format 999.999.999-99');
    return false;
  }

  if (!phoneRegex.test(phone)) {
    alert('Phone number must be in the format (99) 99999-9999 or (99) 9999-9999');
    return false;
  }

  // Fetch the public key from the server
  const publicKeyResponse = await fetch('public_key.pem');
  const publicKey = await publicKeyResponse.text();

  const encrypt = new JSEncrypt();
  encrypt.setPublicKey(publicKey);

  // Encrypt all data
  const encryptedUsername = encrypt.encrypt(username);
  const encryptedEmail = encrypt.encrypt(email);
  const encryptedPassword = encrypt.encrypt(password);
  const encryptedCpf = encrypt.encrypt(cpf);
  const encryptedPhone = encrypt.encrypt(phone);

  const formData = new FormData(document.getElementById('signup-form'));
  formData.set('username', encryptedUsername);
  formData.set('email', encryptedEmail);
  formData.set('password', encryptedPassword);
  formData.set('cpf', encryptedCpf);
  formData.set('phone', encryptedPhone);

  fetch('../php/signup.php', {
    method: 'POST',
    body: formData
  })
    .then(response => {
      if (response.ok) {
        alert('Sign-up successful!');
        window.location.href = 'login.html'; // redirect to login page
      } else {
        alert('Sign-up failed.');
      }
    });

  return true;
}
