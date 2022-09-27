<?php include '../config/database.php';?>
<?php

//set title,decription and error to empty strings
$title = $description = '';
$error = '';

//listen for submit 
if(isset($_POST['submit'])){
  if(empty($_POST['title']) || empty($_POST['description'])){
    $error = 'Title and description fields are required!';
  }else{
    $title = filter_input(INPUT_POST ,'title',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $description = filter_input(INPUT_POST ,'description',FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    //submit form details to database
    $sql = "INSERT INTO notes (title,description) VALUES ('$title','$description')";
    $sqlresult = mysqli_query($conn,$sql);
    if(empty($error)){
      header('Location: notes.php');
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
    <title>Add Notes - Notes App</title>
    <link rel="shortcut icon" href="../images/notes.jpeg" type="image/x-icon">
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css"
    />
    <link rel="stylesheet" href="./style.css" />
  </head>
  <body>
    <div class="wrapper">
      <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="POST" class="form">
        <header class="header">
          <h1>Notes App</h1>
        </header>
        <hr color="#ff7700" size="1px" />
        <h2 class="form-title">Add Notes</h2>
        <p style="color: red;font-size:18px"><?php echo $error ?? null;?></p>
        <div class="form-group">
          <label for="title">Title</label>
          <div class="input-group">
            <input
              type="text"
              name="title"
              id="title"
              placeholder="Notes title"
              style="padding: 13px 10px"
            />
          </div>
        </div>
        <div class="form-group">
          <label for="description">Description</label>
          <div class="input-group">
            <textarea
              name="description"
              id="description"
              placeholder="Notes description"
              rows="5"
              style="
                width: 100%;
                padding: 10px;
                outline: none;
                border-radius: 7px;
              "
            ></textarea>
          </div>
        </div>
        <button type="submit" class="btn" name="submit">Add Notes</button>
        <p class="navigate-text">
          Don't want to add notes? <a href="./notes.php">Cancel</a>
        </p>
      </form>
    </div>
    <script src="../js/index.js"></script>
  </body>
</html>
