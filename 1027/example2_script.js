// example2_script.js
// 驗證 Email 與手機欄位，拋出自訂訊息後再提示使用者

const form = document.getElementById('contact-form');
const email = document.getElementById('email');
const phone = document.getElementById('phone');
const allowedDomains = ['@o365.tku.edu.tw'];

function isSchoolEmail(value) {
  const v = String(value || '').trim();
  // 忽略大小寫比對結尾網域
  return allowedDomains.some(suffix =>
    new RegExp(suffix.replace('.', '\\.') + '$', 'i').test(v)
  );
}

function showValidity(input) {
  if (input.validity.valueMissing) {
    input.setCustomValidity('這個欄位必填');
  } else if (input.validity.typeMismatch) {
    input.setCustomValidity('格式不正確，請確認輸入內容');
  } else if (input.validity.patternMismatch) {
    input.setCustomValidity(input.title || '格式不正確');
  } else {
    input.setCustomValidity('');
  } 

  if (input === email) {
    const v = input.value;
    if (v && !isSchoolEmail(v)) {
      input.setCustomValidity('請使用學校信箱（@o365.tku.edu.tw）');
    }
  }
  return input.reportValidity();
}



form.addEventListener('submit', (event) => {
  event.preventDefault();
  const emailOk = showValidity(email);
  const phoneOk = showValidity(phone);
  if (emailOk && phoneOk) {
    alert('表單驗證成功，準備送出資料');
    form.reset();
  }
});

email.addEventListener('blur', () => {
  showValidity(email);
});

phone.addEventListener('blur', () => {
  showValidity(phone);
});

email.addEventListener('input', () => showValidity(email));
phone.addEventListener('input', () => showValidity(phone));