<?php
$con  = mysqli_connect("localhost","root","","bhms_db");
 if (!$con) {
    echo "Problem in database connection! Contact administrator!";
 }else{
         $sql ="SELECT COUNT(t.id) AS total, c.name FROM categories AS c INNER JOIN houses AS h ON c.id = h.category_id INNER JOIN tenants AS t ON t.house_id = h.id";
         $result = mysqli_query($con,$sql);
         $chart_data="";
         while ($row = mysqli_fetch_array($result)) { 
 
            $total[]  = $row['name'];
			$data[]  = $row['total'];
            
        }
 }
?>
<div class="container-fluid">
	<div class="col-lg-12">
		<div class="card">
			<div class="card-body">
				<div class="col-md-12">
					<div class="row">
						<div class="col-sm-4">
							<div class="card border-primary">
								<div class="card-body bg-light">
									<h4><b>Monthly Payments Report</b></h4>
								</div>
								<div class="card-footer">
									<div class="col-md-12">
										<a href="index.php?page=payment_report" class="d-flex justify-content-between"> <span>View Report</span> <span class="fa fa-chevron-circle-right"></span></a>
									</div>
								</div>
							</div>
						</div>
						<div class="col-sm-4">
							<div class="card border-primary">
								<div class="card-body bg-light">
									<h4><b>Rental Balances Report</b></h4>
								</div>
								<div class="card-footer">
									<div class="col-md-12">
										<a href="index.php?page=balance_report" class="d-flex justify-content-between"> <span>View Report</span> <span class="fa fa-chevron-circle-right"></span></a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<br>
		<!------------another report----------->
		<div class="card">
			<div class="card-body">
				<div class="col-md-12">
					<div class="row">
					<h2 class="page-header" style="margin-left:180px;color:white;color:black;">Graphical Reports for Rooms Occupied </h2>
						<div class="card mt-3" style="width:90%; margin-left:5%;">
						<div style="margin-left:5%; width:50%;text-align:center; font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif; align-items:center;" >
						<br>
						<br>
							<canvas id="chartjs_bar"></canvas> 
						</div>
						</div> 
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
		
<script src="//code.jquery.com/jquery-1.9.1.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
<script type="text/javascript">
      var ctx = document.getElementById("chartjs_bar").getContext('2d');
                var myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels:<?php echo json_encode($total); ?>,
                        datasets: [{
                            label: 'Total Boarders',
                            data: <?php echo json_encode($data);?>,
                        }]
                    },
                    options: {
                        
                        legend: {
                        display: false,
                        position: 'bottom',
 
                        labels: {
                            fontColor: '#71748d',
                            fontFamily: 'Circular Std Book',
                            fontSize: 14,
                        }
                    },
                }
                });
    </script>