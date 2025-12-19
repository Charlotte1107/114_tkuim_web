const token = localStorage.getItem('token');

if (!token) {
  alert('請先登入');
  location.href = 'index.html';
}

document.getElementById('submitBtn').addEventListener('click', async () => {
  const name = document.getElementById('name').value;
  const email = document.getElementById('email').value;
  const phone = document.getElementById('phone').value;
  const msg = document.getElementById('msg');

  msg.textContent = '';

  try {
    const res = await fetch('http://localhost:3001/api/signup', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        Authorization: `Bearer ${token}` 
      },
      body: JSON.stringify({ name, email, phone })
    });

    if (res.status === 401) {
      localStorage.clear();
      alert('登入過期，請重新登入');
      location.href = 'index.html';
      return;
    }

    const data = await res.json();

    if (!res.ok) {
      msg.textContent = data.error || '送出失敗';
      return;
    }

    alert('建立成功');
    location.href = 'list.html';

  } catch {
    msg.textContent = '伺服器錯誤';
  }
});
