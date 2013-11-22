<?php include("../includes/cms-header.inc.php"); ?>
	<div class="body-content">
		<div class="wrapper clearfix">
			<div class="page-head clearfix">
				<div class="page-heading">
					<h2>Customize</h2>
				</div>
			</div><!-- end page-heading clear-fix -->
			<h4 class="inline">Customize MyCart</h4>

			<!-- customize general panel -->
			<div class="customize panel panel-default">
				<div class="panel-heading">General</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-lg-3">Primary Color</div>
						<div class="col-lg-3 relative">
							<input type="text" class="form-control primary-color" placeholder="Choose a color"/>
							<div class="mask-color-1 preview"></div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-3">Secondary Color</div>
						<div class="col-lg-3 relative">
							<input type="text" class="form-control secondary-color" placeholder="Choose a color"/>
							<div class="mask-color-2 preview"></div>
						</div>
					</div>
				</div><!-- end container -->
				<div class="panel-body panel-border">
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

			<!-- customize typography panel -->
			<div class="customize panel panel-default">
				<div class="panel-heading">Typography</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-lg-3">Heading Font</div>
						<div class="col-lg-3">
							<select class="form-control heading-font">
								<option value='' selected='selected'>Please select</option>
								<option value='helvetica'>Helvetica</option>
								<option value='verdana'>Verdana</option>
								<option value='florence'>Florence</option>
								<option value='calibri'>Calibri</option>
							</select>
						</div>
						<div class="col-lg-3">Body Font</div>
						<div class="col-lg-3">
							<select class="form-control body-font">
								<option value='' selected='selected'>Please select</option>
								<option value='Avantgarde'>Avantgarde</option>
								<option value='arial'>Arial</option>
								<option value='times'>Times</option>
								<option value='calibri'>Calibri</option>
							</select>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-3">Heading Color</div>
						<div class="col-lg-3 relative">
							<input type="text" class="form-control heading-color" placeholder="Choose a color"/>
							<div class="mycart-thc preview"></div>
						</div>
						<div class="col-lg-3">Body Color</div>
						<div class="col-lg-3 relative">
							<input type="text" class="form-control body-color" placeholder="Choose a color"/>
							<div class="mycart-tbc preview"></div>
						</div>
					</div>
				</div><!-- end container -->
				<div class="panel-body mycart panel-border">
					<div class="row">
						<div class="col-lg-6">
							<h4 class="mycart-heading">Heading | The five boxing wizards jump quickly</h4>
						</div>
						<div class="col-lg-6">
							<p class="mycart-body">Body | Sixty zippers were quickly picked from the woven jute bag.</p>
						</div>
					</div>
				</div>
			</div><!-- end panel -->
			
			<!-- customize buttons panel -->
			<div class="customize panel panel-default">
				<div class="panel-heading">Buttons</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-lg-3">Button color</div>
						<div class="col-lg-3 relative">
							<input type="text" class="form-control button-color" placeholder="Choose a color"/>
							<div class="mycart-bc preview"></div>
						</div>
						<div class="col-lg-3">Button font color</div>
						<div class="col-lg-3 relative">
							<input type="text" class="form-control button-font-color" placeholder="Choose a color"/>
							<div class="mycart-bfc preview"></div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-3">Button hover color</div>
						<div class="col-lg-3 relative">
							<input type="text" class="form-control button-hover-color" placeholder="Choose a color"/>
							<div class="mycart-bhc preview"></div>
						</div>
						<div class="col-lg-3">Button font hover color</div>
						<div class="col-lg-3 relative">
							<input type="text" class="form-control button-font-hover-color" placeholder="Choose a color"/>
							<div class="mycart-bfhc preview"></div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-3">Button active color</div>
						<div class="col-lg-3 relative">
							<input type="text" class="form-control button-active-color" placeholder="Choose a color"/>
							<div class="mycart-bac preview"></div>
						</div>
						<div class="col-lg-3">Button font active color</div>
						<div class="col-lg-3 relative">
							<input type="text" class="form-control button-font-active-color" placeholder="Choose a color"/>
							<div class="mycart-bfac preview"></div>
						</div>
					</div>
				</div><!-- end container -->
				<div class="panel-body panel-border">  
					<div class="row">
						<div class="col-lg-6 center">
							<button class="mycart-button">Button</button>
						</div>
						<div class="col-lg-6 center">
							<button class="mycart-button lg">Button Large</button>
						</div>
					</div>
				</div>
			</div><!-- end panel -->

			<div class='form-group'>
				<button type="submit" class="btn btn-success">Save changes</button>
				<a class="btn btn-default" href="customize.php">Cancel</a>
			</div>
		</div><!-- end wrapper -->
	</div><!-- end body-content -->
<?php include("../includes/cms-footer.inc.php"); ?>