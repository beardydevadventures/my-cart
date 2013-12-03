<?php 
	include("../includes/cms-header.inc.php"); 
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
			<div class="clearfix"></div>
			<form class="categories form-horizontal" role="form" method="post" action="../functions/categories.function.php">
				<div class="form-group">
					<div class="col-lg-6">
						<!-- <ol class="sortable list-unstyled">
							<li id="category_1">
								<div class="input-group">
									<span class="input-group-addon">Category</span>
									<input type="text" class="form-control" id="inputCategory1" name="inputCategory1" placeholder="Enter a category" value="Shirts"/>
								</div>
							</li>
							<li id="category_2">
								<div class="input-group">
									<span class="input-group-addon">Category</span>
									<input type="text" class="form-control" id="inputCategory2" name="inputCategory2" placeholder="Enter a category" value="Jackets"/>
								</div>
								<ol>
									<li id="category_3">
										<div class="input-group">
											<span class="input-group-addon">Sub-category</span>
											<input type="text" class="form-control" id="inputCategory3" name="inputCategory3" placeholder="Enter a category" value="Shorts"/>
										</div>
									</li>
								</ol>
							</li>
							<li id="category_4">
								<div class="input-group">
									<span class="input-group-addon">Category</span>
									<input type="text" class="form-control" id="inputCategory4" name="inputCategory4" placeholder="Enter a category" value="Jeans"/>
								</div>
							</li>
							<li id="category_5">
								<div class="input-group">
									<span class="input-group-addon">Category</span>
									<input type="text" class="form-control" id="inputCategory5" name="inputCategory5" placeholder="Enter a category" value="Misc"/>
								</div>
							</li>
						</ol>  -->
						<?php
							echo("<ol class='sortable list-unstyled'>");
							$i = 1;
							GetCategory(1, $dbh, $i);
							
							function GetCategory($parentID, $db, $i)
							{
								
								$sth = $db->query("SELECT c.id, c.description, c.parentId
										FROM category c
										WHERE c.parentId = $parentID
										ORDER BY c.description");
							
								$sth->setFetchMode(PDO::FETCH_ASSOC);
							
								while($row = $sth->fetch())
								{
									echo("<li id='category_" . $i . "'><div class='input-group'>");
									
									$chh = $db->query("SELECT COUNT(*) AS NumChilds
											FROM category c
											WHERE c.parentId = " . $row['id']);
									
									$chh->setFetchMode(PDO::FETCH_ASSOC);
									
									$result = $chh->fetch();
									
										echo('<span class="input-group-addon">');
											echo('Category');
										echo('</span>');
										echo('<input type="hidden" name="catID[]" value="' . $row["id"] . '"/>
											<input type="hidden" name="catParent[]" value="' . $row['parentId'] . '"/>');
										echo('<input type="text" class="form-control" id="inputCategory' . $i . '" name="inputCategory' . $i . '" placeholder="Enter a category" value="' . ucfirst($row['description']) . '"/>');
									echo("</div><ol>");
										GetCategory($row['id'], $db, $i);
									echo("</ol>");
									echo("</li>");
									$i++;
								}	
							}	
							echo("</ol>");
						?>
					</div><!-- end col-lg-6 -->
					<div class="col-lg-6">
						<p class="help-block">
							<i class="fa fa-info"></i> Drag the category panel up and down to <b>re-order</b> the menu.
						</p>
						<p class="help-block">
							<i class="fa fa-info"></i> Drag the category panel right to <b>create</b> a sub-menu.
						</p>
						<p class="help-block">
							<i class="fa fa-info"></i> Drag the sub-menu panel to the left to <b>undo</b> a sub-menu. (If there are multiple sub-menus, drag the panel at the bottom first).
						</p>
					</div>
				</div><!-- end form-group -->

				
				<!-- add option group -->
				<div class="form-group">
					<div class="col-lg-10">
						<button type="button" id="addCategory" class="btn btn-sm btn-primary">Add Category</button>
					</div>
				</div>		
				
				<!-- Hidden fields are entered here -->
				<div class="content"></div>
				
				<!-- submit group -->
				<div class="form-group">
					<div class="col-lg-10">
						<button type="submit" class="btn btn-success sortable-btn">Save</button>
						<a class="btn btn-default" href="categories.php">Cancel</a>
					</div>
				</div>
			</form>

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