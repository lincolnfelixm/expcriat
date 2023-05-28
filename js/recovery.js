function sendToken() {
  const email = document.getElementById('email').value;

  const formData = new FormData();
  formData.append('email', email);

  fetch('ask_recover.php', {
    method: 'POST',
    body: formData
  })
    .then(response => {
      if (response.ok) {
        return response;
      } else {
        throw new Error('Request failed');
      }
    })
    .then(response => {
      if (response.status === 200) {
        const emailForm = document.getElementById('email-form');
        const tokenForm = document.getElementById('token-form');
        emailForm.classList.add('hidden');
        tokenForm.classList.remove('hidden');
      }
    });
}

function resetPassword() {
  const email = document.getElementById('email').value;
  const token = document.getElementById('token').value;
  const newPassword = document.getElementById('new-password').value;
  const newPasswordConfirm = document.getElementById('new-password-confirm').value;

  if (newPassword !== newPasswordConfirm) {
    alert('New passwords do not match.');
    return;
  }

  const hashedPassword = CryptoJS.SHA256(newPassword).toString();

  const formData = new FormData();
  formData.append('email', email);
  formData.append('token', token);
  formData.append('newPassword', hashedPassword);

  fetch('recovery.php', {
    method: 'POST',
    body: formData
  })
    .then(response => {
      if (response.ok) {
        return response;
      } else {
        throw new Error('Request failed');
      }
    })
    .then(response => {
      if (response.status === 200) {
        alert('Password reset successfully.');
        window.location.href = './html/login.html'; // Redirect to login page
      } else {
        alert('Failed to reset password.');
      }
    });
}
