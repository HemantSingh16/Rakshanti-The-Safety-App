<?php
session_start();
$U_id=$_SESSION['U_id'];
require 'connection.php';


//echo "<script>document.writeln(p1);</script>";


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
  <link rel="stylesheet" href="sprequestpage.css">
  <script src="https://kit.fontawesome.com/a076d05399.js"></script>
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Akaya+Kanadaka&display=swap" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="your_website_domain/css_root/flaticon.css">
  <link rel = "stylesheet" href = "http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">

    <title>VICTIM PAGE</title>

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
          data.append('req', 'update');
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
    <header style="padding-left: 15px;">Hello  <?php echo $_SESSION['name']?></header>
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




<p id="display"></p>
<center>
<h1>RESPONSE STATUS</h1>
<br>



    <?php
        $abc="SELECT * FROM contacts WHERE R_id=$U_id AND response_status = 1 ";
        $abc_result=mysqli_query($con, $abc);
        $c=1;
        $rowcount=mysqli_num_rows($abc_result);
        if($rowcount)
        {
        while ($row = mysqli_fetch_assoc($abc_result)) :
            ?>


<div class="card" style="width: 18rem;">
  <div class="card-body">
    <h5 class="card-title">
    <?php
             $userid=$row['U_id'];
             $xyz="SELECT name FROM usertable where id = (Select L_id from user where U_id = $userid)";
             $xyz_result=mysqli_query($con, $xyz);
             if($xyz_result)
             {
                $xyzfetch = mysqli_fetch_assoc($xyz_result);
                echo  $xyzfetch['name'];
             }
             else
             {
                 echo "error";
             }
   ?>
    </h5>
    <h6 class="card-subtitle mb-2 text-muted">Coming for help</h6>
    <!--<p class="card-text">Location:Nerul </p>-->
    <a class="btn btn-success" href="relative_location.php?R_id=<?=$row['U_id']?>">CHECK LOCATION</a>
  </div>
</div>
       
       
       <?php
    endwhile;
  }
    else{
?>
<h2>No relative has excepted your request till now,refresh o check again</h2>
   <?php }
      ?>
          
 <h4>Click on the button below to send requests to the social police around you for help</h4> 
  <button onclick= "getLocation()" class="btn-btn-success">Confirm</button>
 </center>


 <center>
<h1>SOCIAL POLICE RESPONSE STATUS</h1>
<br>

    <?php
        $abc1="SELECT * FROM victim_sp_relations WHERE Victim_id=$U_id AND response_status = 1 ";
        $abc1_result=mysqli_query($con, $abc1);
        $f=1;
        $rowcount1=mysqli_num_rows($abc1_result);
        if($rowcount1)
        {
        //if($abc1_result)
        while ($row1 = mysqli_fetch_assoc($abc1_result)) :
            ?>


<div class="card" style="width: 18rem;">
  <div class="card-body">
    <h5 class="card-title">
    <?php
             $userid1=$row1['Sp_id'];
             $xyz1="SELECT name FROM usertable where id = (Select L_id from user where U_id = $userid1)";
             $xyz1_result=mysqli_query($con, $xyz1);
             if($xyz1_result)
             {
                $xyz1fetch = mysqli_fetch_assoc($xyz1_result);
                echo  $xyz1fetch['name'];
             }
             else
             {
                 echo "error";
             }
   ?>
    </h5>
    <h6 class="card-subtitle mb-2 text-muted">Coming for help</h6>
    <!--<p class="card-text">Location:Nerul </p>-->
    <a class="btn btn-success" href="relative_location.php?R_id=<?=$row1['Sp_id']?>">CHECK LOCATION</a>
  </div>
</div>
       
       
       <?php
    endwhile;
  }
  else{
?>
<h4>No Social Police has excepted your request till now,refresh to check again</h4>
 <?php }
    ?>
    
          
 <!--<h2>Click on the button below to send requests to the social police around you for help</h2> 
  <button onclick= "getLocation()" class="btn-btn-success">Confirm</button>-->
 </center>

 <script>
    


function getLocation() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(showPosition);
  } else {
    x.innerHTML = "Geolocation is not supported by this browser.";
  }
}
function showPosition(position) {
  //x.innerHTML = "Latitude: " + position.coords.latitude +
  //"<br>Longitude: " + position.coords.longitude;
  lat = position.coords.latitude;
  lng = position.coords.longitude;
  user = <?php echo $U_id;?>;

  $.ajax({
            type: "POST",
            url: "victim_sp_relation_backend.php",
            data: {
                //data goes here
                user,
                lat,
                lng
            },
            success: function (data) {
                //data is returned here
                console.log(data);
                //if (data == "incorrect" || data == "") {
                  //  alert("Incorrect username password!");
                //} else {
                  // window.location = data+'/';
                  alert("success!");
                //}
            }
        });
  //  return false;
}



//function myfunction(){

/*  user = <//?php echo $U_id;?>;
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function (pos) {
      lat = pos.coords.latitude;
      lng = pos.coords.longitude;
        })
      }
        //else{
          //document.getElementById("display").innerHTML = "Geolocation is not supported!";
        //}

    //console.log(username);
    //console.log(password);

        $.ajax({
            type: "POST",
            url: "victim_sp_relation_backend.php",
            data: {
                //data goes here
                user,
                lat,
                lng
            },
            success: function (data) {
                //data is returned here
                //console.log(data);
                //if (data == "incorrect" || data == "") {
                  //  alert("Incorrect username password!");
                //} else {
                  // window.location = data+'/';
                  alert("success!");
                //}
            }
        });
  //  return false;
       
*/
  //}

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
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

</body>
</html>


     
    