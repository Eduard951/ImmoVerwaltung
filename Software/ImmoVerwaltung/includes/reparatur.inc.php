<?php

if(isset($_POST['reparatur_submit'])){
    
    require 'dbh.inc.php';
    
    
    $text = $_POST['text'];
    $file = $_FILES['file'];
    
    $fileName = $_FILES['file']['name']; 
    $fileTmpName = $_FILES['file']['tmp_name'];
    $fileSize = $_FILES['file']['size'];
    $fileError = $_FILES['file']['error'];
    $fileType = $_FILES['file']['type'];
    
    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));
    
    $allowed = array('jpg', 'jpeg','png', 'pdf');
    
    if(in_array($fileActualExt, $allowed)){
        if($fileError == 0){
            if($fileSize < 1000000){
                
                //INSERT befehl hier rein
                
            }else{
                echo "Datei zu gross";
            }
        }else{
            echo "Fehler"; 
        }
    }else{
        echo "Datentyp nicht unterstuetzt";
    }
    
    
    
}