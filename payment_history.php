<?php
session_start();
include('db_connect.php');
$username = $_SESSION['username'];
$id = $_SESSION['id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Tenant | Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <link href="https://netdna.bootstrapcdn.com/bootstrap/3.0.1/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://netdna.bootstrapcdn.com/bootstrap/3.0.1/js/bootstrap.min.js"></script>
</head>
<style>
	.on-print{
		display: none;
	}
</style>
<noscript>
	<style>
		.text-center{
			text-align:center;
		}
		.text-right{
			text-align:right;
		}
		table{
			width: 100%;
			border-collapse: collapse
		}
		tr,td,th{
			border:1px solid black;
		}
	</style>
</noscript>

<body>
<!-- Header -->
<div id="top-nav" class="navbar navbar-inverse navbar-static-top">
  <div class="container bootstrap snippets bootdey">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
          <span class="icon-toggle"></span>
      </button>
      <a class="navbar-brand" href="#">Boarding House Management System</a>
    </div>
    <div class="navbar-collapse collapse">
      <ul class="nav navbar-nav navbar-right">
        
        <li class="dropdown">
          <a class="dropdown-toggle" role="button" data-toggle="dropdown" href="#">
            <i class="glyphicon glyphicon-user"></i>  Welcome: <?php echo $username;?><span class="caret"></span></a>
          <ul id="g-account-menu" class="dropdown-menu" role="menu">
            <li><a href="#">My Profile</a></li>
            <li><a href="logout.php"><i class="glyphicon glyphicon-lock"></i> Logout</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div><!-- /container -->
</div>
<!-- /Header -->

<div class="container bootstrap snippets bootdey">
  
  <!-- upper section -->
  <div class="row">
    <div class="col-md-3">
      <!-- left -->
      <a href="dashboard_tenant.php" style="margin-left:-50px;"><strong><i class="glyphicon glyphicon-dashboard"></i> Dashboard</strong></a>
      <hr>
      <ul class="nav nav-pills nav-stacked" style="margin-left:-70px;">
       <li><a href="payment_history.php"><i class="glyphicon glyphicon-credit-card"></i> Payment History</a></li>
       <li><a href="notice.php"><i class="glyphicon glyphicon-bell"></i> Notice Board</a></li>
       <li><a href="gcash.php"><i class="glyphicon glyphicon-qrcode"></i> Gcash Pay</a></li>
        <li><a href="suggestion_tenant.php"><i class="glyphicon glyphicon-bullhorn"></i> Suggestions</a></li>
        <li><a href="logout.php"><i class="glyphicon glyphicon-log-out"></i> Logout</a></li>
      </ul>
      <hr>
      
  	</div><!-- /span-3 -->
    <div class="col-md-9">   	
      <!-- column 2 -->	
       <a href="#"><strong><i class="glyphicon glyphicon-paperclip"></i> Payment History</strong></a>     
       <hr>
       <br>
       <div class="row">
      <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Invoice #</th>
                        <th>Tenant</th>
                        <th>Address</th>
                        <th>Total Paid Amount</th>
                        <th>Date of Payment</th>
                        <th>Balance</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                            include('db_connect.php');

                                    $sql = "SELECT p.balance, p.amount, t.firstname, t.lastname, t.middlename, t.address, p.invoice, p.date_created FROM payments AS p INNER JOIN tenants AS t ON p.tenant_id = t.id WHERE t.id = '$id'";
                                    $result = mysqli_query($conn,$sql);
                                    while($row = mysqli_fetch_array($result)) {
                            ?>
                    <tr>
                        <th><?php echo $row['invoice'];?></th>
                        <td><?php echo $row['firstname'];?> <?php echo $row['middlename'];?> <?php echo $row['lastname'];?></td>
                        <td><?php echo $row['address'];?></td>
                        <td><?php echo $row['amount'];?></td>
                        <td><?php echo $row['date_created'];?></td>
                        <td><?php echo $row['balance'];?>.00</td>
                    </tr>
                    <?php }?>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
  	</div><!--/col-span-9-->
  </div><!--/row-->
  <!-- /upper section -->
</div><!--/container-->

<style type="text/css">
			                
body{margin-top:20px;}		
.order-card {
    color: #fff;
}

.bg-c-blue {
    background: linear-gradient(45deg,#4099ff,#73b4ff);
}

.bg-c-green {
    background: linear-gradient(45deg,#2ed8b6,#59e0c5);
}

.bg-c-yellow {
    background: linear-gradient(45deg,#FFB64D,#ffcb80);
}

.bg-c-pink {
    background: linear-gradient(45deg,#FF5370,#ff869a);
}


.card {
    border-radius: 5px;
    -webkit-box-shadow: 0 1px 2.94px 0.06px rgba(4,26,55,0.16);
    box-shadow: 0 1px 2.94px 0.06px rgba(4,26,55,0.16);
    border: none;
    margin-bottom: 30px;
    -webkit-transition: all 0.3s ease-in-out;
    transition: all 0.3s ease-in-out;
}

.card .card-block {
    padding: 25px;
}

.order-card i {
    font-size: 26px;
}

.f-left {
    float: left;
}

.f-right {
    float: right;
}		              
</style>
</body>
</html>