const form = document.getElementById("loginForm");
const loading = document.getElementById("loading");
const error = document.getElementById("error");

form.addEventListener("submit", async (e) => {
  e.preventDefault();

  error.textContent = "";
  loading.style.display = "block";

  const email = document.getElementById("email").value;
  const password = document.getElementById("password").value;

  try {
    const res = await fetch("/auth/login", {
      method: "POST",
      headers: {
        "Content-Type": "application/json"
      },
      body: JSON.stringify({ email, password })
    });

    loading.style.display = "none";

    if (!res.ok) {
      error.textContent = "登入失敗";
      return;
    }

    // 重點：拿 token
    const resData = await res.json();
    localStorage.setItem("token", resData.token);
    localStorage.setItem("user", JSON.stringify(resData.user));

    // 導頁
    window.location.href = "list.html";

  } catch (err) {
    loading.style.display = "none";
    error.textContent = "無法連線到伺服器";
    console.error(err);
  }
});
