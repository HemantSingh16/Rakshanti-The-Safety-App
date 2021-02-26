<?php
session_start();
$U_id=$_SESSION['U_id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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

<div style="padding:50px; margin-top:10px;">
   <table class="table table-bordered">
    <thead class="thead-dark" style="background-color: black; color: white;">
    <tr>
      <th scope="col">Sr no</th>
      <th scope="col">MESSAGE</th>
      <th scope="col">STATUS</th>
    </tr>
       </thead>


    <?php
        $abc="SELECT * FROM contacts WHERE U_id=$U_ID AND status = 1 ";
        $abc_result=mysqli_query($con, $abc);
        $c=1;
        while ($row = mysqli_fetch_assoc($abc_result)) :
            ?>



            <tbody style="background-color: white; color: black;">
              <tr>
                <td><?php echo $c++; ?></td>
                <td><?php echo "User id ". $row['R_id'] . " needs your help" ?></td>     
                <td><a class="btn btn-success" href="Helper_tracker.php?R_id=<?=$row['R_id']?>">CHECK STATUS</a></td>     
                <!--<td><a class="btn btn-danger" >REJECT</a></td>-->
              </tr>
        </tbody>
       
       
       
       <?php
    endwhile;

    
      ?>
          
</table>
 </div>

</body>
</html>


     
    