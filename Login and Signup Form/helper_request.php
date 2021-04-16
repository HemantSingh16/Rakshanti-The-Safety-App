<?php
session_start();
require 'connection.php';
include 'skeleton211.php';
$L_id=$_SESSION['L_id'];
$U_ID=$_SESSION['U_id'];

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">


  <!-- Bootstrap CSS -->

  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <script src="https://kit.fontawesome.com/a076d05399.js"></script>
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="your_website_domain/css_root/flaticon.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;900&display=swap" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.6.2/animate.min.css" rel="stylesheet">


  <link rel = "stylesheet" 
         href = "http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
	 <link rel="stylesheet" href="sprequestpage.css">
   <link rel="stylesheet" href="skeleton211.css">
	<title>HomeRequest</title>
</head>
<body>

<?php
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


      if(isset($_POST['button4'])) { 
        $statement2="UPDATE victim_sp_relations 
        SET response_status =1
        WHERE Sp_id=$U_ID AND status= 1";
        $outcome2= mysqli_query($con, $statement2);
        if ($outcome2)
          {
              $V_id=$_POST['button4'];
              header("Location:Helper_tracker.php?R_id=$V_id");
          }
          else
          {
              echo "Something unexpected happened,please try again later";
          }

    } 

?>


<center>
  <h1>Relatives Requests</h1>
</center>

<?php
        $abc="SELECT * FROM contacts WHERE U_id=$U_ID AND status = 1 ";
        $abc_result=mysqli_query($con, $abc);
        $c=1;
        while ($row = mysqli_fetch_assoc($abc_result)) :
            ?>
            

<div class="card" style="width: 18rem;">
  <div class="card-body">
    <h5 class="card-title">
    <?php
             $userid=$row['R_id'];
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
    <h6 class="card-subtitle mb-2 text-muted">Needed Help</h6>
    <!--<p class="card-text">Location:Nerul </p>-->
    <form method="post">
    <button type="button" class="btn btn-danger" href="#">✘</button>
    <button type="submit" name="button3" value="<?=$row['R_id']?>" class="btn btn-success">✔</button>
    </form>
  </div>
</div>

       
       
       <?php
    endwhile;
      ?>

<center>
  <h1>Requests from people nearby you</h1>
</center>


<?php
        $bcd="SELECT * FROM victim_sp_relations WHERE Sp_id=$U_ID AND status = 1 ";
        $bcd_result=mysqli_query($con, $bcd);
        $e=1;
        while ($row1 = mysqli_fetch_assoc($bcd_result)) :
            ?>
            

<div class="card" style="width: 18rem;">
  <div class="card-body">
    <h5 class="card-title">
    <?php
             $userid1=$row1['Victim_id'];
             $zyx="SELECT name FROM usertable where id = (Select L_id from user where U_id = $userid1)";
             $zyx_result=mysqli_query($con, $zyx);
             if($zyx_result)
             {
                $zyxfetch = mysqli_fetch_assoc($zyx_result);
                echo  $zyxfetch['name'];
             }
             else
             {
                 echo "error";
             }
   ?>
    </h5>
    <h6 class="card-subtitle mb-2 text-muted">Needed Help</h6>
    <!--<p class="card-text">Location:Nerul </p>-->
    <form method="post">
    <button type="button" class="btn btn-danger" href="#">✘</button>
    <button type="submit" name="button4" value="<?=$row1['Victim_id']?>" class="btn btn-success">✔</button>
    </form>
  </div>
</div>

       
       
       <?php
    endwhile;
      ?>

          

<!--
<div class="card" style="width: 18rem;">
  <div class="card-body">
    <h5 class="card-title">#UserId</h5>
    <h6 class="card-subtitle mb-2 text-muted">Needed Help</h6>
    <p class="card-text">Location:Nerul </p>
    <button type="button" class="btn btn-danger" href="#">✘</button>
    <button type="button" class="btn btn-success" href="#">✔</button>
  </div>
</div>
<div class="card" style="width: 18rem;">
  <div class="card-body">
    <h5 class="card-title">#UserId</h5>
    <h6 class="card-subtitle mb-2 text-muted">Needed Help</h6>
    <p class="card-text">Location:Nerul </p>
    <button type="button" class="btn btn-danger" href="#">✘</button>
    <button type="button" class="btn btn-success" href="#">✔</button>
  </div>
</div>
<div class="card" style="width: 18rem;">
  <div class="card-body">
    <h5 class="card-title">#UserId</h5>
    <h6 class="card-subtitle mb-2 text-muted">Needed Help</h6>
    <p class="card-text">Location:Nerul </p>
    <button type="button" class="btn btn-danger" href="#">✘</button>
    <button type="button" class="btn btn-success" href="#">✔</button>
  </div>
</div>-->

</body>
</html>