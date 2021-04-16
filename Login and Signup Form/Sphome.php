<?php
session_start();
require 'connection.php';
require_once "controllerUserData.php";

$U_id=$_SESSION['U_id'];
$Login_id=$_SESSION['L_id'];
$sql3="SELECT * FROM user WHERE L_id='$Login_id'";
$result3 = mysqli_query($con, $sql3);
$fetch3 = mysqli_fetch_assoc($result3);
$U_ID = $fetch3['U_id'];
//$name=$fetch3['name'];
$_SESSION['U_id']=$U_ID;
$email = $_SESSION['email'];
$password = $_SESSION['password'];
if($email != false && $password != false){
    $sql = "SELECT * FROM usertable WHERE email = '$email'";
    $run_Sql = mysqli_query($con, $sql);
    if($run_Sql){
        $fetch_info = mysqli_fetch_assoc($run_Sql);
        $status = $fetch_info['status'];
        $code = $fetch_info['code'];
        if($status == "verified"){
            if($code != 0){
                header('Location: reset-code.php');
            }
        }else{
            header('Location: user-otp.php');
        }
    }
}else{
    header('Location: login-user.php');
}
$sql4="SELECT * FROM usertable WHERE id='$Login_id'";
$result4 = mysqli_query($con, $sql4);
$fetch4 = mysqli_fetch_assoc($result4);
$name=$fetch4['name'];
$_SESSION['name']=$name;



if(isset($_POST['button2'])) { 
  echo "This is Button2 that is selected"; 
} 

