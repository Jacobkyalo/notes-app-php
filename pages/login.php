<?php include '../config/database.php';?>
<?php

//start session
session_start();

// set username,password and error to empty strings
$username = $password ='';
$error = '';

//listen for form submit
if(isset($_POST['submit'])) {
  if(empty($_POST['username']) || empty($_POST['password'])){
    $error = 'Username and password are required!';
  }else{
    $username= filter_input(INPUT_POST,'username',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $password = filter_input(INPUT_POST,'password',FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    //check whether exists in the database
    $user = "SELECT username,password FROM users WHERE username='$username' AND password = '$password'";
    $resultquery = mysqli_query($conn,$user);
    $existence = mysqli_num_rows($resultquery);
  
    if($existence == 1){
     $_SESSION["username"]=$username;
     header('Location: notes.php');
    }else{     
      $error= 'User does not exist!';
    }
  }
}
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login - Notes App</title>
    <link rel="shortcut icon" href="../images/notes.jpeg" type="image/x-icon">
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css"
    />
    <link rel="stylesheet" href="./style.css" />
  </head>
  <body>
    <div class="wrapper">
      <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="POST" class="form" id="login__form">
        <header class="header">
          <h1>Notes App</h1>
        </header>
        <hr color="#ff7700" size="1px" />
        <h2 class="form-title">Login</h2>
        <p style="color: red;font-size:18px"><?php echo $error ?? null;?></p>
        <div class="form-group">
          <label for="username">Username</label>
          <div class="input-group">
            <input
              type="text"
              name="username"
              id="login-username"
              placeholder="Username"
            />
            <i class="bi bi-person"></i>
          </div>
          <p id="login-username-error" class="error"></p>
        </div>
        <div class="form-group">
          <label for="password">Password</label>
          <div class="input-group">
            <input
              type="password"
              name="password"
              id="login-password"
              placeholder="Password"
            />
            <i class="bi bi-lock"></i>
          </div>
          <p id="login-password-error" class="error"></p>
        </div>
        <button type="submit" class="btn" name="submit">Login</button>
        <p class="navigate-text">
          Don't have an account? <a href="./register.php">Register</a>
        </p>
      </form>
    </div>
    <script src="../js/login.js"></script>
  </body>
</html>
