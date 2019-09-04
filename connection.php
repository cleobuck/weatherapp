<?php

// connection 


try
{
	// On se connecte à MySQL
    $bd = new PDO('mysql:host=localhost;dbname=weatherapp;charset=utf8', 'phpmyadmin', 'user');
    
}
catch(Exception $e)
{
	// En cas d'erreur, on affiche un message et on arrête tout
        die('Erreur : '.$e->getMessage());
}


?>