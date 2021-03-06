<?php require_once "skeleton.html";?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="skeleton1.css">
  
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <!-- Latest compiled and minified CSS -->
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <title>Add Friends</title>
</head>
<body style='background:url("https://static.vecteezy.com/system/resources/previews/001/427/248/original/blue-watercolor-background-free-vector.jpg")'>;
<div class="container">
        <div class="row">
        <div class="col-md-6 offset-md-3 form">
    <h4 style="font-family:Akaya Kanadaka;font-size:23px;">Add Contacts who will be sent notification if they are near to you </h4>
    <br>

<form method="post" action="addCloseFriend_backend.php">
  <div class="form-group">
    <label for="phone">Phone Number</label>
    <input type="text" class="form-control" id="phone" name="PhoneNo" required>
  </div>
  
  <div class="form-group">
    <label for="AreaWhereTheyLive">Area where they live</label>
    <input type="text" class="form-control" id="AreaWhereTheyLive" name="Area" required>
  </div>
  <button type="submit" name="save" class="btn btn-primary">Save</button>
</div>
        </div>
</div>
</form>
</body>
</html>