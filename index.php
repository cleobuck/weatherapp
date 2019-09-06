
<!DOCTYPE html>
<html lang="en">
<head>
<?php session_start (); ?>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <style>

    section {
        display: flex;
        flex-direction: column;
        align-items: center;
        margin-top: 20px;
    }
    
    form {
        display: flex;
        flex-direction: column;
        margin-top: 20px;
    }

    th {
        background-color: #829BB4;
        color: white;
     
    }

    th, td {
       padding: 20px;
    }

    tr:nth-child(even) {
    background-color: #7AC26F;
    }

    tr:nth-child(odd) {
    background-color: #EAF1F3;
    }

    input[type="submit"] {
    background-color: #829BB4;
    padding: 10px;
    border-radius: 5px;
    }

    .refresh  {
        background-color: white !important;
        font-weight: bolder;
    }
    </style>


    <title>weather app</title>


</head>
<body>

<section class="weatherlist">
<form method="post">
<table>

<tr>
    <th> <input class="refresh" type="submit" name="refresh" value="X"> </th>
    <th> Ville </th>
    <th> Maxima </th>
    <th> Minima </th>

</tr>



<?php

require 'connection.php'; 

$creation = "CREATE TABLE IF NOT EXISTS weather
    (ville varchar(9), haut int, bas int)";
$bd->exec($creation);



// on va chercher les données du formulaire pour les insérer dans la table

if( isset($_POST['submit'])) {
   
    $_POST['ville'] = filter_var($_POST['ville'], FILTER_SANITIZE_STRING);
    $_POST['ville'] = trim($_POST['ville']);

    $_POST['maxima'] = filter_var($_POST['maxima'], FILTER_SANITIZE_NUMBER_INT);
    $_POST['maxima'] = filter_var($_POST['maxima'], FILTER_VALIDATE_INT);
    $_POST['minima'] = filter_var($_POST['minima'], FILTER_SANITIZE_NUMBER_INT);
    $_POST['minima'] = filter_var($_POST['minima'], FILTER_VALIDATE_INT);


    if(!empty($_POST['ville']) && !empty($_POST['maxima']) && !empty($_POST['minima'])) {

        $sql = "INSERT INTO weather (ville, haut, bas) VALUES (?, ?, ?)";
   
        if ($_POST['ville'] != $_SESSION['previous'] ) {
            $bd->prepare($sql)->execute([ $_POST['ville'], $_POST['maxima'], $_POST['minima']]);
        }
        $_SESSION['previous'] = $_POST['ville'];
    }

   
};

if(isset($_POST['refresh'])) {

    foreach($_POST['toDelete'] as $valeur)
    {
        
      $sql2 = "DELETE FROM `weather` WHERE `ville`=?";
      $bd->prepare($sql2)->execute([$valeur]);
     
    }
    


}



// on store dans une variable une table 

$resultat = $bd->query('SELECT * FROM weather');

//convertir le sql en php

$donnees = $resultat->fetch();

// $resultat 

while ($donnees = $resultat->fetch())
{ ?>

<tr> 
<td> <input type="checkbox" name="toDelete[]" value="<?php echo $donnees['ville']; ?>"></td>
<td> <?php  echo $donnees['ville']; ?> </td>
<td> <?php  echo $donnees['haut']; ?> </td>
<td> <?php  echo $donnees['bas']; ?> </td>
</tr> 



<?php
}



$resultat->closeCursor();

?>




</table>
</form>

<form method="post"> 

<input type="text"  placeholder="ville" name="ville" size="15">
<input type="text"   placeholder="max" name="maxima" size="15">
<input type="text"   placeholder="min" name="minima" size="15">
<input type="submit" value="ok" name="submit" size="5">
 
</form>




</section>
    

</body>
</html>


