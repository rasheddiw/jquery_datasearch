<?php 

$connect = mysqli_connect("localhost","root","","mydb");

$query = "SELECT * FROM tbl_order ORDER BY order_id desc";

$result = mysqli_query($connect, $query);

?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Date Search Ex.</title>



	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
</head>
<body>

	<br><br>

	<div class="container" style="width: 900px;">
		<h2 align="center">Date Input Search</h2>

		<h3 align="center">Order Dates</h3><br>
		<div class="col-md-3">
			<input type="text" name="from_date" id="from_date" class="form-control" placeholder="From Date">
		</div>
		<div class="col-md-3">
			<input type="text" name="to_date" id="to_date" class="form-control" placeholder="To Date">
		</div>

		<div class="col-md-5">
			<input type="button" name="filter" id="filter" value="Search" class="btn btn-info">
		</div>

		<div style="clear: both;"></div>
		<br>
		<div id="order_table">
			<table class="table table-bordered">
				<tr>
					<th width="5%">ID</th>
					<th width="30%">Customer Name</th>
					<th width="43%">Item</th>
					<th width="10%">Value</th>
					<th width="12%">Order Date</th>
				</tr>

				<?php 

					while($row = mysqli_fetch_array($result))
					{
				?>
				<tr>
					<td><?php echo $row["order_id"]; ?></td>
					<td><?php echo $row["order_customer_name"]; ?></td>
					<td><?php echo $row["order_item"]; ?></td>
					<td><?php echo $row["order_value"]; ?></td>
					<td><?php echo $row["order_date"]; ?></td>
				</tr>

				<?php 

					}

				?>
			</table>
		</div>
	</div>


<script type="text/javascript">
	$(document).ready(function(){

		$.datepicker.setDefaults({

			dateFormat: 'yy-mm-dd'
		});

		$(function(){

			$("#from_date").datepicker();
			$("#to_date").datepicker();
		});

		$("#filter").click(function(){

			var from_date = $('#from_date').val();
			var to_date = $('#to_date').val();

			if(from_date != '' && to_date != '')
			{
				$.ajax({

					url: "filter.php", 
					method: "POST",
					data: {from_date:from_date, to_date:to_date},

					success:function(data)
					{
						$('#order_table').html(data);
					}
				});
			}

			else
			{
				alert("Please Select Date");
			}
		});
	});
</script>
</body>
</html>

