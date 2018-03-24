<ul>
	<?php
		foreach($userNavItems as $item){
			echo "<li><a href=\"$item[slug]\">$item[title]</a></li>";
		}
	?>
</ul>