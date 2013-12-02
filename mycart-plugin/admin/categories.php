<?php include("../includes/cms-header.inc.php"); ?>
	<div class="body-content">
		<div class="wrapper clearfix">
			<div class="page-head clearfix">
				<div class="page-heading">
					<h2>Categories</h2>
				</div>
			</div>
			<h4 class="inline">Edit Categories</h4>
			
			<ol class="sortable">
				<li id="cate1">
					<div>First Category</div>
				</li>
				<li id="cate2">
					<div>Second Category</div>
					<ol>
						<li id="sub-cate1">
							<div>Sub-category</div>
						</li>
						<li id="sub-cate2">
							<div>Sub-category</div>
						</li>
					</ol>
				</li>
				<li id="cate3">
					<div>Third Category</div>
				</li>
			</ol>

			<button class="srtbl-h">Hierarchy</button>



			<!-- <form class="categories form-horizontal" role="form" method="post" action="categories.php">
				<div class="form-group">
					<label class="col-lg-2 control-label" for="inputCategory">Category 1</label>
					<div class="col-lg-4">
						<input type="text" class="form-control" placeholder="Category Name" value""/>
					</div>
					<div class="col-lg-4">
						<input type="text" class="form-control" placeholder="Category Name" value""/>
					</div>
				</div>
				<div class="form-group">
					<label class="col-lg-2 control-label">Category 2</label>
					<div class="col-lg-4">
						<input type="text" class="form-control" placeholder="Category Name" value""/>
					</div>
				</div>
				<div class="form-group">
					<label class="col-lg-2 control-label">Category 3</label>
					<div class="col-lg-4">
						<input type="text" class="form-control" placeholder="Category Name" value""/>
					</div>
				</div>
			</form> -->
		</div><!-- end wrapper -->
	</div><!-- end body-content -->
<?php include("../includes/cms-footer.inc.php"); ?>