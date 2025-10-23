function startGame() {
  const ans = Math.floor(Math.random() * 100) + 1; // 1..100
  let tries = 0;            // 有效猜測次數（只計算 1~100 的數字）
  let history = [];         // 記錄每次輸入與提示

  while (true) {
    const raw = prompt('請輸入 1–100（取消結束）：');
    if (raw === null) { // 使用者取消
      history.push('（已取消）');
      break;
    }

    const n = Number(raw.trim());
    if (!Number.isInteger(n) || n < 1 || n > 100) {
      alert('請輸入 1–100 的整數');
      continue; // 不計次數
    }

    tries++;
    if (n === ans) {
      const msg = `恭喜答對！答案是 ${ans}，共猜了 ${tries} 次`;
      alert(msg);
      history.push(`猜 ${n} → 正確（共 ${tries} 次）`);
      break;
    } else if (n < ans) {
      alert('再大一點');
      history.push(`猜 ${n} → 再大一點`);
    } else {
      alert('再小一點');
      history.push(`猜 ${n} → 再小一點`);
    }
  }

  document.getElementById('log').textContent =
    `答案：${ans}\n` + history.join('\n');
}
