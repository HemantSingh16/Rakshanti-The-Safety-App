<?php require_once "controllerUserData.php";?>
<?php 
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

//if(isset($_POST['button1'])) { 
  //$statement2="SELECT PhoneNo FROM contacts WHERE R_id=$U_ID ";
  //$outcome2= mysqli_query($con, $statement2);
    /*$statement="UPDATE contacts
    SET status = 1
    WHERE R_id=$U_ID";*/
  //  $outcome= mysqli_query($con, $statement);
//    if ($outcome)
    //{
  //      header('Location:victim_tracking.php');
//    }
    //else
    //{
  //      echo "Something unexpected happened,please try again later";
//    }

//} 


if(isset($_POST['button1'])){
/*code in extrasms.php*/ 
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





?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


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
    
  <title>WSA home</title>
</head>
<body> 
  <div id="mySidenav" class="sidenav">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()" style="padding-top: 20px; margin-left: 30px;">&times;</a>
    <header style="padding-left: 15px;">Hello  <?php echo $name?></header>
    <a href="home.php"><i class="fa fa-th-large" style="margin-right: 10px; margin-left: 10px;"></i>Home</a>
    <a href=""><i class="fa fa-user" style="margin-right: 10px; margin-left: 10px;"></i>Profile</a>
    <a href="addRelatives.php" style="margin-right: 10px;"><i class="fas fa-address-card" aria-hidden="true" style="margin-right: 10px; margin-left: 10px;"></i>Relatives</a>
    <a href="addCloseFriends.php"><i class="fas fa-users" aria-hidden="true" style="margin: 10px; margin-left: 10px;"></i>Close friends</a>
    <a href="#"><i class="fa fa-bell" aria-hidden="true" style="margin: 10px; margin-left: 10px;"></i>Notification</a>
    <a href="#"><i class="fas fa-history" aria-hidden="true" style="margin-right: 10px; margin-left: 10px;"></i>History</a>
    <a href="#"><i class="" aria-hidden="true" style="margin-right: 10px; margin-left: 10px;"></i></a>
    <a href="logout-user.php" id="logout"> <i class="fas fa-power-off" style="margin-right: 10px; margin-left: 10px;"></i>Log out</a>
  </div>
  
    <nav class="navbar navbar-expand-lg primary_color navbar-dark" style="height:80px">
      <a class="navbar-brand" href="#"><span style="font-size:30px;cursor:pointer" onclick="openNav()"><i class="fa fa-bars" aria-hidden="true" style="margin: 10px; color:black; line-height: -100px"></i></span></a>
      <div id="overlay" onclick="closeNav()"></div> 
      <a href="NewQrScan/qrhtml.php"><i class="fa fa-qrcode fa-2x" aria-hidden="true" id="qr" style=" color: #111; float: right; line-height: 50px; padding-right:25px; padding-top:13px"></i></a>
    </nav>

<!--
    <form method="post"> 
        <input type="submit" name="button1"
                value="UNSAFE"/> 
          
        <input type="submit" name="button2"
                value="POLICE HELP"/> 
    
-->
    
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
                        <a href="POLICE.html"><img src="police.jpg" alt="No"></a>
                    </div>
                </div>
                <div class="item">
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

    </header>

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






























<!--
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><//?php echo $fetch_info['name'] ?> | Home</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
    @import url('https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap');
    nav{
        padding-left: 100px!important;
        padding-right: 100px!important;
        background: #9370db;
        font-family: 'Poppins', sans-serif;
    } 
    nav a.navbar-brand{
        color: #fff;
        font-size: 30px!important;
        font-weight: 500;
    }
    button a{
        color: #6665ee;
        font-weight: 500;
    }
    button a:hover{
        text-decoration: none;
    }
    /*h1{
        position: absolute;
        top: 50%;
        left: 50%;
        width: 100%;
        text-align: center;
        transform: translate(-50%, -50%);
        font-size: 50px;
        font-weight: 600;
    }*/
    </style>
</head>
<body>
    <nav class="navbar">
    <a class="navbar-brand" href="addCloseFriends.php">ADD Close Friends</a>
    <a class="navbar-brand" href="addRelatives.php">ADD RELATIVES</a>
    <button type="button" class="btn btn-light"><a href="logout-user.php">Logout</a></button>
    </nav>



    <h1>Welcome <//?php echo $fetch_info['name'] ?></h1>
    <form method="post"> 
        <input type="submit" name="button1"
                value="UNSAFE"/> 
          
        <input type="submit" name="button2"
                value="POLICE HELP"/> 
    </form> 



    <div style="padding:50px; margin-top:10px;">
   <table class="table table-bordered">
    <thead class="thead-dark" style="background-color: black; color: white;">
    <tr>
      <th scope="col">Sr no</th>
      <th scope="col">MESSAGE</th>
      <th scope="col">STATUS</th>
    </tr>
       </thead>


    <//?php
        $abc="SELECT * FROM contacts WHERE U_id=$U_ID AND status = 1 ";
        $abc_result=mysqli_query($con, $abc);
        $c=1;
        while ($row = mysqli_fetch_assoc($abc_result)) :
            ?>



            <tbody style="background-color: white; color: black;">
              <tr>
                <td><//?php echo $c++; ?></td>
                <td><//?php echo "User id ". $row['R_id'] . " needs your help" ?></td>     
                <td><a class="btn btn-success" href="Helper_tracker.php?R_id=<//?=$row['R_id']?>">CHECK STATUS</a></td>     
                <td><a class="btn btn-danger" >REJECT</a></td>
              </tr>
        </tbody>
       
       
       
       <//?php
    endwhile;

    
      ?>
          
</table>
 </div>
</body>
</html>-->