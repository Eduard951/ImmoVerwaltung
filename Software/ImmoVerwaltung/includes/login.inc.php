<?php

if(isset($_POST['login-submit'])){
    
    require 'dbh.inc.php';
    
    //POST methoden um variablen aus Form aus header.php zu erhalten
    $username = $_POST['userid'];
    $pwd = $_POST['pwd'];
    
    //gucken, ob variablen leer sind, wenn ja dann emptyfield error
    if(empty($username) || empty($pwd)){
        header("Location: ../index.php?error=emptyfields");
        exit();
    }else{
        $sql = "SELECT * FROM benutzer WHERE BenutzerName=?;";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: ../index.php?error=sqlerror");
            exit();
        }else{
            mysqli_stmt_bind_param($stmt, "s", $username);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            
            if($row=mysqli_fetch_assoc($result)){
                
                if($pwd==$row['BenutzerPasswort']){
                    session_start();
                    $_SESSION['sessionname'] = $row['BenutzerName'];
                    
                    header("Location: ../baumstruktur.php?login=success");
                    exit();
                    
                }else{
                    header("Location: ../index.php");
                    exit();
                }
                
            }else{
                header("Location: ../index.php?error=nouser");
                exit();
            }
        }
    }
    
}else{
    header("Location: ../index.php");
    exit();
}