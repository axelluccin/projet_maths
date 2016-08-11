

<?php
include('header.php');
			echo '<center><form name="determination" method="post" action="determination.php">';
			for($i = 0; $i < 3; $i++){
				echo '<p>';
				for($j = 0; $j < 3; $j++){
					echo '<input  type="number" style="width:50;" name="a'.$i.$j.'" required/>';
				}
				echo '</p>';
			}
			echo '<p><input class="btn btn-lg btn-primary" type="submit" style="float: right;" name="determination_submit" value="valider" /></p>
					</form></center>';
		

include('footer.php');
?>

