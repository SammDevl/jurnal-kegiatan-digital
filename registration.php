<?php
require 'config.php';
if(!empty($_SESSION["id"])){
  header("Location: index.php");
}
if(isset($_POST["submit"])){
  $name = $_POST["name"];
  $username = $_POST["username"];
  $email = $_POST["email"];
  $password = $_POST["password"];
  $confirmpassword = $_POST["confirmpassword"];
  $duplicate = mysqli_query($conn, "SELECT * FROM tb_user WHERE username = '$username' OR email = '$email'");
  if(mysqli_num_rows($duplicate) > 0){
    echo
    "<script> alert('Username or Email Has Already Taken'); </script>";
  }
  else{
    if($password == $confirmpassword){
      $query = "INSERT INTO tb_user VALUES('','$name','$username','$email','$password')";
      mysqli_query($conn, $query);
      echo
      "<script> alert('Registration Successful'); </script>";
    }
    else{
      echo
      "<script> alert('Password Does Not Match'); </script>";
    }
  }
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style2.css" >
    <title>Registration</title>
  </head>
  <body>
  <center>
    <div id="backlogin">
      <h1>Registration</h1>
      <hr>
      <form id="login" action="" method="post" class="" action="" method="post" autocomplete="off"> 
        <input type="text" class="inputa" name="name" id="name" required value="" placeholder="Masukan Nama"> 
        <input type="text" class="inputa" name="username" id="username" required value="" placeholder="Masukan Username">
        <input type="email" class="inputa" name="email" id="email" required value="" placeholder="Masukan Email">
        <input type="password" class="inputa" name="password" id="password" required value="" placeholder="Masukan Password">
        <input type="password" class="inputa" name="confirmpassword" id="confirmpassword" required value="" placeholder="Konfirmasi Password">

        <input type="submit" class="wed"name="submit" value="Submit"> <input type="reset" class="wed" name="" value="Reset"> 
        <button class="wed"><a style="text-decoration:none; color:white;" href="login.php">Sign in</a></button>
      </form>
    </div>
  </center>
  </body>
</html>
