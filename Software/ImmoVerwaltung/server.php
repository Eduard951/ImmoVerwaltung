<?php
$conn = mysqli_connect("localhost", "admin", "asdf1234", "immoverwaltung");
//$db_servername = "localhost";
//$db_username = "admin";
//$db_password = "asdf1234";

$benutzername = "";
$mail = "";
$errors = array();

// Create connection
// $conn = new mysqli($db_servername, $db_username, $db_password);



if (isset($_POST['signup_submit'])) {
    $benutzername = mysqli_real_escape_string($conn, $_POST['benutzername']);
    $mail = mysqli_real_escape_string($conn, $_POST['mail']);
    $pwd = mysqli_real_escape_string($conn, $_POST['pwd']);
    $pwd_repeat = mysqli_real_escape_string($conn, $_POST['pwd_repeat']);
    
    //prüfen, ob alle Formularfelder ausgefüllt wurden
    if (empty($benutzername)) {
        array_push($errors,"Benutzername ist erforderlich");
    }
    if (empty($mail)) {
        array_push($errors,"E-Mail ist erforderlich");
    }
    if (empty($pwd)) {
        array_push($errors,"Passwort ist erforderlich");
    }
    
    if ($pwd != $pwd_repeat) {
        array_push($errors, "Die beiden Passwörter stimmen nicht überein");
    }
    
    //Wenn keine Fehler vorhanden sind, schreibe den Nutzer in die Datenbank
    if (count($errors) == 0) {
        $nutzer_passwort = md5($pwd); //Passwort verschlüsseln
        $statement = $conn->prepare("INSERT INTO benutzer (BenutzerName, BenutzerEmail, BenutzerPasswort) VALUES (?, ?, ?)");
        $statement->bind_Param("iss", $benutzername,$mail,$nutzer_passwort);
        
        //$statement->bind_Param(2, $email);
        //$statement->bind_Param(2, $passwort);
        
        //$name = $benutzername;
        //$email = $mail;
        //$passwort = $nutzer_passwort;
        $statement->execute();
        
        //$sql = "INSERT INTO benutzer (BenutzerName, BenutzerEmail, BenutzerPasswort) VALUES ('$benutzername', '$mail', '$nutzer_passwort')";
        //mysqli_query($conn, $sql);
    }
}


// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";
?>