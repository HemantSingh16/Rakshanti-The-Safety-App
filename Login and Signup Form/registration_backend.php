<?php
session_start();
require 'connection.php';
$L_id=$_SESSION['L_id'];
if(isset($_POST['save']))
{	 
    $phone = mysqli_real_escape_string($con, $_POST['PhoneNo']);
    $Gender = mysqli_real_escape_string($con, $_POST['Gender']);
    $U_Address = mysqli_real_escape_string($con, $_POST['Address']);
    $U_City = mysqli_real_escape_string($con, $_POST['City']);
    $U_State = mysqli_real_escape_string($con, $_POST['State']);
    $U_Zip = mysqli_real_escape_string($con, $_POST['Zip']);
	 $sql = "INSERT INTO user (L_id,Phone,Gender,U_Address,U_City,U_State,U_Zip)
	 VALUES ($L_id, '$phone','$Gender','$U_Address','$U_City','$U_State','$U_Zip')";
	 if (mysqli_query($con, $sql)) {
		$sql1="UPDATE usertable
        SET RegistrationStatus = 1
        WHERE id=$L_id";
        $results=mysqli_query($con, $sql1);
        if($results){
            header('location: home.php');
        }
        else
        {
            echo "Failed to complete the Registration";
        }
	 } else {
		echo "Error: " . $sql . "
" . mysqli_error($con);
	 }
	 mysqli_close($con);
    }
?>