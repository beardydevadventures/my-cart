<div class="mycart-plugin-nav mycart-plugin-clearfix">
<?php  
	echo("<ul class='clearfix'>");

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
			
			if($result['NumChilds'] > 0)
			{
				// if ID has children, create arrow
				echo("<a>" . ucfirst($row['description']) ." <i class='fa fa-chevron-down'></i></a>");
			}
			else
			{
				// else create link	
				echo("<a href='products.php?id=". $row['id'] . "'>" . ucfirst($row['description']) ."</a>");
			}
			
			echo("<ul>");
			GetCategory($row['id'], $db);
			echo("</ul>");
			echo("</li>");
		}	
	}	
	echo("</ul>");
?>
</div><!-- nav-bar -->