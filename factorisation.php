<?php

	/*
		COEFX : correspond à la puissance de X. Elle prend en valeur soit 0, 1, 2 ou 3.
		VALEUR : correspond à la valeur associé à x(si x existe bien sur ^^). Peut prendre n'importe quelle valeur.
	*/

	/* Prend en paramètre :
		- Les racines trouvées par la fonction racineEntiere($res)
		- Les différentes valeurs rentrées par l'utilisateur($a3, $a2, $a1, $a0) 
	*/ 


	function factor($res, $a3, $a2 , $a1, $a0){

		//Tableau pour x
		$ParaX = [
			"coefx" => 1, 
			"valeur" => 1
		];

		//Met les différentes valeurs rentrés par l'utilisateur dans un tableau
		$my_array[] = $a0; 
		$my_array[] = $a1;
		$my_array[] = $a2;
		$my_array[] = $a3;
		for($i = 3; $i >= 0; $i--){
			$c = [
				"coefx" => $i,
				"valeur" => $my_array[$i]
			];
			$cool[] = $c;
		}

		//Met dans un tableau les racines
		for($i = 0 ; $i < count($res); $i++){
			$Paranbr = [
				"coefx" => 0,
				"valeur" => 0 - $res[$i]
			];
			$parametre[] = $ParaX;
			$parametre[] = $Paranbr;
		}

		//si 2 racine entière trouvées
		if (count($res) == 2){

			//décomposition de la factorisation
			for($i = 0; $i < 2; $i++){
				for($j = 2; $j < 4; $j++){
					$para =  [
						"coefx" => $parametre[$i]['coefx'] + $parametre[$j]['coefx'] ,
						"valeur" => $parametre[$i]['valeur'] * $parametre[$j]['valeur']
					];
					$valeur[] = $para;
				}
			}
			//on additionne les valeurs qui ont le même x
			if($valeur[1]['coefx'] == $valeur[2]['coefx']){
				$diviseur[] = $valeur[0];
				$tmp = [
					"coefx" => $valeur[1]['coefx'],
					"valeur" => $valeur[1]['valeur'] + $valeur[2]['valeur']
				];
				$diviseur[] = $tmp;
				$diviseur[] = $valeur[3];
			}
			return my_division($cool, $diviseur);
		}
		//si une racine entière trouvé
		elseif (count($res) == 1){

			$my_resultat[] = $res[0];
			$ret1 = my_division($cool, $parametre);
			$my_resultat[] = racinesEntiere(0, $ret1[0]['valeur'], $ret1[1]['valeur'], $ret1[2]['valeur']);
			$Paranbr = [
				"coefx" => 0,
				"valeur" => 0 - $my_resultat[1],
			];
			$parametre1[] = $ParaX;
			$parametre1[] = $Paranbr;
			$ret2 = my_division($ret1, $parametre1);
			$my_resultat[] = $ret2[1]['valeur'];
			return $my_resultat;
		}
	}

	function my_division($dividende, $diviseur){
		
		//enlève les valeurs à 0
		$my_dividende = verif_tab($dividende);

		while($my_dividende[0]['coefx'] >= $diviseur[0]['coefx']){
			
			//évaluation du quotient
			$tmpquotient = [
				"coefx" => $my_dividende[0]['coefx'] - $diviseur[0]['coefx'],
				"valeur" => $my_dividende[0]['valeur']
			];
			
			//ajout dans le tableau du quotient
			$quotient[] = $tmpquotient;
			
			//le soustracteur
			for($i = 0; $i < count($diviseur); $i++){
				$tmpsoustraction = [
					"coefx" => $tmpquotient['coefx'] + $diviseur[$i]['coefx'],
					"valeur" => $tmpquotient['valeur'] * $diviseur[$i]['valeur']
				];
				$soustraction[] = $tmpsoustraction;
			}
			
			/*
				LA SOUSTRACTION
			*/
			
			//tour de boucle restant a faire 
			$div = $my_dividende[0]['coefx'];
			
			//indice pour les tableaux $my_dividende et $soustraction 
			$indice = 0;
			$j = 0;

			do{ 
				//vérifie que l'indice existe bien dans chaque tableau
				$var1 = isset($my_dividende[$indice]);
				$var2 = isset($soustraction[$j]);
				//echo '- i = '.$indice.' et j ='.$j.' <br/>';
				//verifie que le dividende et le soustracteur ont la même valeur pour x
				if($var1 && $var2){
					if(($my_dividende[$indice]['coefx'] == $div) && ($soustraction[$j]['coefx'] == $div)){
						$tmpresultat = [
							"coefx" => $my_dividende[$indice]['coefx'],
							"valeur" => $my_dividende[$indice]['valeur'] - $soustraction[$j]['valeur']
						];
						$indice++;
						$j++;
					}

					//sinon on le met pour la prochaine itération
					else{
						if ($my_dividende[$indice]['coefx'] == $div){
							$tmpresultat = $my_dividende[$indice];
							$indice++;
						}
						elseif ($soustraction[$j]['coefx'] == $div){
							$tmpresultat =[
								"coefx" => $soustraction[$j]['coefx'],
								"valeur" => 0 - $soustraction[$j]['valeur']
							] ;
							$j++;
						}
						else
							echo ' ERREUR DANS LA BOUCLE !!!!!';
					}
				}
				else{
					if ($var1 && $my_dividende[$indice]['coefx'] == $div){
						$tmpresultat = $my_dividende[$indice];
						$indice++;
					}
					elseif ($var2 && $soustraction[$j]['coefx'] == $div){
						$tmpresultat =[
							"coefx" => $soustraction[$j]['coefx'],
							"valeur" => 0 - $soustraction[$j]['valeur']
						] ;
						$j++;
					}
					else
						echo ' ERREUR DANS LA BOUCLE ';
				}
				//le reste dans le tableau résultat
				$resultat[] = $tmpresultat;
				//décrémentattion de la boucle
				$div--;
				
			}while($indice < count($my_dividende) || $j < count($soustraction)); 
			
			$my_dividende = verif_tab($resultat);
			unset($resultat);
			unset($soustraction);
		}
		return $quotient;
	}

	function verif_tab($tableau){

		for($i = 0; $i < count($tableau); $i++){
			if($tableau[$i]['valeur'] == 0)
				unset($tableau[$i]);
		}
		$tab = array_values($tableau);
		return $tab;
	}
?>