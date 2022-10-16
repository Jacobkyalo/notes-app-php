const registerForm = document.getElementById("register__form");

const body = document.body;
body.style.backgroundColor = "#111";

//listen for register form submit
registerForm.addEventListener("submit", (e) => {
  e.preventDefault();
  //get all input values
  const username = document.getElementById("username").value;
  const email = document.getElementById("email").value;
  const password = document.getElementById("password").value;
  const confirmPassword = document.getElementById("confirm-password").value;
  // errors
  let usernameError = document.getElementById("username-error");
  let emailError = document.getElementById("email-error");
  let passwordError = document.getElementById("password-error");
  let confirmPasswordError = document.getElementById("confirmpassword-error");

  if (username === "") {
    usernameError.textContent = "Username is required!";
  } else if (email === "") {
    emailError.textContent = "Email is required!";
  } else if (password === "") {
    passwordError.textContent = "Password is required!";
  } else if (confirmPassword === "") {
    confirmPasswordError.textContent = "ConfirmPassword is required!";
  } else if (password !== confirmPassword) {
    confirmPasswordError.textContent = "Passwords do not match!";
  } else {
    console.log("Form can be submitted 🥰");
  }

  //remove errors
  setTimeout(() => {
    usernameError.textContent = "";
    emailError.textContent = "";
    passwordError.textContent = "";
    confirmPasswordError.textContent = "";
  }, 1000);
});
