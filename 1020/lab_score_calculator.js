function toNumber(str) {
  var n = parseFloat(str);
  return isNaN(n) ? null : n;
}

function gradeFrom(avg) {
  var g = 'F';
  if (avg >= 90) {
    g = 'A';
  } else if (avg >= 80) {
    g = 'B';
  } else if (avg >= 70) {
    g = 'C';
  } else if (avg >= 60) {
    g = 'D';
  } else {
    g = 'F';
  }
  return g;
}

var name = prompt('請輸入姓名：');
if (!name) name = '同學';

// 五科
var subjects = ['國文', '英文', '數學', '自然', '社會'];
var scores = [];
var invalid = false;

for (var i = 0; i < subjects.length; i++) {
  var s = toNumber(prompt('請輸入 ' + subjects[i] + ' 成績：'));
  if (s === null) {
    invalid = true;
    break;
  }
  scores.push(s);
}

var text = '';
if (invalid) {
  text = '輸入有誤，請重新整理後再試。';
} else {
  // 總和與平均（5 科）
  var sum = 0;
  for (var j = 0; j < scores.length; j++) sum += scores[j];
  var avg = sum / scores.length;

  // 是否有不及格
  var hasFail = false;
  for (var k = 0; k < scores.length; k++) {
    if (scores[k] < 60) { hasFail = true; break; }
  }

  // 組輸出
  text = '姓名：' + name + '\n';
  for (var t = 0; t < subjects.length; t++) {
    text += subjects[t] + '：' + scores[t] + '\n';
  }
  text += '平均：' + avg.toFixed(2) + '\n';
  text += '等第：' + gradeFrom(avg);
  if (hasFail) text += '\n警示：有不及格科目';
}

console.log(text);
document.getElementById('result').textContent = text;