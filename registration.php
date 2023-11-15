<?php
require 'config.php';

$registrationSuccessMessage = ''; // Initialize the success message variable

if (!empty($_SESSION["id"])) {
    header("Location: index.php");
}

if (isset($_POST["submit"])) {
    $name = $_POST["name"];
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirmpassword = $_POST["confirmpassword"];
    $duplicate = mysqli_query($conn, "SELECT * FROM tb_user WHERE username = '$username' OR email = '$email'");
    
    if (mysqli_num_rows($duplicate) > 0) {
        echo "<script> alert('Username or Email Has Already Taken'); </script>";
    } else {
        if ($password == $confirmpassword) {
            $query = "INSERT INTO tb_user VALUES('', '$name', '$username', '$email', '$password')";
            mysqli_query($conn, $query);
            // Set the success message
            $registrationSuccessMessage = "Registration Successful. Please login with your username.";
        } else {
            echo "<script> alert('Password Does Not Match'); </script>";
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
    <script>
      // JavaScript functionto hide or display the success message
      function showSuccessMessage() {
        var successMessage = document.getElementById("successMessage");
        successMessage.style.display = "block";
      }
    </script>
  </head>
  <body>
    <center>
      <div id="backlogin">
        <h1>Registration</h1>
        <hr>
        <form id="login" action="" method="post" class="" action="" method="post" autocomplete="off">
        <form id="login" action="" method="post" class="" action="" method="post" autocomplete="off">
          <input type="text" class="inputa" name="name" id="name" required value="" placeholder="Masukan Nama"> 
          <input type="text" class="inputa" name="username" id="username" required value="" placeholder="Masukan Username">
          <input type="email" class="inputa" name="email" id="email" required value="" placeholder="Masukan Email">
          <input type="password" class="inputa" name="password" id="password" required value="" placeholder="Masukan Password">
          <input type="password" class="inputa" name="confirmpassword" id="confirmpassword" required value="" placeholder="Konfirmasi Password">
          <input type="submit" class="wed" name="submit" value="Submit">
          <input type="reset" class="wed" name="" value="Reset">
          <button type="button" class="wed" onclick="window.location.href='login.php'">Sign In</button>
        </form>
        <div id="successMessage" style="display: none; color: green;">
          <?php echo $registrationSuccessMessage; ?>
        </div>
      </div>
    </center>
    <script>
      // Call the function to show the success message when registration is successful
      <?php if (!empty($registrationSuccessMessage)) { ?>
        showSuccessMessage();
      <?php } ?>
    </script>
  </body>
</html>
