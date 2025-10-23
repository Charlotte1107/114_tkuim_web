function runTempConverter() {
  const vRaw = prompt('請輸入溫度數值：');
  if (vRaw === null) return; // 取消
  const n = Number(vRaw.trim());
  if (!Number.isFinite(n)) {
    alert('數值格式錯誤');
    return;
  }

  const uRaw = prompt('請輸入單位（C 或 F）：');
  if (uRaw === null) return;
  const unit = uRaw.trim().toUpperCase();

  let out = '';
  if (unit === 'C') {
    const f = n * 9 / 5 + 32;              // F = C * 9/5 + 32
    out = `輸入：${n} °C\n換算：${f.toFixed(2)} °F`;
    alert(out);
    document.getElementById('result').textContent = out;
  } else if (unit === 'F') {
    const c = (n - 32) * 5 / 9;            // C = (F - 32) * 5/9
    out = `輸入：${n} °F\n換算：${c.toFixed(2)} °C`;
    alert(out);
    document.getElementById('result').textContent = out;
  } else {
    alert('單位只接受 C 或 F');
  }
}
