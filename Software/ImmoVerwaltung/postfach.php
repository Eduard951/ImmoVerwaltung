<?php
    require "header.php";
    require "includes/dbh.inc.php";
    
    $sql_messages="SELECT * FROM nachrichten WHERE EmpfaengerID =?";
    $stmt_msg = mysqli_stmt_init($conn);
    
    if(!mysqli_stmt_prepare($stmt_msg, $sql_messages)){
        header("Location: /baumstruktur.php?error=sqlerrormessages");
        exit();
    }else{
        mysqli_stmt_bind_param($stmt_msg, "i", $_SESSION['sessionid']);
        mysqli_stmt_execute($stmt_msg);
        $result_msg = mysqli_stmt_get_result($stmt_msg);
        
        if(!empty($result_msg)){
            while($row_msg = $result_msg->fetch_assoc()){
                $content= $row_msg['Datei'];
                echo'<br><form name="blob" method="post" action="nachricht_blob.php">
                            <input type="hidden" name="id" value="'.$row_msg['NachrichtID'].'" readonly>Nachricht: '.$row_msg['Text'].'
                             Anhang: <button name="blob_submit" type="submit">Datei</button>
                            </form>';
            }
        }
    }
    
?>
	

	<main>
	
	</main>
	
<?php 
    require "footer.php";
?>
