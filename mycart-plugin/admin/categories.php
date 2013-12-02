<?php include("../includes/cms-header.inc.php"); 
	include("../includes/db.inc.php"); 
?>
	<div class="body-content">
		<div class="wrapper clearfix">
			<div class="page-head clearfix">
				<div class="page-heading">
					<h2>Categories</h2>
				</div>
			</div>
			<h4 class="inline">Edit Categories</h4>
			
			<!-- <ol class="sortable">
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
			</ol> -->
			<?php
			echo("<ol class='sortable'>");
			GetCategory(1, $dbh);
	
			function GetCategory($parentID, $db)
			{
				
				$sth = $db->query("SELECT c.id, c.description
						FROM category c
						WHERE c.parentId = $parentID
						ORDER BY c.description");
			
				$sth->setFetchMode(PDO::FETCH_ASSOC);
			
				while($row = $sth->fetch())
				{
					echo("<li>");
					
					$chh = $db->query("SELECT COUNT(*) AS NumChilds
							FROM category c
							WHERE c.parentId = " . $row['id']);
					
					$chh->setFetchMode(PDO::FETCH_ASSOC);
					
					$result = $chh->fetch();

					// if ID has children, create arrow
					echo(ucfirst($row['description']));
					
					echo("<ol>");
					GetCategory($row['id'], $db);
					echo("</ol>");
					echo("</li>");
				}	
			}	
			echo("</ol>");
			?>
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