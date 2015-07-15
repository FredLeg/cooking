<?php

class Utils {

	public static function getCamelCase($str) {
		return lcfirst(str_replace(' ', '', ucwords(str_replace('_', ' ', $str))));
	}

	public static function debug($var) {
		$type = gettype($var);
		switch ( $type ) {
		case 'array':
			echo '<pre class="prettyprint lang-php">';
			print_r($var);
			echo '</pre>';
		break;
		case 'boolean':
			echo '<pre class="prettyprint lang-php">'.$type.' {';
			echo $var ? 'true' : 'false';
			echo '}</pre>';
		break;
			echo '<pre class="prettyprint lang-php">'.$type.' {';
			echo $var;
			echo '}</pre>';
		default:
		}
	}

	/*
		Fonction qui coupe une chaine en preservant les mots
		et ajoute une chaine à la fin du texte
	*/
	public static function cutString($text, $max_length = 0, $end = '...', $sep = '[@]') {

		// Si la variable $max_length est définie, supérieure à 0
		// Et que la longueur de la chaine $text est supérieure à $ max_length
		if ($max_length > 0 && strlen($text) > $max_length) {

			// On insère une chaine dans le texte tous les X caractères sans couper les mots
			$text = wordwrap($text, $max_length, $sep, true);
			// On découpe notre chaine en plusieurs bouts répartis dans un tableau
			$text = explode($sep, $text);

			// On retour le premier element du tableau concaténé avec la chaine $end
			return $text[0].$end;
		}

		// On retourne la chaine de départ telle quelle
		return $text;
	}

}