<?php
require 'config.php';
if(!empty($_SESSION["id"])){
  header("Location: index.php");
}
if(isset($_POST["submit"])){
  $usernameemail = $_POST["usernameemail"];
  $password = $_POST["password"];
  $result = mysqli_query($conn, "SELECT * FROM tb_user WHERE username = '$usernameemail' OR email = '$usernameemail'");
  $row = mysqli_fetch_assoc($result);
  if(mysqli_num_rows($result) > 0){
    if($password == $row['password']){
      $_SESSION["login"] = true;
      $_SESSION["id"] = $row["id"];
      header("Location: index.php");
    }
    else{
      echo
      "<script> alert('Wrong Password'); </script>";
    }
  }
  else{
    echo
    "<script> alert('User Not Registered'); </script>";
  }
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css">
    <title>Login</title>
  </head>
  <body>
  <center>
    <div id="backlogin">
      <h1>Login</h1>
      <hr>
      <form id="login" action="" method="post" class="" action="" method="post" autocomplete="off">
        <input type="text" class="inputa" name="usernameemail" id="usernameemail" required value="" placeholder="Masukan Username"> 
        <input type="password" class="inputa" name="password" id="password" required value="" placeholder="Masukan password"> 
        <input type="submit" class="wed" name="submit" value="Submit">
    <input type="reset" class="wed" name="" value="Reset">
    <button type="button" class="wed" onclick="window.location.href='registration.php'">Sign Up</button>
      </form>
    </div>
  </center>
  </body>
</html>
