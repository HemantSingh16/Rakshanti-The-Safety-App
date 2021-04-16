<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "wsa";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    mysqli_set_charset($conn,"utf8");
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Bucaramanga Coordinates
    $lat = 19.016623;
    $lon = 73.096603;
        
    // Only show places within 100km
    $distance = 150;

    $lat = mysqli_real_escape_string($conn, $lat);
    $lon = mysqli_real_escape_string($conn, $lon);
    $distance = mysqli_real_escape_string($conn, $distance);

    $query = <<<EOF
    SELECT * FROM (
        SELECT *, 
            (
                (
                    (
                        acos(
                            sin(( $lat * pi() / 180))
                            *
                            sin(( `track_lat` * pi() / 180)) + cos(( $lat * pi() /180 ))
                            *
                            cos(( `track_lat` * pi() / 180)) * cos((( $lon - `track_lng`) * pi()/180)))
                    ) * 180/pi()
                ) * 60 * 1.1515 * 1.609344
            )
        as distance FROM `social_police`
    ) social_police
    WHERE distance <= $distance
    LIMIT 15;
EOF;

    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            $statement="REPLACE INTO `Social_police` (`U_id`, `track_time`, `track_lng`, `track_lat`) VALUES (?, ?, ?, ?)",
      [$id, date("Y-m-d H:i:s"), $lng, $lat]
        }



   // if($result){
     //   $no_of_sp=$result->num_rows;
    //}
    $no_of_sp=$result->num_rows;
    echo "There are $no_of_sp Social Police around you";
   }
    //if ($result->num_rows > 0) {
        // output data of each row
        //while($row = $result->fetch_assoc()) {
           // echo $row["name"] . "<br>";
       // }
   // }

    // Outputs:
    // Barrancabermeja
    // Cúcuta
    // San Gil