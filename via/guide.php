<!DOCTYPE html>
<html lang="fr">
<head>
	<title>Javascript &amp; PHP</title>
	<meta charset="utf-8">
	<meta name="description" content="">
	<meta name="author" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="//fonts.googleapis.com/css?family=Raleway:400,300,600" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="inc/skeleton/normalize.css">
	<link rel="stylesheet" href="inc/skeleton/skeleton.css">
	<link rel="icon" type="image/png" href="inc/via/favicon.ico">
</head>
<body>
<div class="container">


		<div class="row">
			<div class="one-half column">
				<h4>Javascript</h4>
			</div>
			<div class="one-half column">
				<h4>PHP</h4>
			</div>
		</div>


		<div class="row">
			<div class="twelve column">
				<h5>Déclaration de variables</h5>
				Indique à l'ordinateur de réserver un espace mémoire et lui donne un nom.<br/>
				On appelle celà une « variable » car la valeur stockée dans cet espace pourra varier au cours de l'exécution du programme.
			</div>
		</div>
		<div class="row">
			<div class="one-half column">
				<code>var i;</code>
			</div>
			<div class="one-half column">
				<code>$i;</code><br/>
				On remarque que les noms de variables doivent toujours commencer par un $ en PHP.
			</div>
		</div>


		<div class="row">
			<div class="twelve column">
				<h5>Affectation d'une valeur initiale à une variable</h5>
				Et l'on remarque que le signe <code>=</code> étant consacré à l'affectation d'une valeur dans une variable, il ne pourra pas servir d'opérateur de comparaison.
			</div>
		</div>
		<div class="row">
			<div class="one-half column">
				<code>i = 0;</code>
			</div>
			<div class="one-half column">
				<code>$i = 0;</code>
			</div>
		</div>
		<div class="row">
			<div class="twelve column">
				Généralement on fera les deux en même temps :
			</div>
		</div>
		<div class="row">
			<div class="one-half column">
				<code>var i = 0;</code>
			</div>
			<div class="one-half column">
				<code>$i = 0;</code>
			</div>
		</div>

		<div class="row">
			<div class="twelve column">
				<h5>Les opérateurs</h5>
				Inutile de s'étendre sur ceux qui sont évidents tels que le <code>+</code> pour l'addition, le <code>-</code> pour la soustraction ou le négatif d'un nombre.<br/>
				Certains opérateurs sont différents de ce que l'on trouve en mathématiques tels que <code>*</code> pour la multiplication mais ils sont communs à la plupart des langages informatiques. (Aussi <code>**</code> pour la puissance ou  <code>%</code> pour le modulo (reste de la division euclidienne).)<br/>
				Exemple classique d'utilisation du modulo dans le web :<br/>
				<code>$i = 0;</code><br/>
				<code>foreach ($rows as $row) $backgroundColor = ( i++%2==0 ? 'white' : 'lightgrey' );</code>
			</div>
		</div>
		<div class="row">
			<div class="twelve column">
				Concanétation de chaînes :
			</div>
		</div>
		<div class="row">
			<div class="one-half column">
				"hello "<code>+</code>"world"
			</div>
			<div class="one-half column">
				"hello "<code>.</code>"world" (Dans tous les autres langages on utilise le +)
			</div>
		</div>
		<div class="row">
			<div class="twelve column">
				Multiplication de chaînes :<br/>
				Certains langages permettent d'écrire <code>"Bang!" * 2</code> pour obtenir <code>"Bang!Bang!"</code>
			</div>
		</div>
		<div class="row">
			<div class="one-half column">
				<pre><code>function str_repeat(chaine,nbr){
	var resultat = "";
	for(var i=0; i&lt;nbr; i++) resultat = resultat + chaine;
	return resultat;
}
</code></pre>
			</div>
			<div class="one-half column">
				<code>str_repeat("Bang!",2)</code>
			</div>
		</div>

		<div class="row">
			<div class="twelve column">
				Incrémentation et décrémentation (poste-) :
			</div>
		</div>
		<div class="row">
			<div class="one-half column">
				<code>i++</code><br/>
				<code>i--</code>
			</div>
			<div class="one-half column">
				<code>$i++</code><br/>
				<code>$i--</code>
			</div>
		</div>

		<div class="row">
			<div class="twelve column">
				Mais il existe aussi la pré-incrémentation et pré-décrémentation :
			</div>
		</div>
		<div class="row">
			<div class="one-half column">
				<code>++i</code><br/>
				<code>--i</code>
			</div>
			<div class="one-half column">
				<code>++$i</code><br/>
				<code>--$i</code>
			</div>
		</div>
		<div class="row">
			<div class="twelve column">
				i = 0;<br>
				print i++<br>
				Affiche i = 0, puis incrémente. A la ligne suivante, i = 1<br>
				i = 0;<br>
				print ++i<br>
				Incrémente, puis affiche i = 1. A la ligne suivante, i = 1
			</div>
		</div>

<br><br>
</div>
</body>
</html>
