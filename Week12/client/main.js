const list = document.getElementById("list");
const loading = document.getElementById("loading");
const error = document.getElementById("error");
const logoutBtn = document.getElementById("logoutBtn");
const userSpan = document.getElementById("currentUser");

const createForm = document.getElementById("createForm");
const formError = document.getElementById("formError");
const createSection = document.getElementById("createSection");

// 取得登入者資訊
const user = JSON.parse(localStorage.getItem("user"));

if (!user) {
  // 沒登入就踢回登入頁
  window.location.href = "index.html";
}

// 顯示目前登入者
userSpan.textContent = `${user.email} (${user.role})`;

// 非 admin 隱藏新增區塊
if (user.role !== "admin") {
  createSection.style.display = "none";
}

// 一進頁面載入清單
loadParticipants();


/* ========= 讀取清單 ========= */
async function loadParticipants() {
  const token = localStorage.getItem("token");

  if (!token) {
    window.location.href = "index.html";
    return;
  }

  list.innerHTML = "";
  loading.style.display = "block";

  try {
    const res = await fetch("/api/participants", {
      method: "GET",
      headers: {
        Authorization: `Bearer ${token}`
      }
    });

    loading.style.display = "none";

    if (res.status === 401 || res.status === 403) {
      localStorage.clear();
      window.location.href = "index.html";
      return;
    }

    if (!res.ok) {
      error.textContent = "讀取失敗";
      return;
    }

    const data = await res.json();

    data.items.forEach(item => {
      const li = document.createElement("li");

      const span = document.createElement("span");
      span.textContent = item.email;

      li.appendChild(span);

      // admin 或擁有者才顯示刪除
      if (user.role === "admin" || item.ownerId === user.id) {
        const btn = document.createElement("button");
        btn.textContent = "刪除";

        btn.addEventListener("click", async () => {
          if (!confirm("確定要刪除？")) return;

          const delRes = await fetch(`/api/participants/${item._id}`, {
            method: "DELETE",
            headers: {
              Authorization: `Bearer ${token}`
            }
          });

          if (!delRes.ok) {
            alert("刪除失敗");
            return;
          }

          li.remove();
        });

        li.appendChild(btn);
      }

      list.appendChild(li);
    });

  } catch (err) {
    loading.style.display = "none";
    error.textContent = "伺服器錯誤";
    console.error(err);
  }
}

/* ========= 新增參與者 ========= */
createForm.addEventListener("submit", async (e) => {
  e.preventDefault();

  formError.textContent = "";

  const name = document.getElementById("name").value;
  const email = document.getElementById("email").value;

  try {
    const res = await fetch("/api/participants", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
        Authorization: `Bearer ${localStorage.getItem("token")}`
      },
      body: JSON.stringify({ name, email })
    });

    if (!res.ok) {
      formError.textContent = "新增失敗";
      return;
    }

    createForm.reset();
    loadParticipants();

  } catch (err) {
    formError.textContent = "無法連線伺服器";
  }
});

/* ========= 登出 ========= */
logoutBtn.addEventListener("click", () => {
  localStorage.clear();
  window.location.href = "index.html";
});
