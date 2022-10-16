const loginForm = document.getElementById("login__form");

const body = document.body;
body.style.backgroundColor = "#111";

// listen to login form submit
loginForm.addEventListener("submit", (e) => {
  e.preventDefault();
  // input values
  const loginUsername = document.getElementById("login-username").value;
  const loginPassword = document.getElementById("login-password").value;

  // errors values
  const loginUsernameError = document.getElementById("login-username-error");
  const loginPasswordError = document.getElementById("login-password-error");

  if (loginUsername === "") {
    loginUsernameError.textContent = "Username is required!";
  } else if (loginPassword === "") {
    loginPasswordError.textContent = "Password is required!";
  } else {
    console.log("You can login successfully 🥰");
  }

  //remove errors
  setTimeout(() => {
    loginUsernameError.textContent = "";
    loginPasswordError.textContent = "";
  }, 1000);
});
