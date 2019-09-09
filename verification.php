<?php
session_start ();

require 'connection.php'; 

    if (isset($_POST['disconnect'])) {

        $_SESSION['connected'] = false;
        header('location: index.php');

    } else if (isset($_POST['email']) && isset($_POST['motdepasse'])) {

        $totalUsers = $bd->query('SELECT * FROM users');
        $user = $totalUsers->fetch();
    
        $userMatch = false;
        $_SESSION['connected'] = false;
     

        while ($user = $totalUsers->fetch()) {
         
            if ($user['email'] == $_POST['email'] && $user['pass'] == sha1($_POST['motdepasse']))
            {
                $_SESSION['connected'] = true;    
                $userMatch = true;
            }
        }

        if ($userMatch == true) {
            header('location:weather.php');
        } else {
            header('location: index.php');
        }

    } else {
        header('location: index.php');
    }
?>