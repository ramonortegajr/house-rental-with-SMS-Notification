<!----Login Code----->
<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bhms_db";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
  if (isset($_POST['login'])) {
  
	extract($_POST);
	$sql = mysqli_query($conn,"SELECT * FROM tenants WHERE username = '$username' AND password='$password' AND type = '2'");
	$row  = mysqli_fetch_array($sql);
	if(is_array($row) && $row['type'] == '2')
	{
    $_SESSION["id"] =  $row['id'];
	  $_SESSION["username"] =  $row['username'];
	  $_SESSION['password'] = $row['password'];
 
	  header("Location: dashboard_tenant.php"); 
	}
	else {
	  echo "<script type'text/javascript'>alert('Invalid credentials please try again!')</script>";
	}
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Tenant | Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <link href="https://netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
</head>
<body>
<!--login modal-->
<div id="loginModal" class="modal show" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" style="width:30%;">
  <div class="modal-content">
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h1 class="text-center">Login</h1>
      </div>
      <div class="modal-body">
          <form class="form col-md-12 center-block" method="POST">
            <div class="form-group">
              <input type="text" name="username" class="form-control input-lg" placeholder="Username">
            </div>
            <div class="form-group">
              <input type="password" name="password" class="form-control input-lg" placeholder="Password">
            </div>
            <div class="form-group">
              <button class="btn btn-primary btn-lg btn-block" type="submit" name="login">Sign In</button>
            </div>
          </form>
      </div>
      <div class="modal-footer">
         
      </div>
  </div>
  </div>
</div>

<style type="text/css">
                
body{margin-top:20px;}              
.modal-footer {   border-top: 0px; }
</style>

<script type="text/javascript">

</script>
</body>
</html>