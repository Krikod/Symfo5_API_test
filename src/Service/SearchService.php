<?php

namespace App\src\Service;

class SearchService {

	/**
	 * Préparation de la chaîne d'entrée pour la recherche
	 *
	 * @param $searchedModele
	 *
	 * @return mixed
	 */
	public function prepareInput($data) {
//		Supprimer les espaces superflus de la chaîne
		$output = preg_replace("#\s+#", '', $data);
//		$output = trim($output);

//		Enlever les accents, majuscules et cédilles de la chaîne
		setlocale(LC_CTYPE, 'fr_FR');
		$output = iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $output);
		$output = strtolower($output);
		return $output;
	}

//	public function subStringExtraction($searchedModele) {
////		Extraire couple mot/chiffre(s) de la chaîne (modèle à chercher si besoin), separés ou non d'un espace
//		if (preg_match("#[a-zA-z]+(\s|\S)\d+#", $searchedModele, $matches)) {
//			$search = " ";
//			$replace = "";
//			$removed_space = str_replace($search, $replace, $searchedModele);
////			$match = $this->longestString($matches);
//			return $removed_space;
//		} else {
//			$added_space = preg_replace('#([0-9]+)#', ' $1', $searchedModele);
//			return $added_space;
//		}
// elseif (preg_match("#[a-zA-zd+]+#", $searchedModele, $matches) {
//
//			$added_space = preg_replace('#([0-9]+)#', ' $1', $searchedModele);
//			dd( $added_space);
//			return $added_space;
//		}
//	}

	public function longestString($array) {
//		$mapping = array_combine($array, array_map('strlen', $array));
//		return array_keys($mapping, max($mapping));
		usort($array, function ($a, $b) {
			return strlen($a) < strlen($b);
		});
		return reset($array);
	}

	/**
	 * Comparaison modèle cherché (avec/sans espace entre chiffre et nom accolé) et modèles cibles
	 *
	 * @param $searchedModele
	 * @param $data
	 *
	 * @return mixed
	 */
	public function cas($searchedModele, $modele) {
		$search = " ";
		$replace = "";
		$removed_space = str_replace($search, $replace, $searchedModele);
		$added_space = preg_replace('#([0-9]+)#', ' $1', $searchedModele);

//		$result = true;

		switch (true) {
			case $result : strpbrk($modele, $removed_space);
			break;

			case $result : strpbrk($modele, $added_space);
			break;

			default:
				$result = false;
		}
		return $result;
//		preg_match("#\w+\s*\d+#", $searchedModele, $match);
	}


//	// Fonction enlevant les accent d'une chaîne
//	public function removeAccent($input) {
//		setlocale(LC_CTYPE, 'fr_FR');
//		$output = iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $input);
//		return $output;
//	}

// Fontction supprimant les espaces inutiles d'une chaîne
//	public function removeMoreThanOneWhiteSpace($input) {
//		$output = preg_replace("#\s\s+#", ' ', $input);
//		$output = trim($output);
//		return $output;
//	}

// Fonction extrayant un mot suivi d'un/de chiffre(s), separé(s) ou non d'un espace
//	public function extractDigitAndWordBefore($input) {
//		$output = preg_match( "#[\Sa-zA-z]+(\s|\S)\d+#", $input, $matches);
//		return $matches[0];
//	}













//foreach ($annonces as $annonce) {
//$modeles[] = $annonce->getModele();
//
//$modele = $annonce->getModele();
//var_dump( $modele);
//$lev = levenshtein($searchedModele, $modele);
//var_dump( $lev);
//	$sim = similar_text($modele, $searchedModele, $perc);
//	var_dump(  "similarity: $sim ($perc %)\n");
//	$calcul = "similarity: $sim ($perc %)\n";
//	$result[] = array($modele => $calcul);
//	$sim = similar_text($searchedModele, $modele, $perc);
//	echo "similarity: $sim ($perc %)\n";
//}

//
//
//
//if (in_array($searchedModele, $modeles)) {
//
//	$annonce = $repo->findBy(['modele' => $searchedModele]);
//	return $this->json($annonce, 200, [], ['groups' => 'search']);
//
//} else {
//
//}
//
//
//
//		$matches = array();
//		foreach($modeles as $searchedModele ) {
//			$matches[$searchedModele] = array();
//			foreach( $modeles as $compare_to ) {
//				$matches[$searchedModele][$compare_to] = levenshtein( $compare_to, $searchedModele );
//			}
//			asort( $matches[$searchedModele], SORT_NUMERIC  );
//		}
//dd( $result);


//// todo c'est une array d'Entités !!!!!!!!!!!
//for ($i = 0; $i < count($annonces[0]); $i++) {
//dd( $annonces[0]);
//			for ($m = 0; $m < count($annonces[0][$i][0]); $m++) {
//				dd($annonces[0][$i][0]);
//				for ($mo = 0; $mo < count($annonces[0][$i][$m]); $mo++) {
//					$modeles[] = $annonces[0][$i][$m][$mo];
//				}
//			}
//		}
//
//
//		return $modeles;





//			distance de levenshtein
//			pspell = oui, il faut que tu realises un traitement sur tes mots via des regexp pour donner à pspell une liste de mots valables.
//			recherche textuelle
//			Avec mySQL c'est très simple: WHERE texte LIKE "%f%r%a%i%s%e%"
//			fonctions soundex, levenshtein, similar_text et metaphone (cette dernière semble spécifique à l'anglais).
//Par contre la recherche en utilisant ces fonctions va être beaucoup plus compliquée à coder.


//		$annonce = $repo->findBy(['modele' => $searchedModele]);
//
//		if ($annonce) {
//			return $this->json($annonce, 200, [], ['groups' => 'search']);
//		} elseif {
////			 code
//	} else {
//			return $this->json( NotFoundHttpException::class, '404');
//		}




}