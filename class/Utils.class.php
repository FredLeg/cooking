<?php
class Utils {

	public static function getCamelCase($str) {
		return lcfirst(str_replace(' ', '', ucwords(str_replace('_', ' ', $str))));
	}

	public static function cutString($text, $max_length = 0, $end = '...') {
		// Si le paramètre $max_length est fourni
		if ($max_length > 0 && strlen($text) > $max_length) {
			// Insère un caractère | tous les X caractères
			$text = wordwrap($text, $max_length, '|', true);
			// On découpe la chaine sur le séparateur | et on réparti les bouts dans un tableau
			$text = explode('|', $text);
			// On renvoie le premier élément du tableau en concaténant le paramètre $end à la fin
			return $text[0].$end;
		}
		// Si le paramètre $max_length n'est pas fourni on retourne la chaine telle quelle
		return $text;
	}

}