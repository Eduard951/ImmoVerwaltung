<?php

/*
$sql_insert_header="INSERT INTO ev_protokoll_header(VerwalterID,Ort,Jahr,Startzeit,Endzeit) VALUES(?,?,?,?,?);";
$stmt_insert_header = mysqli_stmt_init($conn);

if(!mysqli_stmt_prepare($stmt_insert_header,$sql)){
    header("Location: versammlung_einladung.php?error=sqlerror");
    exit();
}else{
    $noch_unklar = "noch unklar";
    mysqli_stmt_bind_param($stmt_insert_header, "issss", $id,$ort,$datum_update[0],$uhrzeit,$noch_unklar);
    mysqli_stmt_execute($stmt);
}
*/

$sql_verwalter_attribute = "SELECT * FROM verwalter JOIN benutzer ON verwalter.BenutzerID=benutzer.BenutzerID WHERE verwalter.BenutzerID=?";

$stmt_verwalter_attr = mysqli_stmt_init($conn);

if(!mysqli_stmt_prepare($stmt_verwalter_attr, $sql_verwalter_attribute)){
    header("Location: ../versammlung_einladung.php?error=sqlerror");
    exit();
}else{
    
    mysqli_stmt_bind_param($stmt_verwalter_attr, "i", $id);
    
    mysqli_stmt_execute($stmt_verwalter_attr);
    
    $result_verwalter = mysqli_stmt_get_result($stmt_verwalter_attr);
    
    if($row_verw=mysqli_fetch_assoc($result_verwalter)){
        
        $verw_name = $row_verw['Name'];
        $verw_vorname = $row_verw['Vorname'];

$pdf->AddPage();
$pdf->SetFont("times","",14);
$pdf->Cell(10,10,"Eigentuemerversammlung ".$jahr,0,0);
$pdf->Ln(10);
$pdf->SetFont("times","B",12);
$pdf->MultiCell(0,10,"Protokoll der Wohnungseigentuemerversammlung ".$jahr." der Wohnungseigentuemergemeinschaft Musterstr. 78, 38294 Musterstadt");
$pdf->Ln(5);
$pdf->SetFont("times","",12);
$pdf->Cell(10,10,"Beginn: ".$datum_update[2].".".$datum_update[1].".".$datum_update[0]." ".$uhrzeit,0,0);
$pdf->Ln(5);
$pdf->Cell(10,10,"Ort: ".$ort,0,0);
$pdf->Ln(5);
$pdf->Cell(10,10,"Ende: noch unklar",0,0);
$pdf->Ln(5);
$pdf->Cell(10,10,"Leiter: ".$verw_vorname." ".$verw_name." ,".$name,0,0);
$pdf->Ln(5);
$pdf->Cell(10,10,"Protokollfuehrer: ".$verw_vorname." ".$verw_name." ,".$name,0,0);
$pdf->Ln(5);
$pdf->Cell(10,10,"Verwaltungsbeirat: ",0,0);
$pdf->Ln(10);

for($u=0; $u<count($toptypes);$u++){
    $d=$u+1;
    $pdf->Ln(5);
    $pdf->SetFont("times","B",14);
    if($toptypes[$u]==="Freitext"){
        
        $sql_insert_freitext="INSERT INTO ev_protokoll_baustein(Text,Nr,Ueberschrift, Protokoll_ID,BeschlussfkID,BeschluesseID)VALUES(?,?,?,(SELECT ev_protokoll.Protokoll_ID FROM ev_protokoll JOIN eigen_vers ON ev_protokoll.VersammlungID=eigen_vers.VersammlungID WHERE eigen_vers.ObjektID=?),0,0)";
        $stmt_insert_freitext= mysqli_stmt_init($conn);
        
        
        if(!mysqli_stmt_prepare($stmt_insert_freitext, $sql_insert_freitext)){
            header("Location: ../versammlung_einladung.php?error=sqlerrorfreitextfeld");
            exit();
        }else{
            
            mysqli_stmt_bind_param($stmt_insert_freitext,"sisi",$info[$u],$d,$topnames[$u],$iddd);
            mysqli_stmt_execute($stmt_insert_freitext);
        
        $pdf->Cell(0, 10,"TOP ".$d." : ".$topnames[$u]);
        $pdf->Ln(10);
        $pdf->SetFont("times","",12);
        $pdf->MultiCell(0, 10,$info[$u],1);
        $pdf->Ln(10);
        }
        
    }else if($toptypes[$u]=== "Beschlussfaehigkeit der Versammlung"){
        require_once'includes/pdf_templates/versammlung_pdf/pdf_versammlung_beschlussfaehigkeit.php';
    }else if($toptypes[$u]=== "Verwaltungsberat"){
        require_once'includes/pdf_templates/versammlung_pdf/pdf_versammlung_verwaltungsberat.php';
    }
    $pdf->Ln(15);
}

$pdf-> Cell(10,10,"_________________                                     _________________");
$pdf->ln(5);
$pdf-> Cell(10,10,"Ort/Datum                                                      Protokollfuehrer");
$pdf->ln(15);
$pdf-> Cell(10,10,"_________________");
$pdf->ln(5);
$pdf->Cell(10,10,"Verwalter");
$pdf->Ln(15);
$pdf-> Cell(10,10,"_________________                                     _________________");
$pdf->ln(5);
$pdf-> Cell(10,10,"Eigentuemer 1                                                Eigentuemer 2");
$pdf->ln(10);
$pdf->Output();

   }
}



