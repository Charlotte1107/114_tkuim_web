# Week09 Signup

本專案示範一個前後端分離的報名系統，包含：

- 表單資料送出  
- 欄位驗證與錯誤回應  
- 報名清單查詢  
- 多種 API 測試方式  

後端使用 **Express**，前端使用 **原生 JavaScript（fetch）**。

---

## 一、環境需求

- Node.js LTS（建議 18 或 20）
- npm
- 前端建議使用 VS Code Live Server（或 Vite）

---

## 二、後端啟動方式

### 1. 安裝套件

```bash
cd server
npm install
```

### 2. 建立 `.env` 檔案

於 `server/.env` 建立：

```
PORT=3001
ALLOWED_ORIGIN=http://127.0.0.1:5500,http://localhost:5500
```

### 3. 啟動伺服器

```bash
npm run dev
```

成功後終端會顯示：

```
Server ready on http://localhost:3001
```

---

## 三、前端啟動方式

前端檔案位於 `client/` 資料夾。

### 方法 A：Live Server（推薦）

1. 右鍵 `signup_form.html`  
2. 選擇 **Open with Live Server**

網址通常為：

```
http://127.0.0.1:5500/client/signup_form.html
```

### 方法 B：Vite（可選）

```bash
npm install
npm run dev
```

---

## 四、API 文件

---

### 1. POST /api/signup

建立一筆報名資料。

#### Request Body

```json
{
  "name": "小明",
  "email": "test@example.com",
  "phone": "0912345678",
  "password": "abc12345",
  "confirmPassword": "abc12345",
  "interests": ["前端"],
  "terms": true
}
```

#### 驗證規則

| 欄位 | 規則 |
|------|------|
| name | 必填 |
| email | 必填 |
| phone | 09 開頭、10 碼 |
| password | 至少 8 碼 |
| confirmPassword | 與 password 相同 |
| interests | 至少 1 項 |
| terms | 必須為 true |

---

### 2. GET /api/signup

取得所有報名資料。

```json
{
  "total": 1,
  "data": [
    {
      "id": "abc123ef",
      "name": "小明",
      "email": "test@example.com",
      "phone": "0912345678",
      "interests": ["前端"],
      "createdAt": "2025-11-21T07:37:35.381Z"
    }
  ]
}
```

---

### 3. GET /api/signup/:id（加分挑戰 +5）

依照 ID 查詢單一參與者。

範例：

```
GET http://localhost:3001/api/signup/Ab12cdE9
```

若找不到：

```json
{ "error": "找不到此參與者" }
```

---

## 五、API 測試方式

---

### 方法 A：Postman

#### POST

```
POST http://localhost:3001/api/signup
```

Body → raw → JSON：

```json
{
  "name": "測試同學",
  "email": "test@example.com",
  "phone": "0912345678",
  "password": "abc12345",
  "confirmPassword": "abc12345",
  "interests": ["全端"],
  "terms": true
}
```

#### GET

```
GET http://localhost:3001/api/signup
```

---

### 方法 B：PowerShell（等同 curl）

```powershell
Invoke-WebRequest -Uri "http://localhost:3001/api/signup" `
-Method POST `
-ContentType "application/json" `
-Body '{
  "name": "CLI",
  "email": "cli@example.com",
  "phone": "0911222333",
  "password": "cliPass88",
  "confirmPassword": "cliPass88",
  "interests": ["資料庫"],
  "terms": true
}'
```

---

### 方法 C：VS Code REST Client

`tests/api.http` 內容：

```http
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
```

---

## 六、前端功能說明

- 送出表單 → 呼叫 POST /api/signup  
- 送出時按鈕會自動 disabled（避免重複送出）  
- 完成後按鈕恢復正常  
- 回應結果顯示於 `<pre id="result">`  
- 「查看報名清單」按鈕可呼叫 GET /api/signup  

---

## 七、錯誤處理

### 404 Not Found

```json
{ "error": "Not Found" }
```

### 500 Server Error

```json
{ "error": "Server Error" }
```

---

## 八、加分挑戰（已完成）

### 1. GET /api/signup/:id 查詢特定使用者（+5）

新增依 ID 查詢單一參與者的 API。  
若找不到 ID，會回傳 404。  
補強查詢功能，符合加分要求。

---

### 2. 前端自動重送機制 Retry（+5）

若第一次送出 POST 失敗（如伺服器錯誤）：

1. 顯示提示「伺服器錯誤，3 秒後重新送出」  
2. 等待 3 秒  
3. 自動重送一次  
4. 若成功 → 顯示結果  
5. 若仍失敗 → 顯示錯誤訊息  

可透過：

- 輸入錯誤 fetch 網址  
- 後端故意拋錯  

來測試 retry 行為。

---

