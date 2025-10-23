// example5_script.js
// 以巢狀 for 產生 1~9 的乘法表

var output = '';
for (var i = 1; i <= 9; i++) {
  for (var j = 1; j <= 9; j++) {
    output += i + 'x' + j + '=' + (i * j) + '\t';
  }
  output += '\n';
}
// 延伸練習
var raw = prompt("請輸入要顯示的乘法範圍:（例如 2 到 5）");
var m = raw && raw.trim().match(/^(\d+)\s*到\s*(\d+)$/);

var finalOutput = "完整 1～9：\n" + output; // 先放入原本的完整九九

if (!m) {
  finalOutput += "\n（格式錯誤，請用「2 到 5」）";
} else {
  var start = parseInt(m[1], 10);
  var end   = parseInt(m[2], 10);

  if (start > end) { var t = start; start = end; end = t; }
  start = Math.max(1, Math.min(9, start));
  end   = Math.max(1, Math.min(9, end));

  var rangeOutput = '';
  for (var i = start; i <= end; i++) {
    for (var j = 1; j <= 9; j++) {
      rangeOutput += i + 'x' + j + '=' + (i * j) + '\t';
    }
    rangeOutput += '\n';
  }
  finalOutput += "\n指定範圍：\n" + rangeOutput;
}
document.getElementById('result').textContent = finalOutput;


