
const form = document.getElementById('signup-form');
const submitBtn = document.getElementById('submit-btn');
const resetBtn = document.getElementById('reset-btn');
const statusBox = document.getElementById('form-status');


const fullName = document.getElementById('fullName');
const email = document.getElementById('email');
const phone = document.getElementById('phone');
const password = document.getElementById('password');
const confirmPwd = document.getElementById('confirm');
const tagsBox = document.getElementById('tags');
const tagsCount = document.getElementById('tags-count');
const tos = document.getElementById('tos');

const strengthBar = document.getElementById('password-strength-bar');
const strengthText = document.getElementById('password-strength-text');

const touched = new Set();


function setError(input, message, errorId) {
  input.setCustomValidity(message || '');
  const p = document.getElementById(errorId);
  if (p) p.textContent = message || '';
}

function clearError(input, errorId) {
  setError(input, '', errorId);
}

function validateName() {
  const v = fullName.value.trim();
  if (!v) {
    setError(fullName, '請輸入姓名。', 'fullName-error');
    return false;
  }
  clearError(fullName, 'fullName-error');
  return true;
}

function validateEmail() {
  let v = email.value || "";

  v = v.trim().replace(/\u3000/g, "");  
  email.value = v;

  if (!v) {
    setError(email, '請輸入 Email。', 'email-error');
    return false;
  }

  const basic = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(v);

  if (!basic /* || !email.checkValidity() */) {
    setError(email, 'Email 格式不正確。', 'email-error');
    return false;
  }

  clearError(email, 'email-error');
  return true;
}


function validatePhone() {
  const v = phone.value.trim();
  if (!v) {
    setError(phone, '請輸入手機號碼。', 'phone-error');
    return false;
  }
  if (!/^\d{10}$/.test(v)) {
    setError(phone, '手機需為 10 碼數字（不含符號）。', 'phone-error');
    return false;
  }
  clearError(phone, 'phone-error');
  return true;
}

function validatePassword() {
  const v = password.value;
  if (!v) {
    setError(password, '請輸入密碼。', 'password-error');
    updateStrength(v);
    return false;
  }
  const hasLetter = /[A-Za-z]/.test(v);
  const hasNumber = /\d/.test(v);
  if (v.length < 8 || !hasLetter || !hasNumber) {
    setError(password, '密碼需至少 8 碼，且包含英文與數字。', 'password-error');
    updateStrength(v);
    return false;
  }
  clearError(password, 'password-error');
  updateStrength(v);
  return true;
}

function validateConfirm() {
  const v = confirmPwd.value;
  if (!v) {
    setError(confirmPwd, '請再次輸入密碼。', 'confirm-error');
    return false;
  }
  if (v !== password.value) {
    setError(confirmPwd, '兩次密碼不一致。', 'confirm-error');
    return false;
  }
  clearError(confirmPwd, 'confirm-error');
  return true;
}

function validateTags() {
  const anyChecked = [...tagsBox.querySelectorAll('input[type="checkbox"]')].some(c => c.checked);
  if (!anyChecked) {
    const err = document.getElementById('tags-error');
    err.textContent = '請至少選擇 1 個興趣標籤。';
    return false;
  }
  document.getElementById('tags-error').textContent = '';
  return true;
}

function validateTOS() {
  if (!tos.checked) {
    setError(tos, '請勾選同意服務條款。', 'tos-error');
    return false;
  }
  clearError(tos, 'tos-error');
  return true;
}


function updateStrength(v) {
  let score = 0;
  if (v.length >= 8) score += 1;
  if (/[A-Za-z]/.test(v) && /\d/.test(v)) score += 1;
  if (/[^A-Za-z0-9]/.test(v) || v.length >= 12) score += 1; 

  const percent = [0, 34, 67, 100][score];
  strengthBar.style.width = percent + '%';
  strengthBar.setAttribute('aria-valuenow', String(percent));

  const words = ['—', '弱', '中', '強'];
  strengthText.textContent = '強度：' + words[score];

  strengthBar.classList.remove('weak', 'medium', 'strong');
  if (score === 1) strengthBar.classList.add('weak');
  if (score === 2) strengthBar.classList.add('medium');
  if (score === 3) strengthBar.classList.add('strong');
}


