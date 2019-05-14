<?php

if(isset($_POST['signup-submit'])){
    
    require 'databasehandler.inc.php';
    
    $username = $_POST['id'];
    $email = $_POST['mail'];
    $password = $_POST['pwd'];
    $password_repeat = $_POST['pwd-repeat'];
    
}