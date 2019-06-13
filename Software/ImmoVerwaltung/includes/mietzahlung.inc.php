<?php

session_start();


if(isset($_POST['miete_submit'])){
   
    
    require 'dbh.inc.php';
    
    $betrag = $_POST['betrag'];
    $text = $_POST['text'];
    $datum = $_POST['datum'];
    
    $sql="SELECT * FROM mietverhaeltnis JOIN zahlungskonto ON mietverhaeltnis.mietverhaeltnisID=zahlungskonto.mietverhaeltnisID WHERE mietverhaeltnis.Mieter=?";
    $stmt=mysqli_stmt_init($conn);
    
    $sql2="INSERT INTO zahlungen(ZahlungsKontoID,Betrag,Text) VALUES (?,?,?)";
    $stmt2= mysqli_stmt_init($conn);
    
    
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("Location: ../mietzahlung.php?error=sqlerror1");
        exit();
    }else{
        
        $id = $_SESSION['sessionid'];
        
        mysqli_stmt_bind_param($stmt, "i", $id);
        
        mysqli_stmt_execute($stmt);
        
        $result = mysqli_stmt_get_result($stmt);
        
        if($row=mysqli_fetch_assoc($result)){
            $konto = $row['ZahlungsKontoID'];
            $saldo = $row['Saldo'];
        }
    }
    
    if(!mysqli_stmt_prepare($stmt2, $sql2)){
        header("Location: ../mietzahlung.php?error=sqlerror");
        exit();
    }else{
        
        
        
        mysqli_stmt_bind_param($stmt2, "ids", $konto,$betrag,$text);
        
        mysqli_stmt_execute($stmt2);
        
        
        
    }
    
        header("Location: ../mietzahlung.php?success");
    

}
