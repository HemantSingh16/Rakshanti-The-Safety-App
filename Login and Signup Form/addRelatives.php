

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <!-- Latest compiled and minified CSS -->
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <title>Add Relatives</title>
</head>
<body>
    <h1>Add Gauranteed Contacts</h1>
    <br>

<form method="post" action="addRelatives_backend.php">
  <div class="form-group">
    <label for="phone">Phone Number</label>
    <input type="text" class="form-control" id="phone" name="PhoneNo" required>
  </div>
  <div class="form-group">
    <label for="AreaWhereTheyLive">Area where they live</label>
    <input type="text" class="form-control" id="AreaWhereTheyLive" name="Area" required>
  </div>
  <button type="submit" name="save" class="btn btn-primary">Save</button>
</form>
</body>
</html>