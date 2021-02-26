<?php
session_start();
require 'connection.php';
$R_id=$_SESSION['U_id'];
if(isset($_POST['save']))
{	 
    $phone = mysqli_real_escape_string($con, $_POST['PhoneNo']);
    $C_area = mysqli_real_escape_string($con, $_POST['Area']);
    $sql2="SELECT * FROM user WHERE Phone='$phone'";
    $results2=mysqli_query($con, $sql2);
    if($results2)
    {
        $fetch = mysqli_fetch_assoc($results2);
        $user_id = $fetch['U_id'];
        if(mysqli_num_rows($results2))
        {
            $sql = "INSERT INTO contacts (R_id,U_id,Relation,PhoneNo,Area)
            VALUES ($R_id,'$user_id','E', '$phone','$C_area')";
            if (mysqli_query($con, $sql)) 
            {
                echo "Successfully sent request";
            }
            else
            {
                echo ("Failed to add the contact due to some issue due to: ". mysqli_error($con));
            }
        }
        else
        {
            exit("The person you are trying to add as a relation is not our user, please tell the person to visit our website");
        }
    }
    
	 mysqli_close($con);
    }
?>