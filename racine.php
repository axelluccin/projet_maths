<html>
	<head>
		<title>TCM-MAT-003</title>
		<meta charset="UTF-8" />
	</head>
	<body>
<?php
include('factorisation.php');


function racinesEntiere($a3, $a2, $a1, $a0){
	$res_f = array();

	for ($x = -10; $x < 11; $x++){
		$res = ($a3 * pow($x, 3)) + ($a2 * pow($x, 2)) + ($a1 * $x) + $a0;
		if($res == 0)
			array_push($res_f, $x);
	}
	if(!empty($res_f)){
		if(count($res_f) == 1 && $a3 != 0){
			$result = factor($res_f, $a3, $a2, $a1, $a0);
			if($result[0] == $result[1] && $result[1] == $result[2])
				echo '(X - '.$result[0].')<sup>3</sup>';
		}
		elseif (count($res_f) == 1 && $a3 == 0) {
			return $res_f[0];
		}
		elseif(count($res_f) == 2){
			$re = factor($res_f, $a3, $a2, $a1, $a0);
				foreach($res_f as $i){
				if($i < 0)
					echo '(X + '.-$i.')';
				elseif ($i == 0) {
					echo 'X';
				}
				else
					echo '(X - '.$i.')';
				if($i == $re[1]['valeur'])
					echo '<sup>2<sup>';
			}
			echo'</p>';
		}
		else{
			foreach($res_f as $i){
				if($i < 0)
					echo '(X + '.-$i.')';
				else
					echo '(X - '.$i.')';
			}
			echo '<br/>Sp<sub>&real;</sub> = {'.$res_f[0].', '.$res_f[1].', '.$res_f[2].'} avec m('.$res_f[0].') = 1, m('.$res_f[1].') = 1 et m('.$res_f[2].') = 1.';
		}
		return $res_f;
	}
	else
		echo '<p>Aucune racine entière trouver entre -10 et +10!</p>';
}
?>

	</body>
</html>
