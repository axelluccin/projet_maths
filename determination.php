<?php
	include('header.php');
	
	include('racine.php');

	if(isset($_POST['determination_submit'])){
		$retirer = array_pop($_POST);
		for($i = 0; $i < 3; $i++){
			for($j = 0; $j < 3; $j++){
				$F0[$i][$j] = $_POST['a'.$i.$j];
			}
		}

		$Identite = matriceIndentite();

		$F1 = product($F0, soustraction($F0, multiplication(trace($F0), $Identite)));

		$F2 = product($F0, soustraction($F1, multiplication((0.5 * trace($F1)), $Identite)));

		$res[] = -1; 
		$res[] = trace($F0);
		$res[] = 0.5 * trace($F1);
		$res[] = trace($F2) / 3;

		affiche_first_etape($res);
		racinesEntiere($res[0], $res[1], $res[2], $res[3]);
	}

function product($mat_a, $mat_b){
	for($i = 0; $i < 3; $i++){
		for($j = 0; $j < 3; $j++){
			$resultat[$i][$j] = 0;
			for($k = 0; $k < 3; $k++)
				$resultat[$i][$j] += $mat_a[$i][$k] * $mat_b[$k][$j];
		}
	}
  	return ($resultat);
}

function soustraction($mat_a, $mat_b){
   for ($a = 0; $a < 3; $a++){
   		for ($b = 0; $b < 3; $b++){
   			$res[$a][$b] = $mat_a[$a][$b] - $mat_b[$a][$b];
   		}
   }
  return ($res);
}

function matriceIndentite(){
	for($i = 0; $i < 3; $i++){
		for($j = 0; $j < 3; $j++){
			if($i == $j)
				$I[$i][$j] = 1;
			else
				$I[$i][$j] = 0;
		}
	}
	return ($I);
}

function multiplication($nbr, $matrice){
	for($i = 0; $i < 3; $i++){
		for($j = 0; $j < 3; $j++){
			$matrice[$i][$j] = $nbr * $matrice[$i][$j];
		}
	}
	return ($matrice);
}

function trace($mat_a){
	$resultat = 0;
  	for ($i = 0; isset($mat_a[$i][$i]); $i++)
    	$resultat += $mat_a[$i][$i];
    return ($resultat);
}

function my_affiche($val, $affiche){
	echo '<br/>'.$affiche.'<br/>';
	print_r($val);
	echo '<br/>';
}

function affiche_first_etape($res){
	$coef = 3;

	echo '<p>P<sub>A</sub>(X) = ';
	foreach($res as $t){
		if ($t > 0){
			echo '+ ';
			if($t > 1)
				echo $t;
			elseif ($t == 1 && $coef == 0) {
				echo $t;
			}
		}
		elseif ($t < 0){
			if($t < -1)
				echo $t;
			elseif ($t == -1 && $coef == 0) {
				echo $t;
			}
			else
				echo '- ';
		}
		else
			echo ' ';

		if ($coef > 1 && $t !=0){
			echo 'X<sup>'.$coef.'</sup> ';
			$coef--;
		}elseif ($coef == 1 && $t != 0){
			echo 'X ';
			$coef--;
		}
	}

	echo ' = -';
}
include('footer.php');

?>