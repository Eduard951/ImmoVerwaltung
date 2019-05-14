<?php

if(isset($_POST['login-submit'])){
    
    require 'databasehandler.inc.php';
    
    
}else{
    header("Location: ../index.php");
    exit();
}