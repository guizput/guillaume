<?php

// Connexion à une base de données

try
{
	$bdd = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '');
}
catch (Exception $e)
{
        die('Erreur : ' . $e->getMessage());
}


//REQUETES SIMPLES

// Faire une requete simple

$reponse = $bdd->query('SELECT * FROM jeux_video');

// Afficher cette requete

$donnees = $reponse->fetch();
// A la fin du fetch, il faut fermer la lecture
$reponse->closeCursor();


//REQUETES PREPAREES

// Faire une requete préparée
$req = $bdd->prepare('SELECT nom FROM jeux_video WHERE possesseur = ?');

// Exécuter la requete préparée
$req->execute(array($_GET['possesseur'], $_GET['prix_max']));

echo '<ul>';
while ($donnees = $req->fetch())
{
	echo '<li>' . $donnees['nom'] . ' (' . $donnees['prix'] . ' EUR)</li>';
}
echo '</ul>';

$req->closeCursor();


