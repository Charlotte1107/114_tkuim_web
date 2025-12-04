# Week11 – Docker + MongoDB + Node.js Signup System


### 一、專案結構

```
Week11/
 ├─ docker/
 │    ├─ docker-compose.yml
 │    ├─ mongo-init.js
 |    ├─ mongo-data/
 ├─ server/
 │    ├─ app.js
 │    ├─ db.js
 │    ├─ repositories/
 │    ├─ routes/
 │    ├─ .env
 │    ├─package.json
 ├─ tests/
 │    ├─ api.http
 ├─ images/  ←（放截圖用）
 └─ README.md
```

---

### 二、環境啟動（Docker）

#### 1. 建立並啟動 MongoDB
```bash
docker compose up -d
```

#### 2. 查看容器狀態
```bash
docker ps
```



---

### 三、驗證 MongoDB（mongosh / Compass）

#### 1. 進入 Mongo Shell
```bash
docker exec -it week11-mongo mongosh -u root -p password123
use week11
show collections
```

---

#### 2. 使用 MongoDB Compass

連線字串：

```
mongodb://week11-user:week11-pass@localhost:27017/week11?authSource=week11
```
*測試截圖 
![api-tests](images/螢幕擷取畫面%202025-11-24%20114943.png)
![api-tests](images/螢幕擷取畫面%202025-11-25%20144210.png)

---

### 四、後端啟動方式

#### 1. 安裝套件
```bash
cd server
npm install
```

#### 2. 啟動伺服器
```bash
npm run dev
```

---

### 五、環境變數設定（.env）

```
PORT=3001
MONGODB_URI=mongodb://week11-user:week11-pass@localhost:27017/week11?authSource=week11
ALLOWED_ORIGIN=http://127.0.0.1:5500
```

#### 變數說明
| 變數名稱 | 用途 |
|---------|------|
| **PORT** | 後端 API 埠號 |
| **MONGODB_URI** | MongoDB 連線字串 |
| **ALLOWED_ORIGIN** | 允許的前端來源（CORS） |

---

### 六、API 文件（CRUD + 分頁）

所有路由前綴：

```
/api/signup
```

---

#### 1. POST /api/signup  
建立報名資料並回傳 `_id`。

### Request Body
```json
{
  "name": "小明",
  "email": "test@example.com",
  "phone": "0912345678"
}
```

### Response
```json
{ "id": "ObjectId" }
```

---

#### 2. GET /api/signup  
回傳清單及 total。

```json
{
  "items": [...],
  "total": 5
}
```

---

#### 3. GET /api/signup?page=1&limit=10 （分頁）

後端示例（skip/limit）：

```js
collection.find({})
  .skip((page - 1) * limit)
  .limit(limit)
```

---

#### 4. PATCH /api/signup/:id  
更新 phone 或 status。

```json
{
  "phone": "0911000111"
}
```

---

#### 5. DELETE /api/signup/:id  
刪除一筆資料。

---

### 七、Email 唯一索引

#### 1. 建立 unique index
```js
db.participants.createIndex(
  { email: 1 },
  { unique: true }
)
```

#### 2. 若 email 重複，API 回傳：
```json
{ "error": "Email 已被使用" }
```

---

### 八、Mongo Shell CRUD

```js
// Create
db.participants.insertOne({
  name: "A",
  email: "a@test.com",
  phone: "0911"
})

// Read
db.participants.find()

// Update
db.participants.updateOne(
  { email: "a@test.com" },
  { $set: { phone: "0922" } }
)

// Delete
db.participants.deleteOne({ email: "a@test.com" })
```

---

### 九、REST Client 測試（tests/api.http）

```http
### 建立報名
POST http://localhost:3001/api/signup
Content-Type: application/json

{
  "name": "REST",
  "email": "rest@example.com",
  "phone": "0911222333"
}

### 清單
GET http://localhost:3001/api/signup

### 分頁查詢
GET http://localhost:3001/api/signup?page=1&limit=2

### 更新
PATCH http://localhost:3001/api/signup/{{id}}

### 刪除
DELETE http://localhost:3001/api/signup/{{id}}
```

*測試截圖 
![api-tests](images/螢幕擷取畫面%202025-12-04%20223307.png)
![api-tests](images/螢幕擷取畫面%202025-12-04%20223333.png)
![api-tests](images/螢幕擷取畫面%202025-12-04%20223408.png)
![api-tests](images/螢幕擷取畫面%202025-12-04%20223452.png)
![api-tests](images/螢幕擷取畫面%202025-12-04%20223534.png)
![api-tests](images/螢幕擷取畫面%202025-12-04%20223622.png)
![api-tests](images/螢幕擷取畫面%202025-12-04%20223639.png)

---

### 十、前端串接

前端沿用 Week07/09，fetch 呼叫：

```
http://localhost:3001/api/signup
```

送出成功後，可於 MongoDB 中查到新增資料。

---
### 十一、CRUD 解釋
是操作資料庫的基本動作，Create (建立/新增)、Read (讀取/查詢)、Update (更新/修改)、Delete (刪除)

---

### 十二、常見問題
#### 1. MongoDB 連線失敗？

請確認：

- Docker 已啟動 → docker ps

- MONGODB_URI 正確

- mongo-init.js 是否成功建立使用者

#### 2. CORS 錯誤？

請確認 .env 的：
```
ALLOWED_ORIGIN=http://127.0.0.1:5500
```

#### 3. REST Client 回傳 404？

請確認 server 是否啟動：
```
npm run dev
```
