<?php

if(isset($_POST['signup_submit'])){
    
    //require datenbank verbindung
    require 'dbh.inc.php';
    
    //POST methoden um variablen aus Form aus signup.php zu erhalten
    $name = $_POST['name'];
    $nachname = $_POST['nachname'];
    $email = $_POST['mail'];
    $password = $_POST['pwd'];
    $password_repeat = $_POST['pwd_repeat'];
    
    
    //gucken, ob variablen leer sind, wenn ja dann emptyfield error
    if(empty($name) || empty($nachname)|| empty($email) || empty($password) || empty($password_repeat)){
        header("Location: ../signup.php?error=emptyfields&name=".$name."&mail".$email);
        exit();
    }
   // else if(!filter_var($email, FILTER_VALIDATE_EMAIL)&& !preg_match("/^[a-zA-Z0-9]*$/", $email)){
   //     header("Location: ../signup.php?error=invalidemailandusername");
   //     exit();
   //}
   
    //Filter um zu checken ob email gueltig ist
    else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        header("Location: ../signup.php?error=invalidmail");
        exit();
    }
    //Filter um name zu checken (keine sonderzeichen/zahlen etc)
    else if(!preg_match("/^[a-zA-z]*$/", $name) || !preg_match("/^[a-zA-z]*$/", $nachname)){
        header("Location: ../signup.php?error=invalidname");
        exit();
    }
    else if($password !== $password_repeat){
        header("Location: ../signup.php");
        exit();
    }
    else{
        
        $sql="SELECT Email FROM benutzer WHERE Email=?";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt,$sql)){
            header("Location: ../signup.php?error=sqlerror");
            exit();
        }else{
            mysqli_stmt_bind_param($stmt, "s", $email);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $resultcheck= mysqli_stmt_num_rows($stmt);
            if($resultcheck>0){
                header("Location: ../signup.php?error=emailschonvergeben");
                exit();
            }
            else{
                
                $sql="INSERT INTO benutzer (Vorname, Name, Email, Passwort) VALUES (?, ?, ?,?)";
                $stmt = mysqli_stmt_init($conn);
                if(!mysqli_stmt_prepare($stmt,$sql)){
                    header("Location: ../signup.php?error=sqlerror");
                    exit();
                }else{
                    
                   // $hashed_pwd= $password_hash($password,PASSWORD_DEFAULT);
                    mysqli_stmt_bind_param($stmt, "sssS", $name,$nachname,$email,$password);
                    mysqli_stmt_execute($stmt);
                    
                    header("Location: ../index.php?signup=success");
                    exit();
                }
            }
        }
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
else{
    header("Location: ../signup.php?error=connectionerror");
    exit();
}
