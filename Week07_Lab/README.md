# Week07_Lab – 會員註冊表單

整合 **DOM 事件委派、Constraint Validation API、自訂錯誤訊息、可及性（A11y）** 與 **防重送** 的註冊表單。含進階加分：密碼強度條、localStorage 草稿、重設按鈕。

---

## 功能對照表

| 要求 | 是否實作 | 實作位置 |
|---|---|---|
| 事件委派：興趣標籤父層監聽切換樣式/計數 | V | `signup_form.js` → `attachTagsDelegation()`（監聽 `#tags`，切 `.active`，更新 `#tags-count`） |
| 即時驗證：blur 後啟用、input 即時更新 | V | `attachFieldValidation()` + `touched` 集合；密碼輸入時會同步驗證「確認密碼」 |
| 客製訊息：`setCustomValidity()` + 錯誤 `<p>` | V | `setError()/clearError()` 與各 `validate*()` |
| 可及性：`aria-describedby` 連結錯誤/說明 | V | HTML 各欄位 `aria-describedby="*-help *-error"`；全域狀態 `#form-status[aria-live=polite]` |
| 送出攔截：檢查全部、聚焦第一錯誤、成功 1 秒提示 | V | `form.addEventListener('submit', ...)`；成功 `setTimeout(1000)` 模擬送出 |
| 防重送：送出中 disabled + Loading 樣式 | V | JS 設 `disabled` + `.loading`；樣式在 `styles.css` |

### 進階加分（+10 分）
- **密碼強度條**（弱/中/強）：`updateStrength()` + `.bar.weak/.medium/.strong`
- **localStorage 草稿**（不含密碼）：`saveDraft()`、`loadDraft()`（儲存姓名/Email/手機/興趣/條款）
- **重設按鈕**：`resetBtn` 事件 → `form.reset() + resetUI() + clearDraft()`

---

## 規則與自訂錯誤訊息

- **姓名**：必填 → 「請輸入姓名。」
- **Email**：必填 + 格式檢查  
  - 以 `^[^\s@]+@[^\s@]+\.[^\s@]+$` 檢查；並去除全形空白再回寫到 input  
  - 錯誤 → 「Email 格式不正確。」
- **手機**：必填 + 10 碼數字（`^\d{10}$`） → 「手機需為 10 碼數字（不含符號）。」
- **密碼**：至少 8 碼 + 英數混合 → 「密碼需至少 8 碼，且包含英文與數字。」
- **確認密碼**：需與密碼一致 → 「兩次密碼不一致。」
- **興趣標籤**：至少勾選 1 項 → 「請至少選擇 1 個興趣標籤。」
- **服務條款**：必勾 → 「請勾選同意服務條款。」



