<?php



$sql1 = "SELECT * FROM benutzer WHERE BenutzerID=?;";
$stmt1 = mysqli_stmt_init($conn);
if(!mysqli_stmt_prepare($stmt1, $sql1)){
    header("Location: ../index.php?error=sqlerror");
    exit();
}else{
    $id = $_SESSION['sessionid'];
    mysqli_stmt_bind_param($stmt1, "i", $id);
    mysqli_stmt_execute($stmt1);
    $result1 = mysqli_stmt_get_result($stmt1);
    if($row1=mysqli_fetch_assoc($result1)){
        
        $vorname = $row1['Vorname'];
        $nachname = $row1['Name'];
        
       
        $pdf->AddPage();
        $pdf->SetFont("times","",12);
        
        $pdf->Cell(10,10,$name,0,0);
        $pdf->Ln(5);
        $pdf->Cell(10,10,"Telefon: ".$telefon,0,0);
        $pdf->Ln(5);
        $pdf->Cell(10,10,"Fax: ".$fax,0,0);
        $pdf->Ln(5);
        $pdf->Cell(10,10,$strasse." ".$hausnr,0,0);
        $pdf->Image("../images/icon.png",150,10,50,50);
        $pdf->Ln(5);
        $pdf->Cell(10,10,$plz." ".$stadt,0,0);
        $pdf->Ln(10);
        
        $pdf->SetFont("times","B",12);
        $pdf->MultiCell(0,10,"Vollmacht zur Eigentuemerversammlung 2019 
        der 
        Wohnungseigentuemergemeinschaft ".$objekt_plz." ".$objekt_ort." ".$objekt_strasse." ".$objekt_nr,0,"C");
        $pdf->SetFont("times","",12);
        $pdf->Ln(10);
        $pdf->Cell(10,10,"Hiermit uebertrage(n) ich/wir: ");
        $pdf->Ln(10);
        $pdf->Cell(10,10,$emp_vorname." ".$emp_nachname);
        $pdf->Ln(5);
        $pdf->Cell(10,10,$emp_strasse." ".$emp_hausnr);
        $pdf->Ln(5);
        $pdf->Cell(10,10,$emp_plz." ".$emp_ort);
        
        $pdf->Ln(15);
        $pdf->SetFont("times","",11);
        $pdf->Cell(10,10,"Meine/Unsere Vollmacht zur Versammlung am ".$datum_update[2].".".$datum_update[1].".".$datum_update[0]);
        $pdf->Ln(10);
        $pdf->Cell(10,10,"o an Herrn/Frau_______________________________");
        $pdf->Ln(6);
        $pdf->Cell(10,10,"o an den Versammlungsleiter");
        $pdf->Ln(15);
        $pdf->MultiCell(0,5,"o Ich/Wir ermaechtige(n) die/den Bevollmaechtigte(n) saemtliche Abstimmungen vorbehaltlos nach ihrem/seinem Ermessen vorzunehmen.");
        $pdf->Ln(5);
        if(!empty($topnames)){
            $pdf->Cell(10,10,"_________________________________________________________________________________________________");
            $pdf->Ln(10);
            $pdf->MultiCell(0,5,"o Ich/Wir erteile(n) der/dem Bevollmaechtigte(n) Stimmenanweisungen fuer die angefuehrten Tagesordnungspunkte, wie folgt:");
            
            for($i=0; $i<count($topnames);$i++){
                $j=$i+1;
                $pdf->Ln(10);
                $pdf->SetFont("times","B",11);
                $pdf->Cell(0, 10,"TOP ".$j." : ".$topnames[$i]);
                $pdf->Ln(10);
                $pdf->SetFont("times","",11);
                $pdf->Cell(0,10,"o Ja       | o Nein        | o Enthaltung          | o nach ihrem/seinen Ermessen",1,0);
            }
        }
        $pdf->SetFont("times","",11);
        $pdf->Ln(10);
        $pdf->Cell(10,10,"Diese Vollmacht ist nicht uebertragbar, eine Unterbevollmaechtigung ist erlaubt.");
        $pdf->Ln(8);
        $pdf->MultiCell(0, 10,"Bitte beachten Sie auch Vorgaben zur Bevollmaechtigung, die ggf. in Teilungserklaerungen notiert sind.");
        
        $pdf->Ln(10);
        $pdf->Cell(10,10,"___________________________________");
        $pdf->Ln(5);
        $pdf->Cell(10,10,"Ort, Datum");
        
        
        
    }
}