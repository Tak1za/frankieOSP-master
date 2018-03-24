<ul>
	<?php
		foreach($userEditNavItems as $item){
			echo "<li><a href=\"$item[slug]\">$item[title]</a></li>";
		}
	?>
</ul>