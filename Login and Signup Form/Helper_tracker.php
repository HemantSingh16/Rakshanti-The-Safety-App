<?php
session_start();
$U_id=$_SESSION['U_id'];
$R_id=$_GET['R_id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src='https://api.mapbox.com/mapbox-gl-js/v2.0.0/mapbox-gl.js'></script>
    <link href='https://api.mapbox.com/mapbox-gl-js/v2.0.0/mapbox-gl.css' rel='stylesheet' />

<!-- Bootstrap CSS -->
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="home1.css">
  <script src="https://kit.fontawesome.com/a076d05399.js"></script>
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Akaya+Kanadaka&display=swap" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="your_website_domain/css_root/flaticon.css">


    <title>VICTIM PAGE</title>

    <script>
    var track = {
      // (A) PROPERTIES & SETTINGS
      user : <?php echo $U_id;?>, // Rider ID - Fixed to 999 for this demo.
      delay : 10000, // Delay between GPS update, in milliseconds.
      timer : null, // Interval timer.
      map : null,
      display : null, // HTML <p> element.
     
      // (B) INIT
      init : function () {
        mapboxgl.accessToken = 'pk.eyJ1IjoiaGVtYW50MTYiLCJhIjoiY2tsbWZmOHplMDhudjJvcXl6aDR4bm8wNyJ9.4Q9xbn7IbhpKe6br3Vs92g';
        track.display = document.getElementById("display");
        if (navigator.geolocation) {
          track.update();
          track.map = document.getElementById("map");
          track.show();
          //setInterval(function () 
          //{
           // track.update;
           // track.show;
          //}, track.delay);
          setInterval(track.show, track.delay);
          setInterval(track.update, track.delay);
        } else {
          track.display.innerHTML = "Geolocation is not supported!";
        }
      },

      // (C) GET DATA FROM SERVER AND UPDATE MAP
        show : function () {
         // (C1) DATA
          var data = new FormData();
          data.append('req', 'get');
          data.append('U_id', <?php echo $R_id ?>);
 
          // (C2) AJAX
          var xhr = new XMLHttpRequest();
          xhr.open('POST', "2b-ajax-track.php");
          xhr.onload = function () {
            track.map.innerHTML = "<div>LOADED "+Date.now()+"</div>";
            var res = JSON.parse(this.response);
            if (res.status==1) {

              let map = new mapboxgl.Map({
              container: 'map',
              style: 'mapbox://styles/mapbox/streets-v11',
              center: [res.message.track_lng, res.message.track_lat],
              zoom: 13
              });

              let marker = new mapboxgl.Marker()
              .setLngLat([res.message.track_lng, res.message.track_lat])
              .addTo(map);


              //for (let rider of res.message) {
               // var dummy = document.createElement("div");
               // dummy.innerHTML = "Rider ID " + rider.rider_id + " | Lng " + rider.track_lng + " | Lat " + rider.track_lat + " | Updated " + rider.track_time;
               // track.map.appendChild(dummy);
              }
            else
             { 
              
              track.map.innerHTML = res.message; 

              
              
              
              }
          };
          xhr.send(data);




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
          xhr.open('POST', "2b-ajax-track-helper.php");
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
    <header style="padding-left: 15px;">Hello <?php echo $_SESSION['name']?></header>
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


<p id="display"><center><h1>VICTIM LOCATION</h1></center></p>
<div id="map" style="width:100%; height:500px;"></div>



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


     
    