<ul>
	<?php
		foreach($userProfile as $item){
			echo "<li><a href=\"$item[slug]\">$item[title]</a></li>";
		}
	?>
</ul>