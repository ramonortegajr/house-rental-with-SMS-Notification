<?php
include("db_connect.php");

if(isset($_POST['register'])){
  $gcash = $_POST['gcash_number'];
  $name = $_FILES['file']['name'];
  $target_dir = "upload/";
  $target_file = $target_dir . basename($_FILES["file"]["name"]);

  // Select file type
  $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

  // Valid file extensions
  $extensions_arr = array("jpg","jpeg","png","gif");

  // Check extension
  if( in_array($imageFileType,$extensions_arr) ){
     // Upload file
     if(move_uploaded_file($_FILES['file']['tmp_name'],$target_dir.$name)){
        // Insert record
        $query = "insert into gcash(gcashnumber,image) values('$gcash','".$name."')";
        if (mysqli_query($conn, $query)) {
           echo "<h4 style='text-align:center;'>Saved Successfully</h4>";
        } else {
          echo '<script type="text/javascript">alert("Error please try again!") </script>';
        }
        mysqli_close($conn);
     }
  }
}
?>

<?php
include('db_connect.php');

        $sql = "select * from gcash";
        $result = mysqli_query($conn,$sql);
        $row = mysqli_fetch_array($result);
        $gcash = $row['gcashnumber'];
        $image = $row['image'];
        $image_src = "upload/".$image;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Setup</title>
</head>
<body>

<div class="card" style="width:50%;">
			<div class="card-body" style="height:70px;">
				<div class="col-md-12">
					<div class="row">
					<h2 class="page-header" style="margin-left:50px;color:white;color:black;">Payment Setup</h2>
						<div style="margin-left:5%; width:50%;text-align:center; font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif; align-items:center;" >
						</div> 
					</div>
				</div>
			</div>
</div>

<div class="card" style="margin-top:5px; width:50%;">
			<div class="card-body" style="height:230px;">
				<div class="col-md-12">
                <form action="" method="POST" enctype='multipart/form-data'>
					<div class="row">
						<div style="margin-left:5%; width:50%;text-align:center; font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif; align-items:center;" >
                        <label for="gcash_number" style="float:left;">Gcash Number</label>
                        <input type="text" name="gcash_number" id="gcash_number" required placeholder="ex.09328xxxxxxx" class="form-control" style="height:30px;">
                          <br>
                          <input type="file" name="file">
                          <br>
                          <br>
                          <button type="submit" name="register" class="btn btn-success" style="width:40%; float:left;">Save</button>
                        </div> 
					</div>
                    </form>
				</div>
			</div>
</div>
<br>

<div>
<div class="card" style="width:50%;">
			<div class="card-body" style="height:70px;">
				<div class="col-md-12">
					<div class="row">
					<h2 class="page-header" style="margin-left:50px;color:white;color:black;">GCASH INFO</h2>
						<div style="margin-left:5%; width:50%;text-align:center; font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif; align-items:center;" >
						</div> 
					</div>
				</div>
			</div>
</div>

<div class="card" style="margin-top:5px; width:50%; height:100%;">
			<div class="card-body" style="height:230px;">
				<div class="col-md-12">
                Gcash Number : <?php echo $gcash;?>
                <br>
                <br>
                QR Code: <img src='<?php echo $image_src;?>' style="width:150px; height:150px;">
			    </div>
                <br>
                <a href="delete.php?id<?php echo $row['id'];?>"><button class="btn btn-danger">Delete</button></a>
			</div>
</div>
</div>
<br>
<br>
</body>
</html>