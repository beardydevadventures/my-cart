<div class="mycart-plugin-nav mycart-plugin-clearfix" style="background-color: <?php echo($colArray['menu-color']); ?> !important; color: <?php echo($colArray['menu-font-color']); ?> !important;">
<?php  
	echo("<ul class='clearfix'>");

	GetCategory(1, $dbh, $colArray);
	
	function GetCategory($parentID, $db, $col)
	{
		
		$sth = $db->query("SELECT c.id, c.description
				FROM category c
				WHERE c.parentId = $parentID");
	
		$sth->setFetchMode(PDO::FETCH_ASSOC);
	
		while($row = $sth->fetch())
		{
			echo("<li>");
			
			$chh = $db->query("SELECT COUNT(*) AS NumChilds
					FROM category c
					WHERE c.parentId = " . $row['id']);
			
			$chh->setFetchMode(PDO::FETCH_ASSOC);
			
			$result = $chh->fetch();
			
			if($result['NumChilds'] > 0)
			{
				// if ID has children, create arrow
				echo("<a style='font-family: " . $col['heading-font'] . "!important;'>" . ucfirst($row['description']) . " <i class='fa fa-chevron-down'></i></a>");
			}
			else
			{
				// else create link	
				echo("<a class='mycart-plugin-page-link' style='font-family: " . $col['heading-font'] . "!important;font-family: " . $col['menu-font-color'] . "!important;' href='mycart-plugin/mycart-plugin-store.php?id=". $row['id'] . "'>" . ucfirst($row['description']) ."</a>");
			}
			
			echo("<ul style='background-color: " . $col['sub-menu-color'] . "!important;'>");
			GetCategory($row['id'], $db, $col);
			echo("</ul>");
			echo("</li>");
		}	
	}	
	echo("</ul>");
?>
</div><!-- nav-bar -->