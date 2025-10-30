// example5_script.js
// 顯示錯誤後自動聚焦欄位，並透過 aria-live 提示助讀器

const form = document.getElementById('full-form');
const submitBtn = document.getElementById('submitBtn');
const resetBtn = document.getElementById('resetBtn');

const agreeCheckbox = document.getElementById('agree');
const agreeLabel = document.getElementById('agree-label');
const privacyModalElem = document.getElementById('privacyModal');
const privacyModal = new bootstrap.Modal(privacyModalElem);

const agreeBtnInModal = document.getElementById('agreeBtn');
const disagreeBtnInModal = document.getElementById('disagreeBtn');

function validateAllInputs(formElement) {
  let firstInvalid = null;
  const controls = Array.from(formElement.querySelectorAll('input, select, textarea'));
  controls.forEach((control) => {
    control.classList.remove('is-invalid');
    if (!control.checkValidity()) {
        control.classList.add('is-invalid');
        if (!firstInvalid) {
          firstInvalid = control;
        }
    }
  });
  return firstInvalid;
}

form.addEventListener('submit', async (event) => {
  event.preventDefault();
  submitBtn.disabled = true;
  submitBtn.textContent = '送出中...';

  const firstInvalid = validateAllInputs(form);
  if (firstInvalid) {
    submitBtn.disabled = false;
    submitBtn.textContent = '送出';
    firstInvalid.focus();
    return;
  }

  await new Promise((resolve) => setTimeout(resolve, 1000));
  alert('資料已送出，感謝您的聯絡！');

  form.reset();
  submitBtn.disabled = false;
  submitBtn.textContent = '送出';

  Array.from(form.elements).forEach((el) => {
    el.classList.remove('is-invalid');
  });
});

resetBtn.addEventListener('click', () => {
  form.reset();
  Array.from(form.elements).forEach((element) => {
    element.classList.remove('is-invalid');
  });
});

form.addEventListener('input', (event) => {
  const target = event.target;
  if (target.classList.contains('is-invalid') && target.checkValidity()) {
    target.classList.remove('is-invalid');
  }
});


agreeLabel.addEventListener('mouseenter', () => {
  privacyModal.show();
});


agreeBtnInModal.addEventListener('click', () => {
  agreeCheckbox.checked = true;

  agreeCheckbox.classList.remove('is-invalid');
  privacyModal.hide();
});

disagreeBtnInModal.addEventListener('click', () => {
  agreeCheckbox.checked = false;
  privacyModal.hide();
});

