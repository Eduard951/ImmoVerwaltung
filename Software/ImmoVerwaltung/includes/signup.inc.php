<?php

if(isset($_POST['signup_submit'])){
    
    //require datenbank verbindung
    require 'dbh.inc.php';
    
    //POST methoden um variablen aus Form aus signup.php zu erhalten
    $username = $_POST['benutzername'];
    $email = $_POST['mail'];
    $password = $_POST['pwd'];
    $password_repeat = $_POST['pwd_repeat'];
    
    
    //gucken, ob variablen leer sind, wenn ja dann emptyfield error
    if(empty($username) || empty($email) || empty($password) || empty($password_repeat)){
        header("Location: ../signup.php?error=emptyfields&id=".$username."&mail".$email);
        exit();
    }
    else if(!filter_var($email, FILTER_VALIDATE_EMAIL)&& !preg_match("/^[a-zA-Z0-9]*$/", $username)){
        header("Location: ../signup.php?error=invalidemailandusername");
        exit();
    }
    //Filter um zu checken ob email gueltig ist
    else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        header("Location: ../signup.php?error=invalidmail");
        exit();
    }
    //Filter um username zu checken (keine sonderzeichen etc)
    else if(!preg_match("/^[0-9]*$/", $username)){
        header("Location: ../signup.php?error=invalidusername");
        exit();
    }
    else if($password !== $password_repeat){
        header("Location: ../signup.php");
        exit();
    }
    else{
        
        $sql="SELECT BenutzerName FROM benutzer WHERE BenutzerName=?";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt,$sql)){
            header("Location: ../signup.php?error=sqlerror");
            exit();
        }else{
            mysqli_stmt_bind_param($stmt, "s", $username);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $resultcheck= mysqli_stmt_num_rows($stmt);
            if($resultcheck>0){
                header("Location: ../signup.php?error=usernametaken");
                exit();
            }
            else{
                
                $sql="INSERT INTO benutzer (BenutzerName, BenutzerEmail, BenutzerPasswort) VALUES (?, ?, ?)";
                $stmt = mysqli_stmt_init($conn);
                if(!mysqli_stmt_prepare($stmt,$sql)){
                    header("Location: ../signup.php?error=sqlerror");
                    exit();
                }else{
                    
                   // $hashed_pwd= $password_hash($password,PASSWORD_DEFAULT);
                    mysqli_stmt_bind_param($stmt, "sss", $username,$email,$password);
                    mysqli_stmt_execute($stmt);
                    
                    header("Location: ../signup.php?signup=success");
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
