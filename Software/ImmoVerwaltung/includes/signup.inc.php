<?php

if(isset($_POST['signup-submit'])){
    
    //require datenbank verbindung
    require 'databasehandler.inc.php';
    
    //POST methoden um variablen aus Form aus signup.php zu erhalten
    $username = $_POST['id'];
    $email = $_POST['mail'];
    $password = $_POST['pwd'];
    $password_repeat = $_POST['pwd-repeat'];
    
    
    //gucken, ob variablen leer sind, wenn ja dann emptyfield error
    if(empty($username) || empty($email) || empty($password) || empty($password_repeat)){
        header("location: ../signup.php?error=emptyfields&id=".$username."&mail".$email);
        exit();
    }
    
    //Filter um zu checken ob email gueltig ist
    else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        header("location: ../signup.php?error=invalidemail&id=".$username);
        exit();
    }
    
}