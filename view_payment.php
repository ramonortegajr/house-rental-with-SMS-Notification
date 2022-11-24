<?php include 'db_connect.php' ?>

<?php 
$tenants =$conn->query("SELECT t.*,concat(t.lastname,', ',t.firstname,' ',t.middlename) as name,h.house_no,h.price FROM tenants t inner join houses h on h.id = t.house_id where t.id = {$_GET['id']} ");
foreach($tenants->fetch_array() as $k => $v){
	if(!is_numeric($k)){
		$$k = $v;
	}
}
$months = abs(strtotime(date('Y-m-d')." 23:59:59") - strtotime($date_in." 23:59:59"));
$months = floor(($months) / (30*60*60*24));
$payable = $price * $months;
$paid = $conn->query("SELECT SUM(amount) as paid FROM payments where tenant_id =".$_GET['id']);
$last_payment = $conn->query("SELECT * FROM payments where tenant_id =".$_GET['id']." order by unix_timestamp(date_created) desc limit 1");
$paid = $paid->num_rows > 0 ? $paid->fetch_array()['paid'] : 0;
$last_payment = $last_payment->num_rows > 0 ? date("M d, Y",strtotime($last_payment->fetch_array()['date_created'])) : 'N/A';
$outstanding = $payable - $paid;

?>
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
<div class="container-fluid">
	<div class="col-lg-12">
		<div class="row">
			<div class="col-md-4">
				<div id="details">
					<large><b>Details</b></large>
					<hr>
					<p>Tenant: <b><?php echo ucwords($name) ?></b></p>
					<p>Address: <b><?php echo ucwords($address) ?></b></p>
					<p>Guardian: <b><?php echo ucwords($parents) ?></b></p>
					<p>Guardian Contact: <b><?php echo ucwords($parents_contact) ?></b></p>
					<p>Blood Type: <b><?php echo ucwords($blood) ?></b></p>
					<p>Monthly Rental Rate: <b><?php echo number_format($price,2) ?></b></p>
					<p>Total Paid: <b><?php echo number_format($paid,2) ?></b></p>
					<p>Outstanding Balance: <b><?php echo number_format($price - $paid,2) ?></b></p>
					<p>Rent Started: <b><?php echo date("M d, Y",strtotime($date_in)) ?></b></p>
					<p>Payable Months: <b><?php echo $months ?></b></p>
				</div>
			</div>
			<div class="col-md-8">
				<large><b>Payment List</b></large>
				<br>
				<br>
		
				<br>
				<div class="row">
							<div class="col-md-12 mb-2" style="margin-left: 20px; margin-top:-30px;">
								<button class="btn btn-sm btn-block btn-success col-md-2 ml-1 float-right" type="button" id="print"><i class="fa fa-print"></i> Print</button>
								<a href="../house_rental/twilliosend/index.php"> <button class="btn btn-sm btn-block btn-primary col-md-2 ml-1 float-left" type="button"><i class="fa fa-comment"></i>Send SMS</button></a>
							</div>
				</div>
				<hr>
				<table class="table table-condensed table-striped">
					<thead>
						<tr>
							<th>Tenant</th>
							<th>Invoice</th>
							<th>Paid Amount</th>
							<th>Balance</th>
							<th>Date of Payment</th>
						</tr>
					</thead>
					<tbody>
						<?php 
						$payments = $conn->query("SELECT * FROM payments where tenant_id = $id");
						if($payments->num_rows > 0):
						while($row=$payments->fetch_assoc()):
						?>
					<tr>
						<td><?php echo ucwords($name) ?></td>
						<td><?php echo $row['invoice'] ?></td>
						<td class='text-right'><?php echo number_format($row['amount'],2) ?></td>
						<td class='text-right'><?php echo number_format($price- $paid,2) ?></td>
						<td class='text-right'><?php echo $row['date_created'] ?></td>
					</tr>
					<?php endwhile; ?>
					<?php else: ?>
					<?php endif; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

					<div id="report" style="display:none;">
						<div class="on-print">
							 <p><center>Rental Balances Report</center></p>
							 <p><center>As of <b><?php echo date('F ,Y') ?></b></center></p>
						</div>
						<div class="row">
						<table class="table table-condensed table-striped">
						<thead>
						<tr>
							<th>Tenant</th>
							<th>Invoice</th>
							<th>Paid Amount</th>
							<th>Balance</th>
							<th>Date of Payment</th>
						</tr>
					</thead>
					<tbody>
						<?php 
						$payments = $conn->query("SELECT * FROM payments where tenant_id = $id");
						if($payments->num_rows > 0):
						while($row=$payments->fetch_assoc()):
						?>
					<tr>
						<td><?php echo ucwords($name) ?></td>
						<td><?php echo $row['invoice'] ?></td>
						<td class='text-right'><?php echo number_format($row['amount'],2) ?></td>
						<td class='text-right'><?php echo number_format($price- $paid,2) ?></td>
						<td class='text-right'><?php echo $row['date_created'] ?></td>
					</tr>
								</tbody>
								</table>
								<?php endwhile; ?>
								<?php else: ?>
									<tr>
										<th colspan="9"><center>No Data.</center></th>
									</tr>
								<?php endif; ?>
								</tbody>
							</table>
						</div>
					</div>
<style>
	#details p {
		margin: unset;
		padding: unset;
		line-height: 1.3em;
	}
	td, th{
		padding: 3px !important;
	}
</style>

<script>
	$('#print').click(function(){
		var _style = $('noscript').clone()
		var _content = $('#report').clone()
		var nw = window.open("","_blank","width=800,height=700");
		nw.document.write(_style.html())
		nw.document.write(_content.html())
		nw.document.close()
		nw.print()
		setTimeout(function(){
		nw.close()
		},500)
	})
</script>