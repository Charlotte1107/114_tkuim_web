const form = document.querySelector('#signup-form');
const resultEl = document.querySelector('#result');
const submitBtn = form.querySelector('button[type="submit"]');
const loadBtn = document.querySelector('#load-list'); 


form.addEventListener('submit', async (event) => {
  event.preventDefault();

  submitBtn.disabled = true;
  resultEl.textContent = '送出中...';

  const formData = new FormData(form);
  const payload = Object.fromEntries(formData.entries());
  payload.password = payload.confirmPassword = 'demoPass88';
  payload.interests = ['後端入門'];
  payload.terms = true;

  async function send() {
    const res = await fetch('http://localhost:3001/api/signup', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify(payload)
    });
    if (!res.ok) throw new Error('Server Error');
    return res.json();
  }

  try {
    try {
      const data = await send();
      resultEl.textContent = JSON.stringify(data, null, 2);
    } catch (error) {
      resultEl.textContent = '伺服器錯誤，3 秒後重新送出...';
      await new Promise(r => setTimeout(r, 3000));
      const retryData = await send();
      resultEl.textContent = JSON.stringify(retryData, null, 2);
    }
  } catch (error) {
    resultEl.textContent = `仍然失敗：${error.message}`;
  } finally {
    submitBtn.disabled = false;
  }
});



if (loadBtn) {
  loadBtn.addEventListener('click', async () => {
    resultEl.textContent = '載入中...';

    const res = await fetch('http://localhost:3001/api/signup');
    const data = await res.json();

    resultEl.textContent = JSON.stringify(data, null, 2);
  });
}
