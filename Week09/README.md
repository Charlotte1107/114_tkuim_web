Week09 Signup Demo

本專案示範一個前後端分離的報名系統，包含表單送出、欄位驗證、錯誤處理、報名清單查詢，以及多種 API 測試方式。
後端使用 Express，前端使用原生 JavaScript（fetch）進行 API 呼叫。

一、環境需求

Node.js LTS（建議 18 或 20）

npm

建議使用 VS Code Live Server（或 Vite）啟動前端

二、後端啟動方式
1. 安裝套件
cd server
npm install

2. 建立 .env 檔案

於 server/.env 建立：

PORT=3001
ALLOWED_ORIGIN=http://127.0.0.1:5500,http://localhost:5500

3. 啟動伺服器
npm run dev


成功後終端機會顯示：

Server ready on http://localhost:3001

三、前端啟動方式

前端檔案位於 client/ 資料夾。

方法 A：使用 VS Code Live Server（推薦）

右鍵點選 signup_form.html

選擇「Open with Live Server」

通常會在：

http://127.0.0.1:5500/client/signup_form.html


即可開始測試。

方法 B：使用 Vite（可選）

建立或使用現有 Vite 專案

將 signup_form.html 放入 public 或根目錄

啟動：

npm install
npm run dev

四、API 端點文件
1. POST /api/signup

建立一筆報名資料。

Request Body（JSON）
{
  "name": "小明",
  "email": "test@example.com",
  "phone": "0912345678",
  "password": "abc12345",
  "confirmPassword": "abc12345",
  "interests": ["前端"],
  "terms": true
}

驗證規則
欄位	規則
name	必填
email	必填
phone	必須為 09 開頭 10 碼
password	至少 8 碼
confirmPassword	必須與 password 相同
interests	至少 1 個項目
terms	必須為 true
成功回應（201 Created）
{
  "message": "報名成功",
  "participant": {
    "id": "abc123ef",
    "name": "小明",
    "email": "test@example.com",
    "phone": "0912345678",
    "interests": ["前端"],
    "createdAt": "2025-11-21T07:37:35.381Z"
  }
}

2. GET /api/signup

取得所有報名資料。

{
  "total": 1,
  "data": [...]
}

3. GET /api/signup/:id（加分挑戰項目）

依照 ID 查詢單一參與者資料。

範例
GET http://localhost:3001/api/signup/Ab12cdE9


若存在，回傳該使用者；若不存在，回傳 404。

此為加分挑戰之一（+5）。

五、API 測試方式

本專案提供三種測試方法。

方法 A：Postman
建立報名（POST）
POST http://localhost:3001/api/signup


Body → raw → JSON

{
  "name": "測試同學",
  "email": "test@example.com",
  "phone": "0912345678",
  "password": "abc12345",
  "confirmPassword": "abc12345",
  "interests": ["全端"],
  "terms": true
}

查看報名清單（GET）
GET http://localhost:3001/api/signup

方法 B：PowerShell（等同 curl）
Invoke-WebRequest -Uri "http://localhost:3001/api/signup" `
-Method POST `
-ContentType "application/json" `
-Body '{"name":"CLI","email":"cli@example.com","phone":"0911222333","password":"cliPass88","confirmPassword":"cliPass88","interests":["資料庫"],"terms":true}'

方法 C：VS Code REST Client（tests/api.http）
### 建立報名
POST http://localhost:3001/api/signup
Content-Type: application/json

{
  "name": "REST Client",
  "email": "rest@example.com",
  "phone": "0988776666",
  "password": "restrest",
  "confirmPassword": "restrest",
  "interests": ["全端"],
  "terms": true
}

### 查看清單
GET http://localhost:3001/api/signup

六、前端功能說明

前端頁面包含：

送出報名表單 → 呼叫 POST /api/signup

結果以 <pre id="result"> 顯示

送出期間會自動 disable 按鈕，避免重複送出

按鈕完成後恢復可點擊

「查看報名清單」按鈕會呼叫 GET /api/signup 並顯示結果

七、錯誤處理
404 Not Found
{ "error": "Not Found" }

500 Server Error
{ "error": "Server Error" }

八、加分挑戰（已完成）

以下為本專案已實作的兩項加分挑戰：

1. GET /api/signup/:id

新增可依 ID 查詢單一參與者的 API。
若找不到 ID，會回傳 404。
此功能補強查詢能力，並滿足作業加分項目。

2. 前端自動重送機制

前端在送出表單後，若第一次請求失敗（例如 server error）：

會顯示提示訊息「伺服器錯誤，3 秒後重新送出」

等待 3 秒

自動重送一次相同請求

若第二次成功 → 顯示成功結果

若第二次仍失敗 → 顯示失敗訊息

此機制用於模擬真實環境中後端不穩定時的重送行為。

測試方式可使用：

將 fetch URL 暫時改錯

或於後端加上特例觸發錯誤