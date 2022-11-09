
<?php include "../config/database.php";?>

<?php
//start session 

session_start();

 // set values and error to empty strings
 $username = $email = $password = $confirmpassword = "";
 $error ="";

//listen for form submit
if(isset($_POST['submit'])){
  if(empty($_POST['username']) || empty($_POST['email'])||empty($_POST['password']) || empty($_POST['confirmpassword'])){
    $error ='All fileds are required!';
  }elseif($_POST['password'] !== $_POST['confirmpassword']){
    $error='Passwords must match!';
  }else{
    $username = filter_input(INPUT_POST,'username',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST,'email',FILTER_SANITIZE_EMAIL);
    $password = filter_input(INPUT_POST,'password',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $confirmpassword = filter_input(INPUT_POST,'confirmpassword',FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    //check whether exists in the database
    $user = "SELECT username FROM users WHERE username='$username'";
    $result = mysqli_query($conn,$user);
    $occurrence = mysqli_num_rows($result);

    if($occurrence == 1){
    $error = 'User exists!';
    }else{
      $sql = "INSERT INTO users (username,email,password,confirmpassword) VALUES ('$username','$email','$password','$confirmpassword')";
      if(mysqli_query($conn,$sql)){
        header('Location: login.php');
      }
    }
   }
  }
// }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Register - Notes App</title>
    <link rel="shortcut icon" href="../images/notes.jpeg" type="image/x-icon">
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css"
    />
    <link rel="stylesheet" href="./style.css">
  </head>
  <body>
    <div class="wrapper">
      <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="POST" style="padding: 0.4rem 2rem" class="form" id="register__form">
        <header class="header">
          <h1>Notes App</h1>
        </header>
        <hr color="#ff7700" size="1px" />
        <h2 class="form-title">Register</h2>
        <p style="color: red;font-size:18px"><?php echo $error ?? null;?></p>
        <div class="form-group">
          <label for="username">Username</label>
          <div class="input-group">
            <input
              type="text"
              name="username"
              id="username"
              placeholder="Username"
            />
            <i class="bi bi-person"></i>
          </div>
          <p id="username-error" class="error"></p>
        </div>
        <div class="form-group">
          <label for="email">Email Address</label>
          <div class="input-group">
            <input
              type="text"
              name="email"
              id="email"
              placeholder="Email Address"
            />
            <i class="bi bi-envelope"></i>
          </div>
          <p id="email-error" class="error"></p>
        </div>
        <div class="form-group">
          <label for="password">Password</label>
          <div class="input-group">
            <input
              type="password"
              name="password"
              id="password"
              placeholder="Password"
            />
            <i class="bi bi-lock"></i>
          </div>
          <p id="password-error" class="error"></p>
        </div>
        <div class="form-group">
          <label for="confirmpassword">Confirm Password</label>
          <div class="input-group">
            <input
              type="password"
              name="confirmpassword"
              id="confirm-password"
              placeholder="Confirm password"
            />
            <i class="bi bi-lock"></i>
          </div>
          <p id="confirmpassword-error" class="error"></p>
        </div>
        <button type="submit" class="btn" name="submit">Register</button>
        <p class="navigate-text">
          Already have an account? <a href="./login.php">Login</a>
        </p>
      </form>
    </div>
    <script src="../js/index.js"></script>
   
  </body>
</html>
