<?php

// connection 


try
{
	// On se connecte à MySQL
    $bd = new PDO('mysql:host=eu-cdbr-west-02.cleardb.net;dbname=heroku_13669c3d17eed1b;charset=utf8', 'b8355276f895fc', 'd7ae0ad2');
    
}
catch(Exception $e)
{
	// En cas d'erreur, on affiche un message et on arrête tout
        die('Erreur : '.$e->getMessage());
}




?>

