<?php include '../config/database.php';?>
<?php

session_start();
$noNotes ='';

//if no user go to login page
if (!isset($_SESSION['username'])) {
  header('Location: login.php');
}

  //get notes from database
  $sql = "SELECT * FROM notes";
  $sqlresult = mysqli_query($conn,$sql);
  $notes = mysqli_fetch_all($sqlresult,MYSQLI_ASSOC);

  if(count($notes)<1){
    $noNotes= 'No notes add some below 👇';
  }else{
    $noNotes = '';
  }


//delete notes
if(isset($_POST['delete'])){
  $notesid = mysqli_real_escape_string($conn,$_POST['delete']);
  $deletesql = "DELETE FROM notes WHERE id='$notesid'";
  $deleteresoponse = mysqli_query($conn,$deletesql);

  if($deleteresoponse){
    header('Location: notes.php');
  }
}


?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Your Notes - Notes App</title>
    <link rel="shortcut icon" href="../images/notes.jpeg" type="image/x-icon">
    <link rel="stylesheet" href="./style.css" />
  </head>
  <body>
    <div class="notes-wrapper">
      <div class="container">
        <header class="notes-header">
          <h2 class="welcome-text">Hi 👋 <span><?php echo $_SESSION['username'];?></span></h2>     
            <a href="./logout.php" class="logout-btn" style="color: #fff">Logout</a>        
        </header>
        <section class="hero-section">
          <div class="welcome-title"><h2>Your notes 👇 </h2></div>
        </section>
        <section class="notes-section">
        <p style="color: #000;font-size:20px"><?php echo $noNotes ?? null;?></p>
        <?php foreach($notes as $note):?>
          <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="POST" style="width: 100%;">
          <div class="notes-card">
            <div class="card-upper">
              <div class="notes-title">
                <h4><?php echo $note['title'];?></h4>
                <h5><?php echo $note['datetime'];?></h5>
              </div>
            </div>
            <div class="card-lower">
              <div class="card-overview">
                <p>
                <?php echo $note['description'];?>
                </p>
              </div>
                <button type="submit" value="<?php echo $note['id'];?>" class="delete" name="delete">Delete</button>           
            </div>
          </div>
          </form>
          <?php endforeach?>         
            <a href="./addNotes.php" style="color: #fff" class="add">Add notes</a>     
        </section>
      </div>
    </div>
    <script src="../js/index.js"></script>
  </body>
</html>