if(isset($_POST['button3'])) { 
$statement1="UPDATE contacts 
SET response_status =1
WHERE U_id=$U_ID AND status= 1";
$outcome1= mysqli_query($con, $statement1);
if ($outcome1)
  {
      $R_id=$_POST['button3'];
      header("Location:Helper_tracker.php?R_id=$R_id");
  }
  else
  {
      echo "Something unexpected happened,please try again later";
  }

} 
if(isset($_POST['button1'])) { 
//sending sms to trusted contacts
$sql = "SELECT PhoneNo FROM contacts where R_id=$U_ID AND response_status=1";
$result = mysqli_query($con, $sql);

if ($result->num_rows > 0) {
// output data of each row
while($row = $result->fetch_assoc()) {
$mobile= $row["PhoneNo"];
// echo "$mobile";
$fields = array(
"message" => "Hi,I am in trouble,please help me by reaching to below location:",
"language" => "english",
"route" => "q",
"numbers" => "$mobile",
);

$curl = curl_init();

curl_setopt_array($curl, array(
CURLOPT_URL => "https://www.fast2sms.com/dev/bulkV2",
CURLOPT_RETURNTRANSFER => true,
CURLOPT_ENCODING => "",
CURLOPT_MAXREDIRS => 10,
CURLOPT_TIMEOUT => 30,
CURLOPT_SSL_VERIFYHOST => 0,
CURLOPT_SSL_VERIFYPEER => 0,
CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
CURLOPT_CUSTOMREQUEST => "POST",
CURLOPT_POSTFIELDS => json_encode($fields),
CURLOPT_HTTPHEADER => array(
"authorization:tupYfBn2xwq7h0ZC5kOa9l8VEizvHGjKFMrRXAygsSUNQDP64eGncSO9JQsWHh1BuyTaDoAYpE5jxlZ0",
"accept: */*",
"cache-control: no-cache",
"content-type: application/json"
),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
echo "cURL Error #:" . $err;
} else {
echo $response;
}
}


}
$statement="UPDATE contacts
SET status = 1
WHERE R_id=$U_ID";
$outcome= mysqli_query($con, $statement);
if ($outcome)
{
    header('Location:victim_tracking.php');
}
else
{
    echo "Something unexpected happened,please try again later";
}

} 




?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="home1.css">

  
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="https://kit.fontawesome.com/a076d05399.js"></script>
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="your_website_domain/css_root/flaticon.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;900&display=swap" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.6.2/animate.min.css" rel="stylesheet">
 



    <title>HOME PAGE</title>

    <script>
    var track = {
      // (A) PROPERTIES & SETTINGS
      user : <?php echo $U_id;?>, // Rider ID - Fixed to 999 for this demo.
      delay : 10000, // Delay between GPS update, in milliseconds.
      timer : null, // Interval timer.
      display : null, // HTML <p> element.
     
      // (B) INIT
      init : function () {
        track.display = document.getElementById("display");
        if (navigator.geolocation) {
          track.update();
          setInterval(track.update, track.delay);
        } else {
          track.display.innerHTML = "Geolocation is not supported!";
        }
      },
     
      // (C) UPDATE CURRENT LOCATION TO SERVER
      update : function () {
        navigator.geolocation.getCurrentPosition(function (pos) {
          // (C1) LOCATION DATA
          var data = new FormData();
          data.append('req', 'spupdate');
          data.append('U_id', track.user);
          data.append('lat', pos.coords.latitude);
          data.append('lng', pos.coords.longitude);
     
          // (C2) AJAX
          var xhr = new XMLHttpRequest();
          xhr.open('POST', "2b-ajax-track.php");
          xhr.onload = function () {
          var res = JSON.parse(this.response);
            //if (res.status==1) {
            //  track.display.innerHTML = Date.now() + " | Lat: " + pos.coords.latitude + " | Lng: " + pos.coords.longitude;
            //} else {
            //  track.display.innerHTML = res.message;
            //}
          };
          xhr.send(data);
        });
      }
    };
    window.addEventListener("DOMContentLoaded", track.init);
    </script>
</head>
<body>

<div id="mySidenav" class="sidenav">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()" style="padding-top: 20px; margin-left: 30px;">&times;</a>
    <header style="padding-left: 15px;">Hello <?php echo $name?></header>
    <a href="home.php"><i class="fa fa-th-large" style="margin-right: 10px; margin-left: 10px;"></i>Home</a>
    <a href=""><i class="fa fa-user" style="margin-right: 10px; margin-left: 10px;"></i>Profile</a>
    <a href="addRelatives.php" style="margin-right: 10px;"><i class="fas fa-address-card" aria-hidden="true" style="margin-right: 10px; margin-left: 10px;"></i>Relatives</a>
    <a href="addCloseFriends.php"><i class="fas fa-users" aria-hidden="true" style="margin: 10px; margin-left: 10px;"></i>Close friends</a>
    <a href="#"><i class="fa fa-bell" aria-hidden="true" style="margin: 10px; margin-left: 10px;"></i>Notification</a>
    <a href="#"><i class="fas fa-history" aria-hidden="true" style="margin-right: 10px; margin-left: 10px;"></i>History</a>
    <a href="#"><i class="" aria-hidden="true" style="margin-right: 10px; margin-left: 10px;"></i></a>
    <a href="logout-user.php" id="logout"> <i class="fas fa-power-off" style="margin-right: 10px; margin-left: 10px;"></i>Log out</a>
  </div>
  
    <nav class="navbar navbar-expand-lg primary_color navbar-dark">
      <a class="navbar-brand" href="#"><span style="font-size:30px;cursor:pointer" onclick="openNav()"><i class="fa fa-bars" aria-hidden="true" style="margin: 10px; color:black;"></i></span></a>
      <div id="overlay" onclick="closeNav()"></div> 
      <a><i class="fa fa-qrcode fa-2x" aria-hidden="true" id="qr" style=" color: #111; float: right; line-height: 50px; padding-right:8px;"></i></a>
    </nav>
<br>


<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->
            <ol class="carousel-indicators">
                <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                <li data-target="#carousel-example-generic" data-slide-to="2"></li>
            </ol>

            <!-- Wrapper for slides -->
            <div class="carousel-inner" role="listbox">
                
                <div class="item active">
                    <div class="banner">
                        <a href="skeleton.html"><img src="number.jpg" alt="No"></a>                        
                    </div>              
                </div>
                <div class="item">
                    <div class="banner">
                      <a href="skeleton.html"><img src="current location.png" alt="No"></a>
                    </div>
                    
                </div>
                <div class="item">
                    <div class="banner">
                      <a href="skeleton.html"><img src="nearby places.png" alt="No"></a>
                    </div>
                    
                </div>


            </div>

            <!-- Controls -->
            <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>




    <form method="post"> 
      <div class="wrap">
        <input type="submit" name="button1" value="UNSAFE" class="button" />
  
     </div>
        <div class="wrap">
        <input type="submit" name="button2" value="POLICE" class="button2"/>
     </div>
     </form>


     <center>
      <form method="get" action="helper_request.php">
         <button type="submit">Helper Request</button>
     </form>
      </center>

<div></div>




<p id="display"></p>

 <script>

function overlay(isShow){
  var elm = document.getElementById('overlay')
  if (isShow) {
    elm.style.display = 'block';
  } else {
    elm.style.display = 'none';
  }
}


function openNav() {
  overlay(true);
	document.getElementById('mySidenav').style.width="230px";
    document.body.style.backgroundColor = "rgba(0,0,0,0.4)";
}

function closeNav() {
  overlay(false);
    document.getElementById('mySidenav').style.width="0";
    document.body.style.backgroundColor = "white";
}
</script>


</body>
</html>