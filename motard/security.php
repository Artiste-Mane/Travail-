<?php 
    session_start();
    
    //Section pour verifier si le user n'est pas authentifier avec la session users tu le renvoie dans la page login.php
    if(!isset($_SESSION['users'])){
        
        header('Location: login.php');
    }

?>