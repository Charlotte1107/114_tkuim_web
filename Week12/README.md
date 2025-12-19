# Web 程式設計 Week12 Lab  
## 登入驗證與角色權限管理（JWT）

本專案為 Week12 Lab 作業，實作 **使用 JWT 的登入驗證機制**，並依照使用者角色（student / admin）進行 **資料存取與操作權限控管**，同時完成前後端整合。

---

## 一、專案功能說明

### 已完成功能
- 使用者註冊（signup）
- 使用者登入（login），成功後取得 JWT token
- JWT 驗證 Middleware
- 角色權限控管（student / admin）
- 參與者資料 CRUD（依角色限制）
- 前端頁面整合（登入、清單、新增、刪除、登出）
- MongoDB 資料庫整合
- dotenv 環境變數管理

---

## 二、角色與權限說明

### 角色類型
| 角色 | 權限 |
|---|---|
| student | 只能查看 / 刪除自己建立的資料 |
| admin | 可以查看 / 刪除所有資料，並新增資料 |

### 權限規則
- **GET**
  - admin：可查看所有參與者
  - student：只能查看自己建立的資料
- **POST**
  - 需登入
  - 建立資料時自動記錄 `ownerId`
- **DELETE**
  - admin：可刪除任何資料
  - student：只能刪除自己建立的資料

---

## 三、專案資料夾結構

```text
Week12/
├─ client/                 # 前端
│  ├─ index.html           # 登入頁
│  ├─ list.html            # 參與者清單頁
│  ├─ login.js             # 登入邏輯
│  ├─ main.js              # 清單 / 新增 / 刪除 / 權限 UI
│  └─ signup_form.js
│
├─ server/                 # 後端
│  ├─ app.js
│  ├─ db.js
│  ├─ middleware/
│  │  └─ auth.js           # JWT 驗證 middleware
│  ├─ repositories/
│  │  ├─ users.js
│  │  └─ participants.js
│  ├─ routes/
│  │  ├─ auth.js           # /auth/signup, /auth/login
│  │  └─ signup.js         # /api/signup（CRUD + 權限）
│  └─ utils/
│     └─ generateToken.js
│
├─ docker/
│  ├─ docker-compose.yml
│  └─ mongo-init.js
│
├─ tests/
│  └─ api.http
│
├─ .env
└─ README.md
```

---

## 四、環境需求
-Node.js v18+
-MongoDB
-npm

---

## 五、環境變數設定（.env）
請在 server/.env 建立以下內容：

```env
PORT=3001
JWT_SECRET=your_jwt_secret
MONGO_URI=mongodb://localhost:27017/week12
ALLOWED_ORIGIN=http://localhost:3001
```
---
## 六、啟動方式
### 1.安裝套件
```bash
cd server
npm install
```
### 2.啟動 MongoDB（擇一）
使用 Docker
```bash
docker compose up -d
```
使用本機 MongoDB
請確認 MongoDB 服務已啟動。

### 3.啟動後端伺服器
```bash
node app.js
```
成功後會看到：
```bash
Server running on http://localhost:3001
DB Connected
```
### 4. 開啟前端
在瀏覽器開啟：
```bash
http://localhost:3001/index.html
```
---
## 七、測試方式
方式一：瀏覽器操作
1. 登入帳號
2. 查看目前登入者（email + role）
3. 查看參與者清單
4. 新增資料（admin 才可）
5. 刪除資料（依角色限制）
6. 登出

方式二：API 測試（tests/api.http）

```http
### 登入
POST http://localhost:3001/auth/login
Content-Type: application/json

{
  "email": "admin@example.com",
  "password": "123456"
}

### 取得清單（需帶 Bearer token）
GET http://localhost:3001/api/signup
Authorization: Bearer {{token}}
```
---
## 八、測試帳號列表
|角色|	Email|	密碼|
|------|------|-------|
|admin	|admin@example.com|	admin1234|
|student	|student@example.com|pass1234|

>admin 帳號可在資料庫中手動設定 role: "admin"
---