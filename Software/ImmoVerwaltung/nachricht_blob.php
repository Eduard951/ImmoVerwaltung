<?php
    require "includes/dbh.inc.php";
    
    if(isset($_POST['blob_submit'])){
        $id = $_POST['id'];
        
        $sql="SELECT * FROM nachrichten WHERE NachrichtID = ?";
        $stmt= mysqli_stmt_init($conn);
        
        
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: /baumstruktur.php?error=sqlerrormessages");
            exit();
        }else{
            mysqli_stmt_bind_param($stmt, "i", $id);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            if(!empty($result)){
                $row = mysqli_fetch_assoc($result);
                $content = $row['Datei'];
        
        header('Content-Type: application/pdf');
        //header("Content-Length: ".strlen(content));
        //header('Accept-Ranges: bytes');
        //header('Content-Transfer-Encoding: binary');
        //header('Content-Disposition: attachment; filename=pdf_file.pdf');
        echo $content;
            }
        }
        
    }
    
    
?>