function attachFieldValidation() {
  const map = [
    [fullName, validateName, 'fullName-error'],
    [email, validateEmail, 'email-error'],
    [phone, validatePhone, 'phone-error'],
    [password, validatePassword, 'password-error'],
    [confirmPwd, validateConfirm, 'confirm-error'],
    [tos, validateTOS, 'tos-error']
  ];

  map.forEach(([el, validate, errId]) => {
    el.addEventListener('blur', () => {
      touched.add(el.id);
      validate();
    });

    el.addEventListener('input', () => {
      if (touched.has(el.id)) validate();
      
      if (el === password && touched.has('confirm')) validateConfirm();
      saveDraft();
    });
  });
}


function attachTagsDelegation() {
  tagsBox.addEventListener('click', (e) => {
    const target = e.target;
    if (target && target.matches('input[type="checkbox"]')) {
    
      const label = target.closest('label.tag');
      if (label) label.classList.toggle('active', target.checked);

      const count = tagsBox.querySelectorAll('input[type="checkbox"]:checked').length;
      tagsCount.textContent = `已選 ${count} 項`;

      if (touched.has('tags')) validateTags();
      saveDraft();
    }
  });

  tagsBox.addEventListener('focusout', () => {
    touched.add('tags');
    validateTags();
  });
}


form.addEventListener('submit', (e) => {
  e.preventDefault();


  const ok = [
    validateName(),
    validateEmail(),
    validatePhone(),
    validatePassword(),
    validateConfirm(),
    validateTags(),
    validateTOS()
  ];

  if (ok.every(Boolean) && form.checkValidity()) {
 
    submitBtn.disabled = true;
    submitBtn.classList.add('loading');
    statusBox.classList.remove('visually-hidden');
    statusBox.textContent = '送出中，請稍候…';

    setTimeout(() => {
      submitBtn.disabled = false;
      submitBtn.classList.remove('loading');
      statusBox.textContent = '送出成功！';

      clearDraft();
      form.reset();
      resetUI();
    }, 1000);
  } else {
   
    const firstInvalid = [fullName, email, phone, password, confirmPwd, tos]
      .find(el => !el.checkValidity());

    if (!validateTags()) touched.add('tags');

    if (firstInvalid) {
      firstInvalid.focus();
    } else if (!validateTags()) {
      
      // tagsBox.setAttribute('tabindex', '0');
      // tagsBox.focus();
    }
  }
});


resetBtn.addEventListener('click', () => {
  form.reset();
  clearDraft();
  resetUI();
  statusBox.textContent = '';
});

function resetUI() {

  [
    ['fullName-error'],
    ['email-error'],
    ['phone-error'],
    ['password-error'],
    ['confirm-error'],
    ['tags-error'],
    ['tos-error']
  ].forEach(([id]) => {
    const p = document.getElementById(id);
    if (p) p.textContent = '';
  });

  updateStrength('');

  tagsBox.querySelectorAll('label.tag').forEach(l => l.classList.remove('active'));
  tagsCount.textContent = '已選 0 項';

  touched.clear();
}


const STORAGE_KEY = 'Week07_Lab_signup_draft_v1';

function saveDraft() {
  try {
    const data = {
      fullName: fullName.value.trim(),
      email: email.value.trim(),
      phone: phone.value.trim(),
      tags: [...tagsBox.querySelectorAll('input[type="checkbox"]')].filter(c => c.checked).map(c => c.value),
      tos: tos.checked
    };
    localStorage.setItem(STORAGE_KEY, JSON.stringify(data));
  } catch (_) {}
}

function loadDraft() {
  try {
    const raw = localStorage.getItem(STORAGE_KEY);
    if (!raw) return;
    const data = JSON.parse(raw);
    if (data.fullName) fullName.value = data.fullName;
    if (data.email) email.value = data.email;
    if (data.phone) phone.value = data.phone;
    if (Array.isArray(data.tags)) {
      data.tags.forEach(v => {
        const cb = tagsBox.querySelector(`input[type="checkbox"][value="${CSS.escape(v)}"]`);
        if (cb) {
          cb.checked = true;
          cb.closest('label.tag')?.classList.add('active');
        }
      });
    }
    if (data.tos) tos.checked = true;

    const count = tagsBox.querySelectorAll('input[type="checkbox"]:checked').length;
    tagsCount.textContent = `已選 ${count} 項`;
  } catch (_) {}
}

attachFieldValidation();
attachTagsDelegation();
loadDraft();
updateStrength('');
