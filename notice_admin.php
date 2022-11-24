<?php
include("db_connect.php");

if(isset($_POST['submit'])){
  $notice = $_POST['notice'];
  // Prints the day, date, month, year, time, AM or PM
  $date = date("l jS \of F Y h:i:s A") . "<br>";
  $query = "insert into notice(notice_text, date_created) values('$notice', '$date')";
  if (mysqli_query($conn, $query)) {
    echo "<h4 style='text-align:center;'>Saved Successfully</h4>";
        } else {
          echo '<script type="text/javascript">alert("Error please try again!") </script>';
        }
        mysqli_close($conn);
     }
?>

<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            Notice Board
        </div>
        <form action="" method="post">
        <div class="card-body">
            <label for="notice">Notice</label>
             <textarea name="notice" id="notice" cols="30" rows="10" class="text-jqte"></textarea>
        </div>
         <button type="submit" name="submit" style="padding: 5px; width:20%; float:right;margin-right:20px; margin-top:-30px;">Save</button>
       </form>
        <br>
        <br>
    </div>
</div>
<br>
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            Notice Board
        </div>

        <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Notice</th>
                        <th>Date Created</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                include('db_connect.php');

                $sql = "SELECT * FROM notice ORDER BY date_created DESC ";
                $result = mysqli_query($conn,$sql);
                 while($row = mysqli_fetch_array($result)) {
                ?>
                    <tr>
                        <th><?php echo $row['id'];?></th>
                        <td><?php echo $row['notice_text'];?></td>
                        <td><?php echo $row['date_created'];?></td>
                        <td class="text-center">
						<a href="delete_notice.php?id=<?php echo $row['id'];?>"><button class="btn btn-sm btn-outline-danger" type="button">Delete</button></a>
						</td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        </div>
        <br>
        <br>
    </div>
</div>
<script>
	function displayImg(input,_this) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
        	$('#cimg').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}
	$('.text-jqte').jqte();
</script>