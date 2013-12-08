<?php include("../includes/cms-header.inc.php"); 
	$oid = isset($_GET['id']) ? $_GET['id'] : header("Location: ../admin/orders.php");
?>
	<div class="body-content">
		<div class="wrapper clearfix">
			<div class="page-head clearfix">
				<div class="page-heading">
					<h2>Orders</h2>
				</div>
			</div>
			<h4>View Order</h4>
			<div class="panel panel-default">
				<div class="panel-heading">Order Details</div>
				<table class="orders table no-hover">
					<thead>
						<tr>
							<td>Order Number</td>
							<td>Date Ordered</td>
							<td>Customer</td>
							<td>Order Status</td>
							<td>Total Cost</td>
						</tr>
					</thead>
					<tbody>
						<?php 
							include('../includes/db.inc.php');
								
							$order = $dbh->query("SELECT o.id, o.dateTimeOrdered, o.dateTimeSent, o.deliveryAddr, c.fname, c.lname, c.email
														FROM `order` o, customer c
														WHERE o.customerId = c.id
														AND o.id = '$oid'");
								
							$order->setFetchMode(PDO::FETCH_ASSOC);
								
							$oItem = $order->fetch();
							
							//used for getting prices
							$dateOrdered = $oItem['dateTimeOrdered']; 
							$customerEmail = $oItem['email'];
							$customerName = $oItem['fname'] . " " . $oItem['lname'];

							echo("<tr>");
							echo('<td>#' . str_pad($oItem['id'] , 6, '0', STR_PAD_LEFT) . "</td>");
							echo("<td>" . date("d F, Y", strtotime($oItem['dateTimeOrdered'])) . "</td>");
							echo("<td>" . $oItem['fname'] . " ". $oItem['lname'] . "</td>");
							echo("<td>");
							if($oItem['dateTimeSent'] == Null)
							{
								echo('<span class="label label-danger">Undispatched</span>');
							}
							else
							{
								echo('<span class="label label-success">Dispatched</span>');
							}
							echo("</td>");
						
							$products = $dbh->query("SELECT id, name, description, cost, quantity, dateTime
		
									FROM (
										SELECT p.id, p.name, pv.description, po.quantity, pc.cost, pc.dateTime
										FROM product p, product_order po, product_cost pc, product_variation pv
										WHERE po.orderId = '$oid'
										AND po.productId = p.id
										AND po.productVarId = pv.id
										AND po.productId = pc.productId
										AND pc.dateTime <= '$dateOrdered'
										ORDER BY pc.dateTime DESC 
									) product
			
									GROUP BY product.id
									ORDER BY product.dateTime DESC");
						
									$products->setFetchMode(PDO::FETCH_ASSOC);
						
									$runningTotal = 0;
						
							while($product = $products->fetch())
							{
							$runningTotal += $product['cost'] * $product['quantity'];
							}
						
							echo("<td>$$runningTotal</td>");
							echo("</tr>");
						?>
					</tbody>
				</table>
			</div><!-- end panel -->
			

			<div class="panel panel-default">
				<div class="panel-heading">Order Products</div>
				<table class="orders table no-hover">
					<thead>
						<tr>
							<td>Product</td>
							<td>Option</td>
							<td>Quantity</td>
							<td>Sub Total</td>
						</tr>
					</thead>
					<tbody>
						<?php 

						$products = $dbh->query("SELECT id, name, description, cost, quantity, dateTime
		
									FROM (
										SELECT p.id, p.name, pv.description, po.quantity, pc.cost, pc.dateTime
										FROM product p, product_order po, product_cost pc, product_variation pv
										WHERE po.orderId = '$oid'
										AND po.productId = p.id
										AND po.productVarId = pv.id
										AND po.productId = pc.productId
										AND pc.dateTime <= '$dateOrdered'
										ORDER BY pc.dateTime DESC
									) product
			
									GROUP BY product.id
									ORDER BY product.dateTime DESC");

						$products->setFetchMode(PDO::FETCH_ASSOC);
				
						$runningTotal = 0;

						while($product = $products->fetch())
						{
							
							echo("<tr>");
							echo('<td>' . $product['name'] . "</td>");
							echo("<td>" . $product['description'] . "</td>");
							echo("<td>" . $product['quantity'] . "</td>");
							echo("<td>$" . $product['cost'] . "</td>");
							echo("</tr>");
						}
						?>
					</tbody>
				</table>
			</div><!-- end panel -->

			<div class="panel panel-primary pull-left">
				<div class="panel-heading">Order Shipping Address</div>
				<div class="panel-body">
					<?php echo($oItem['deliveryAddr']); ?>
				</div>
			</div><!-- end panel -->
			<?php 
			if($oItem['dateTimeSent'] == Null)
			{
			?>
			<div class="panel panel-danger pull-left dispatch-notice" style="margin-left: 20px;">
				<div class="panel-heading">Dispatch Order</div>
				<div class="panel-body min-height">
					<a class="btn btn-danger" data-toggle="modal" href="#dispatchOrderModal"><i class="fa fa-exclamation"></i> Dispatch</a>
				</div>
			</div>
			<?php 
			}
			else
			{
			?>
			<div class="panel panel-success pull-left dispatch-success" style="margin-left: 20px;">
				<div class="panel-heading">Order Dispatched</div>
				<div class="panel-body min-height">
					<button class="btn btn-success disabled"><i class="fa fa-check"></i> Dispatched</button><br />
					<span class="label label-success text-center"><?php echo(date("d F, Y", strtotime($oItem['dateTimeSent'])));?></span>
				</div>
			</div>
			<?php 
			}
			?>
			<div class="clearfix"></div>

			<!-- modal for dispatch message -->
			<div class="modal fade" id="dispatchOrderModal" tabindex="1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
							<h4 class="modal-title">Dispatch Order #<?= str_pad($oItem['id'] , 6, '0', STR_PAD_LEFT) ?></h4>
						</div>
						<div class="modal-body">
							<p>Would you like to dispatch <b>Order #<?= str_pad($oItem['id'] , 6, '0', STR_PAD_LEFT) ?>?</b></p>
							<p>The customers details are below:</p>
							<p>Name: <?= $customerName ?></p>
							<p>Email: <a href="mailto:<?= $customerEmail ?>"><?= $customerEmail ?></a></p>
						</div>
						<div class="modal-footer">
							<a href="../functions/dispatch.function.php?id=<?php echo($oItem['id']);?>"><button id="btn-dispatch" class="btn btn-lg btn-success"><i class="fa fa-check"></i> Dispatch</button></a>
							<button class="btn btn-lg btn-default" data-dismiss="modal"><i class="fa fa-minus-circle"></i> Cancel</button>
						</div>
					</div><!-- end modal-content -->
				</div><!-- end modal-dialog -->
			</div><!-- end modal -->

		</div><!-- end wrapper -->
	</div><!-- end body-content -->
	<script>
	// Create New Product Page -- 
	function fileSelect(e){
		if(window.File && window.FileReader && window.FileList && window.Blob){
			// document.getElementById("inputFiles").onchange = function(){
			// 	var xhr = new XMLHttpRequest();
			// 	xhr.onreadystatechange = function(e){
			// 		document.getElementById("filesInfo").innerHTML = "Upload Complete!";
			// 	};
			// 	xhr.open("POST", "new-confirm.php", true);
			// 	var files = document.getElementById("inputFiles").files;
			// 	var data = new FormData();
			// 	for(var i = 0; i < files.length; i++) data.append("file" + i, files[i]);
			// 	xhr.send(data);
			// };

			var files = e.target.files;
			var file;
			var result = "";

			for(var i = 0; file = files[i]; i++)
			{
				if(!file.type.match(/gif|png|jpg|jpeg/)) {
					result = "<span class='text-danger'>Please choose an image: <i>(png, jpg, gif)</i></span>";
					document.getElementById("inputFiles").value = "";
					continue;
				}
				else
				{
					reader = new FileReader();
					reader.onload = (function (tFile) {
						return function (e) {
							var div = document.createElement("div");
							div.innerHTML = "<img src='" + e.target.result + "'/><p> " + tFile.name + " <b>" + (tFile.size / 1024).toPrecision(3) + "kb</b></p>";
							document.getElementById('filesInfo').appendChild(div);
						};
					}(file));
					reader.readAsDataURL(file);
				}
			}
			document.getElementById("filesInfo").innerHTML = result;
		} else {
			alert("Your browser does not fully support 'file uploads'. Please use another browser.");
		}
	}

	// function fileSelectDrag(e) {
	// 	e.stopPropagation();
	// 	e.preventDefault();
	// 	if(window.File && window.FileReader && window.FileList && window.Blob){
	// 		var files = e.dataTransfer.files;
	// 		var file;
	// 		var result = "";

	// 		for(var i = 0; file = files[i]; i++)
	// 		{
	// 			if(!file.type.match(/gif|png|jpg|jpeg/)) {
	// 				result = "<span class='text-danger'>Please choose an image: <i>(png, jpg, gif)</i></span>";
	// 				document.getElementById("inputFiles").value = "";
	// 				continue;
	// 			}
	// 			else
	// 			{
	// 				reader = new FileReader();
	// 				reader.onload = (function (tFile) {
	// 					return function (e) {
	// 						var div = document.createElement("div");
	// 						div.innerHTML = "<img src='" + e.target.result + "'/><p> " + tFile.name + " <b>" + (tFile.size / 1024).toPrecision(3) + "kb</b></p>";
	// 						document.getElementById('filesInfo').appendChild(div);
	// 					};
	// 				}(file));
	// 				reader.readAsDataURL(file);
	// 			}
	// 		}
	// 		document.getElementById("filesInfo").innerHTML = result;
	// 	} else {
	// 		alert("Your browser does not fully support 'file uploads'. Please use another browser.");
	// 	}
	// }

	// function dragOver(e) {
	// 	e.stopPropagation();
	// 	e.preventDefault();
	// 	e.dataTransfer.dropEffect = "copy";
	// }

	document.getElementById('inputFiles').addEventListener('change', fileSelect, false);

	var dropTarget = document.getElementById("dropTarget");
	dropTarget.addEventListener("dragover", dragOver, false);
	dropTarget.addEventListener("drop", fileSelectDrag, false);
	</script>
<?php include("../includes/cms-footer.inc.php"); ?>