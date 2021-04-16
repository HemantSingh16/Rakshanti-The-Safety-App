<?php
session_start();
require 'connection.php';
$U_id=$_SESSION['U_id'];
$L_id=$_SESSION['L_id'];      
        if(isset($_POST['button1'])) { 
            $statement="UPDATE usertable
            SET is_sp = 1
            WHERE id=$L_id";
            $outcome= mysqli_query($con, $statement);
            if ($outcome)
            {
                header('Location: Sphome.php');
            }
            else
            {
                echo "Error";
            }
        }
            ?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="sp_registration.css">
  <script src="https://kit.fontawesome.com/a076d05399.js"></script>
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Akaya+Kanadaka&display=swap" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="your_website_domain/css_root/flaticon.css">

  <title>Social Police Registration</title>

</head>
<body> 

  <div class="wrapper">
    <div class="login-text">
      <button class="cta"><i class="fas fa-chevron-down fa-1x"></i></button>
      <div class="text">
        <a href="">Register As Social police</a>
        <hr>
        <br>
        <input  type="text" placeholder="Aadhar card number">
        <br>
       <form method="post">  
                <button type="submit" name="button1" class="login-btn">Confirm</button>
        </form>
      </div>
    </div>
    <div class="call-text">
      <h1>Do u have <span>Responsible</span> side?</h1>
      <button>Join As Social Police</button>
    </div>
  </div>


  <script type="text/javascript" src="sp_registration.js"></script>
</body>
</html>