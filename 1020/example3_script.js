// example3_script.js
// 使用 prompt 取得輸入，並做基本運算

var name = prompt('請輸入你的名字：');
if (!name) {
  name = '同學';
}

var a = prompt('請輸入數字 A：');
var b = prompt('請輸入數字 B：');

var numA = parseFloat(a);
var numB = parseFloat(b);

var output = '';
output += '哈囉，' + name + '！\n\n';
output += 'A = ' + numA + ', B = ' + numB + '\n';
output += 'A + B = ' + (numA + numB) + '\n';
output += 'A - B = ' + (numA - numB) + '\n';
output += 'A * B = ' + (numA * numB) + '\n';
output += 'A / B = ' + (numA / numB) + '\n';
output += 'A > B ? ' + (numA > numB) + '\n';
output += 'A == B ? ' + (numA == numB) + '（僅比較值）\n';
output += 'A === B ? ' + (numA === numB) + '（比較值與型態）\n';

// 延伸練習:餘數
var explain='用整數除法找出「商 q」與「餘 r」:必須滿足公式：A = B × q + r，且 0 ≤ r < |B|（若 B > 0）\n';
output += 'A % B = ' + (numB !== 0 ? (numA % numB) : '除數不可為 0') + '\n';

alert('計算完成，請看頁面結果與 Console');
console.log(explain+'\n'+output);
document.getElementById('result').textContent =explain+'\n'+ output;
