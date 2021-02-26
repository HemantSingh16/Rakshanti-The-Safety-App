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
            if (res.status==1) {
              track.display.innerHTML = Date.now() + " | Lat: " + pos.coords.latitude + " | Lng: " + pos.coords.longitude;
            } else {
              track.display.innerHTML = res.message;
            }
          };
          xhr.send(data);
        });
      }
    };
    window.addEventListener("DOMContentLoaded", track.init);
    </script>
</head>
<body>
<p id="display"></p>
<div id="map" style="width:100%; height:400px;"></div>
</body>
</html>


     
    