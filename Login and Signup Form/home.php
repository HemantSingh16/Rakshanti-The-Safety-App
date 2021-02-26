<?php require_once "controllerUserData.php"; ?>
<?php 
$Login_id=$_SESSION['L_id'];
$sql3="SELECT * FROM user WHERE L_id='$Login_id'";
$result3 = mysqli_query($con, $sql3);
$fetch3 = mysqli_fetch_assoc($result3);
$U_ID = $fetch3['U_id'];
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

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $fetch_info['name'] ?> | Home</title>
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

<?php
      
        if(isset($_POST['button1'])) { 
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
    ?>

    <h1>Welcome <?php echo $fetch_info['name'] ?></h1>
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