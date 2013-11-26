<?php 
	include("../includes/cms-header.inc.php"); 
	$id = isset($_GET['id']) ? $_GET['id'] : null;
?>
	<div class="body-content">
		<div class="wrapper clearfix">
			<div class="page-head clearfix">
				<div class="page-heading">
					<h2>Products</h2>
				</div>
			</div><!-- end page-head clear-fix -->
			<?php 
				
				if($id != NULL)
				{ 
					echo("<h4>Edit Product</h4>");
				} 
				else
				{ 
					echo("<h4>Create Product</h4>");
				}
								
				require('../includes/db.inc.php');
				
				/*$sth = $dbh->query("SELECT p.id AS Product, p.name, p.image, p.description, c.id, c.parentId, pc.productId, pc.categoryId, pp.productId, pp.dateTime, pp.cost
					FROM product p, category c, product_category pc, product_cost pp
					WHERE p.id = pc.productId
					AND c.id = pc.categoryId
					AND p.id = pp.productId
					AND p.id = '$id'");*/
				
				$sth = $dbh->query("SELECT id, name, image, description, cost, image, dateTime, categoryId
		
								FROM (
								SELECT p.id, p.name, p.image, pp.cost, pp.dateTime, p.description, pc.categoryId
								FROM product p, category c, product_category pc, product_cost pp
								WHERE p.id = pc.productId
								AND c.id = pc.categoryId
								AND p.archive = 1
								AND p.id = pp.productId
								AND p.id = '$id'
								ORDER BY pp.dateTime DESC
								) product
		
								GROUP BY product.id
								ORDER BY product.dateTime DESC");
				
				$sth->setFetchMode(PDO::FETCH_ASSOC);
				
				$product = $sth->fetch();
			?>
			<form class="products form-horizontal" role="form" enctype="multipart/form-data" method="post" action="../functions/create.function.php">
				<input type="hidden" name="inputid" value="<?php echo($id); ?>">
				<div class="form-group">
					<label for="inputName" class="col-lg-2 control-label">Name</label>
					<div class="col-lg-4">
						<input type="text" class="form-control" id="inputName" name="inputName" placeholder="Product Name" value="<?php echo($product['name']);?>"/>
					</div>
				</div>
				<div class="form-group">
					<label for="inputCategory" class="col-lg-2 control-label">Category</label>
					<div class="col-lg-4">
						<select type="text" class="form-control" id="inputCategory" name="inputCategory"/>
							<option value="#">Select a category</option>
							<?php 
								$catId = $product['categoryId'];
								
								GetCategory(1, $dbh, $catId);
								
								function GetCategory($parentID, $db, $cat)
								{
									
									$cth = $db->query("SELECT c.id, c.description
											FROM category c
											WHERE c.parentId = $parentID
											ORDER BY c.description");
								
									$cth->setFetchMode(PDO::FETCH_ASSOC);
								
									while($row = $cth->fetch())
									{										
										$chh = $db->query("SELECT COUNT(*) AS NumChilds
												FROM category c
												WHERE c.parentId = " . $row['id']);
										
										$chh->setFetchMode(PDO::FETCH_ASSOC);
										
										$result = $chh->fetch();
										
										if($result['NumChilds'] <= 0)
										{
											echo('<option value="'. $row['id'] . '" ');
											if($row['id'] == $cat)
											{
												echo('selected');
											}
											echo('>' . ucwords(strtolower($row['description'])) );
											if($row['id'] == $cat)
											{
												echo(' (selected)');
											}
											echo('</option>');
										}

										GetCategory($row['id'], $db, $cat);

									}
									
								}
							?>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label for="inputPrice" class="col-lg-2 control-label">Price</label>
					<div class="col-lg-4">
						<div class="input-group">
							<span class="input-group-addon"><i class="icon-dollar"></i></span>
							<input type="text" class="form-control" id="inputPrice" name="inputPrice" placeholder="Product Price" value="<?php echo($product['cost']);?>"/>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label for="inputDescription" class="col-lg-2 control-label">Description</label>
					<div class="col-lg-10">
						<textarea class="form-control" id="inputDescription" name="inputDescription" placeholder="Product Description" rows="5"><?php echo($product['description']);?></textarea>
					</div>
				</div>
				
				<!-- upload images -->
				<div class="form-group">
					<label for="inputFiles" class="col-lg-2 control-label">Images</label>
					<div class="col-lg-10 preview-label">
						<input type="file" name="fileToUpload" id="inputFiles" value="<?php echo($product['image']);?>"/>
						<div id="filesInfo" class="help-block">
							<div>
								<?php 
									if($id != NULL)
									{ 
										echo("<img src='../" . $product['image'] . "'/>");
									} 
								?>
							</div>
						</div>
					</div>
				</div>

				<!-- options -->
				<div class="form-selecting">
					<div class="form-group">
						<label class="col-lg-2 control-label"></label>
						<div class="col-lg-10">
							<p class="help-block">
								<i class="icon-info"></i> Enter options to be displayed separated by a comma, then enter the quantity of this option.
							</p>
						</div>
					</div>
					
					<?php					
					require('../includes/db.inc.php');
					
					$sth = $dbh->query("SELECT pv.id, pv.description, pv.quantity
						FROM product p, product_variation pv
						WHERE p.id = pv.productId
						AND p.id = '$id'");
		
					$sth->setFetchMode(PDO::FETCH_ASSOC);
					
					while($var = $sth->fetch())
					{
					?>
					<div class="form-group">
						<label for="inputOption1" class="col-lg-2 control-label">Option
						<?php 
						if($var['quantity'] <= 0 )
						{
							echo( '<span class="label label-danger" style="opacity: .7;">Out of Stock</span>' );
						}
						elseif($var['quantity'] > 0 && $var['quantity'] <= 5)
						{
							echo( '<span class="label label-warning" style="opacity: .7;">Low</span>' );
						}
						?>
						</label>
						<div class="col-lg-10">
							<input type="text" class="form-control" id="inputOption" placeholder="Color, size, type etc" name="inputOption[]" value="<?php echo($var['description']);?>"/>
							<input type="text" class="form-control" id="inputQuantity" placeholder="Quantity" name="inputQuantity[]" value="<?php echo($var['quantity']);?>"/>
							<input type="hidden" name="inputId[]" value="<?php echo($var['id']); ?>">
							<div class="col-lg-1"><fontAwesome class="icon-remove"></fontAwesome></div>
						</div>
					</div>
					<?php 
					}
					?>
				</div>

				<!-- add option group -->
				<div class="form-group">
					<label class="col-lg-2 control-label"></label>
					<div class="col-lg-10">
						<button type="button" id="addOption" class="btn btn-sm btn-primary">Add Option</button>
					</div>
				</div>				

				<!-- submit group -->
				<div class="form-group">
					<label class="col-lg-2"></label>
					<div class="col-lg-10">
						<button type="submit" class="btn btn-success">
						<?php 	
							if($id != NULL)
							{ 
								echo("Update Product");
							} 
							else
							{ 
								echo("Create Product");
							}
						?>
						</button>
						<a class="btn btn-default" href="products.php">Cancel</a>
					</div>
				</div>
			</form>
		</div><!-- end wrapper -->
	</div><!-- end body-content -->
	<script>
	// Upload Images
	function fileSelect(e){
		if(window.File && window.FileReader && window.FileList && window.Blob){
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

	document.getElementById('inputFiles').addEventListener('change', fileSelect, false);
	</script>
<?php include("../includes/cms-footer.inc.php"); ?>