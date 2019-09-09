<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <style> 
    html {
        height: 100%;
    }
    body {
        background: #EAF1F3;
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }
    h1 {
        font-weight: bolder;
        color: #829BB4;
    }
    .logReg {
      background-color: ;
        display: flex;
    }
    .login {
        background-color: #829BB4;
        display: flex;
        flex-direction: column;
        padding: 20px;
        margin-right: 20px;
        border-radius: 10px;
    }
    .logout {
        background-color: #7AC26F;
        border-radius: 10px;
        padding: 20px;
        display: flex;
        flex-direction: column;
    }

    .login h2, .logout h2 {
        text-align: center;
        color: white;
        font-weight: bolder;
    }



    </style>

    <title>login</title>
    
</head>
<body>
<?php 
session_start ();

require 'connection.php'; 
// insérer les utilisateurs dans la bd

?>

<header>

<h1> MétéoApp </h1>

</header>

<section class = "logReg">



<form class="login" action="verification.php" method="post"> 

<h2> Log-in </h2>

<input type="email" placeholder="email" name="email">
<input type="password" placeholder="mot de passe" name="motdepasse">
<input type="submit" value="log-in" name="login">
</form>




<form class="logout" method="post"> 

<h2> S'inscrire </h2>

<input type="email" placeholder="email" name="emailReg">
<input type="password" placeholder="mot de passe" name="passwordReg">
<input type="password" placeholder="confirmer le mot de passe" name="confirmReg">
<input type="submit" name="signup" value="OK">

<?php

if(isset($_POST['emailReg'])) {

if ($_SESSION['emailReg'] != $_POST['emailReg']) {

    if($_POST['passwordReg'] == $_POST['confirmReg']) {
        $newUser = "INSERT INTO users (email, pass) values (?,?)";
        $bd->prepare($newUser)->execute([$_POST['emailReg'], sha1($_POST['passwordReg'])]);
        echo "<p> nouveau compte créé</p> ";
        $_SESSION['emailReg'] = $_POST['emailReg'];
        } else {
            echo "les mots de passe doivent être similaires";
        }
    }

} 

?>

</form>


</body>
</html>



