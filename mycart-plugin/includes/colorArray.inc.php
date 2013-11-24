<?php 
	//creates a php array for the colors 
	$colArray = array();
	
	//gets values from database
	$sth = $dbh->query("SELECT s.name, s.value

					FROM setting s");
					
	$sth->setFetchMode(PDO::FETCH_ASSOC);
	
	while( $setting = $sth->fetch() )
	{
		$colArray[$setting['name']] = $setting['value'];
	}
	
	/* Array Values
	 * 
		'primary-color'
		'secondary-color' 
		'heading-font'
		'body-font' 
		'heading-color' 
		'body-color'
		'button-color'
		'button-font-color' 
		'button-hover-color'
		'button-font-hover-color'
		'button-active-color'
		'button-font-active-color'
	 */
	//print_r($colArray);
?>