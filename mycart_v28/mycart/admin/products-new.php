<?php include("../includes/cms-header.inc.php"); ?>
	<div class="body-content">
		<div class="wrapper clearfix">
			<div class="page-head clearfix">
				<div class="page-heading">
					<h2>Products</h2>
				</div>
			</div><!-- end page-head clear-fix -->
			<h4>Create New Product</h4>
			<form class="products form-horizontal" role="form" enctype="multipart/form-data" method="post" action="product-confirm.php">
				<div class="form-group">
					<label for="inputName" class="col-lg-2 control-label">Name</label>
					<div class="col-lg-4">
						<input type="text" class="form-control" id="inputName" placeholder="Product Name"/>
					</div>
				</div>
				<div class="form-group">
					<label for="inputDescription" class="col-lg-2 control-label">Description</label>
					<div class="col-lg-10">
						<textarea class="form-control" id="inputDescription" placeholder="Product Description" rows="5"></textarea>
					</div>
				</div>

				<!-- upload images -->
				<div class="form-group">
					<label for="inputFiles" class="col-lg-2 control-label">Images</label>
					<div class="col-lg-10 preview-label">
						<input type="file" name="filesToUpload[]" id="inputFiles" multiple/>
						<div id="filesInfo" class="help-block">Choose an image. <i>(png, jpg, gif)</i></div>
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
					<div class="form-group">
						<label for="inputOption1" class="col-lg-2 control-label">Option</label>
						<div class="col-lg-10">
							<input type="text" class="form-control" id="inputOption1" placeholder="Color, size, type etc" name="inputOption1"/>
							<input type="text" class="form-control" id="inputQuantity1" placeholder="Quantity" name="inputQuantity1"/>
						</div>
					</div>
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
						<button type="submit" class="btn btn-success">Create Product</button>
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