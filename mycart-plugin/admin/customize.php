<?php include("../includes/cms-header.inc.php"); ?>
<?php include("../includes/db.inc.php"); ?>
<?php include("../includes/colorArray.inc.php"); ?>
	<div class="body-content">
		<div class="wrapper clearfix">
			<div class="page-head clearfix">
				<div class="page-heading">
					<h2>Customize</h2>
				</div>
			</div><!-- end page-heading clear-fix -->
			<h4 class="inline">Customize MyCart</h4>

			<!-- customize general panel -->
			<form role="form" enctype="multipart/form-data" method="post" action="../functions/customize.function.php">
				<!-- customize typography panel -->
				<div class="customize panel panel-default">
					<div class="panel-heading relative" data-toggle="collapse" data-target=".collapse-panel-heading-body">Heading font, body font, and links <a class="panel-heading-right"><i class="fa fa-chevron-down"></i></a></div>
					<div class="collapse-panel-heading-body collapse">
						<div class="panel-body">
							<div class="row">
								<div class="col-lg-3">Heading font</div>
								<div class="col-lg-3">
									<select class="form-control heading-font" name="heading-font">
										<!-- <option value='' selected='selected'>Please select</option> -->
										<option value='<?php echo($colArray['heading-font']); ?>' selected='selected'><?php echo(ucfirst($colArray['heading-font'])); ?> (selected)</option>
										<option value='helvetica'>Helvetica</option>
										<option value='verdana'>Verdana</option>
										<option value='florence'>Florence</option>
										<option value='calibri'>Calibri</option>
									</select>
								</div>
								<div class="col-lg-3">Body font</div>
								<div class="col-lg-3">
									<select class="form-control body-font" name="body-font">
									<option value='<?php echo($colArray['body-font']); ?>' selected='selected'><?php echo(ucfirst($colArray['body-font'])); ?> (selected)</option>
										<option value='Avantgarde'>Avantgarde</option>
										<option value='arial'>Arial</option>
										<option value='times'>Times</option>
										<option value='calibri'>Calibri</option>
									</select>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-3">Heading color</div>
								<div class="col-lg-3 relative">
									<input type="text" class="form-control heading-color" name="heading-color" value="<?php echo($colArray['heading-color']); ?>" placeholder="Select a color"/>
									<div class="mycart-thc preview"></div>
								</div>
								<div class="col-lg-3">Body color</div>
								<div class="col-lg-3 relative">
									<input type="text" class="form-control body-color" name="body-color" value="<?php echo($colArray['body-color']); ?>" placeholder="Select a color"/>
									<div class="mycart-tbc preview"></div>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-3">Heading size</div>
								<div class="col-lg-3 relative">
									<select class="form-control heading-size" name="heading-size">
										<option value='18px' selected='selected'>18px (selected)</option>
										<option value='14px'>14px</option>
										<option value='16px'>16px</option>
										<option value='18px'>18px</option>
										<option value='20px'>20px</option>
										<option value='22px'>22px</option>
									</select>
								</div>
								<div class="col-lg-3">Body size</div>
								<div class="col-lg-3 relative">
									<select class="form-control body-size" name="body-size">
										<option value='14px' selected='selected'>14px (selected)</option>
										<option value='10px'>10px</option>
										<option value='11px'>11px</option>
										<option value='12px'>12px</option>
										<option value='14px'>14px</option>
										<option value='16px'>16px</option>
									</select>
								</div>
							</div>
						</div><!-- end container -->
						<div class="panel-body mycart panel-border-top panel-border-bottom">
							<div class="row">
								<div class="col-lg-6">
									<h4 class="mycart-heading">Heading | The five boxing wizards jump quickly</h4>
								</div>
								<div class="col-lg-6">
									<p class="mycart-body">Body | Sixty zippers were quickly picked from the woven jute bag.</p>
								</div>
							</div>
						</div>
						<div class="panel-body">
							<div class="row">
								<div class="col-lg-3">Link color</div>
								<div class="col-lg-3 relative">
									<input type="text" class="form-control link-color" name="link-color" value="#E07900" placeholder="Select a color"/>
									<div class="mycart-lc preview"></div>
								</div>
								<div class="col-lg-3"></div>
								<div class="col-lg-3 relative">
								</div>
							</div>
							<div class="row">
								<div class="col-lg-3">Link hover color</div>
								<div class="col-lg-3 relative">
									<input type="text" class="form-control link-hover-color" name="link-hover-color" value="#ED9F2B" placeholder="Select a color"/>
									<div class="mycart-lhc preview"></div>
								</div>
								<div class="col-lg-3"></div>
								<div class="col-lg-3 relative">
								</div>
							</div>
							<div class="row">
								<div class="col-lg-3">Link active color</div>
								<div class="col-lg-3 relative">
									<input type="text" class="form-control link-active-color" name="link-active-color" value="#FF4930" placeholder="Select a color"/>
									<div class="mycart-lac preview"></div>
								</div>
								<div class="col-lg-3"></div>
								<div class="col-lg-3 relative">
								</div>
							</div>
						</div><!-- end container -->
						<div class="panel-body mycart panel-border-top">
							<div class="row">
								<div class="col-lg-6">
									<p class="mycart-container">This is an <a class="mycart-link">example link</a>.</p>
								</div>
								<div class="col-lg-6">
								</div>
							</div>
						</div>
					</div>
				</div><!-- end panel -->


				<div class="customize panel panel-default">
					<div class="panel-heading relative" data-toggle="collapse" data-target=".collapse-panel-menu">Menu <a class="panel-heading-right"><i class="fa fa-chevron-down"></i></a></div>
					<div class="collapse-panel-menu collapse">
						<div class="panel-body">
							<div class="row">
								<div class="col-lg-3">Menu color</div>
								<div class="col-lg-3 relative">
									<input type="text" class="form-control menu-color" name="menu-color" value="#E67E22" placeholder="Select a color"/>
									<div class="mycart-mc preview"></div>
								</div>
								<div class="col-lg-3">Menu font color</div>
								<div class="col-lg-3 relative">
									<input type="text" class="form-control menu-font-color" name="menu-font-color" value="#FFFFFF" placeholder="Select a color"/>
									<div class="mycart-mfc preview"></div>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-3">Sub-menu color</div>
								<div class="col-lg-3 relative">
									<input type="text" class="form-control sub-menu-color" name="sub-menu-color" value="#CF2E2E" placeholder="Select a color"/>
									<div class="mycart-smc preview"></div>
								</div>
								<div class="col-lg-3">Sub-menu font color</div>
								<div class="col-lg-3 relative">
									<input type="text" class="form-control sub-menu-font-color" name="sub-menu-font-color" value="#FFFFFF" placeholder="Select a color"/>
									<div class="mycart-smfc preview"></div>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-3">Sub-menu hover color</div>
								<div class="col-lg-3 relative">
									<input type="text" class="form-control sub-menu-hover-color" name="sub-menu-hover-color" value="#0789B4" placeholder="Select a color"/>
									<div class="mycart-smhc preview"></div>
								</div>
								<div class="col-lg-3">Sub-menu font hover color</div>
								<div class="col-lg-3 relative">
									<input type="text" class="form-control sub-menu-font-hover-color" name="sub-menu-font-hover-color" value="#ff4444" placeholder="Select a color"/>
									<div class="mycart-smfhc preview"></div>
								</div>
							</div>
						</div><!-- end container -->
						<div class="panel-body panel-border-top">
							<div class="row">
								<div class="col-lg-12">
									<div class="mycart-nav clearfix">
										<ul>
											<li>
												<a>Category 1</a>
											</li>
											<li>
												<a>Category 2 <span class='fa fa-chevron-down'></i></a>
												<ul>
													<li><a>Sub-category</a></li>
													<li><a>Sub-category</a></li>
													<li><a>Sub-category</a></li>
												</ul>
											</li>
											<li>
												<a>Category 3</a>
											</li>
											<li>
												<a>Category 4 <i class='fa fa-chevron-down'></i></a>
												<ul>
													<li><a>Sub-category</a></li>
													<li><a>Sub-category</a></li>
												</ul>
											</li>
											<li>
												<a>Category 5</a>
											</li>
										</ul>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div><!-- end panel -->

				<?php /*
				<div class="customize panel panel-default">
					<div class="panel-heading">General</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-lg-3">Primary Color</div>
							<div class="col-lg-3 relative">
								<input type="text" class="form-control primary-color" name="primary-color" value="<?php echo($colArray['primary-color']); ?>" placeholder="Select a color"/>
								<div class="mask-color-1 preview"></div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-3">Secondary Color</div>
							<div class="col-lg-3 relative">
								<input type="text" class="form-control secondary-color" name="secondary-color" value="<?php echo($colArray['secondary-color']); ?>" placeholder="Select a color"/>
								<div class="mask-color-2 preview"></div>
							</div>
						</div>
					</div><!-- end container -->
					<div class="panel-body panel-border-top">
						<div class="row">
							<div class="col-lg-6 center">
								<div class="mask-color-1 demo">
									<img class="mask-my" src="../img/logo_my.png"/>
								</div>
								<div class="mask-color-2 demo">
									<img class="mask-cart" src="../img/logo_cart.png"/>
								</div>
							</div>
							<div class="col-lg-6"></div>
						</div>
					</div>
				</div><!-- end panel -->
				*/ ?>
	
				
				
				<!-- customize buttons panel -->
				<div class="customize panel panel-default">
					<div class="panel-heading relative" data-toggle="collapse" data-target=".collapse-panel-buttons">Buttons <a class="panel-heading-right"><i class="fa fa-chevron-down"></i></a></div>
					<div class="collapse-panel-buttons collapse">
						<div class="panel-body">
							<div class="row">
								<div class="col-lg-3">Button color</div>
								<div class="col-lg-3 relative">
									<input type="text" class="form-control button-color" name="button-color" value="<?php echo($colArray['button-color']); ?>" placeholder="Select a color"/>
									<div class="mycart-bc preview"></div>
								</div>
								<div class="col-lg-3">Button font color</div>
								<div class="col-lg-3 relative">
									<input type="text" class="form-control button-font-color" name="button-font-color" value="<?php echo($colArray['button-font-color']); ?>" placeholder="Select a color"/>
									<div class="mycart-bfc preview"></div>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-3">Button hover color</div>
								<div class="col-lg-3 relative">
									<input type="text" class="form-control button-hover-color" name="button-hover-color" value="<?php echo($colArray['button-hover-color']); ?>" placeholder="Select a color"/>
									<div class="mycart-bhc preview"></div>
								</div>
								<div class="col-lg-3">Button font hover color</div>
								<div class="col-lg-3 relative">
									<input type="text" class="form-control button-font-hover-color" name="button-font-hover-color" value="<?php echo($colArray['button-font-hover-color']); ?>" placeholder="Select a color"/>
									<div class="mycart-bfhc preview"></div>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-3">Button active color</div>
								<div class="col-lg-3 relative">
									<input type="text" class="form-control button-active-color" name="button-active-color" value="<?php echo($colArray['button-active-color']); ?>" placeholder="Select a color"/>
									<div class="mycart-bac preview"></div>
								</div>
								<div class="col-lg-3">Button font active color</div>
								<div class="col-lg-3 relative">
									<input type="text" class="form-control button-font-active-color" name="button-font-active-color" value="<?php echo($colArray['button-font-active-color']); ?>" placeholder="Select a color"/>
									<div class="mycart-bfac preview"></div>
								</div>
							</div>
						</div><!-- end container -->
						<div class="panel-body panel-border-top">  
							<div class="row">
								<div class="col-lg-6 center">
									<button class="mycart-button" onclick="return false;">Button</button>
								</div>
								<div class="col-lg-6 center">
									<button class="mycart-button lg" onclick="return false;">Button Large</button>
								</div>
							</div>
						</div>
					</div>
				</div><!-- end panel -->
	
				<div class='form-group'>
					<button type="submit" class="btn btn-success">Save changes</button>
					<a class="btn btn-default" href="customize.php">Cancel</a>
				</div>
			</form>
		</div><!-- end wrapper -->
	</div><!-- end body-content -->
<?php include("../includes/cms-footer.inc.php"); ?>