<?php


$sql_list_single = "SELECT * 
                    FROM benutzer 
                    JOIN mietverhaeltnis 
                    ON benutzer.BenutzerID=mietverhaeltnis.Vermieter 
                    JOIN verwaltungseinheit 
                    ON mietverhaeltnis.VerwID=verwaltungseinheit.VerwID 
                    WHERE (verwaltungseinheit.Besitzer=? AND verwaltungseinheit.VerwID=?) 
                    OR (mietverhaeltnis.Vermieter=? AND verwaltungseinheit.VerwID=?)";


$sql_insert_beschlussfaehigkeit="INSERT INTO ev_beschlussfaehigkeit(BenutzerID,BausteinID,Kommentar,Anwesend)VALUES(?,(SELECT MAX(ev_protokoll_baustein.BausteinID)FROM ev_protokoll_baustein),?,'Nein')";
$sql_insert_baustein_beschlussfaehigkeit="INSERT INTO ev_protokoll_baustein(Text,Nr,Ueberschrift, Protokoll_ID,BeschlussfkID,BeschluesseID)VALUES(?,?,?,(SELECT ev_protokoll.Protokoll_ID FROM ev_protokoll JOIN eigen_vers ON ev_protokoll.VersammlungID=eigen_vers.VersammlungID WHERE eigen_vers.ObjektID=?),1,0)";


$stmt_list_single= mysqli_stmt_init($conn);
$stmt_insert_beschlussfaehigkeit = mysqli_stmt_init($conn);
$stmt_insert_baustein_beschlussfaehigkeit = mysqli_stmt_init($conn);

if(!mysqli_stmt_prepare($stmt_insert_baustein_beschlussfaehigkeit, $sql_insert_baustein_beschlussfaehigkeit)){
    header("Location: ../versammlung_einladung.php?error=sqlerrorbaustein_beschluss");
    exit();
}else{
    
    mysqli_stmt_bind_param($stmt_insert_baustein_beschlussfaehigkeit,"sisi",$info[$u],$d,$topnames[$u],$iddd);
    mysqli_stmt_execute($stmt_insert_baustein_beschlussfaehigkeit);
}

/*
$besitzer = $row_emp['Besitzer'];
$vermieter = $row_emp['Vermieter'];

$list = array($besitzer,$vermieter);
*/
//breite der spalten
$w = array(50, 45, 45, 45);
$spalten=["Wohnungsnr./Beschreibung Eigentuemer","Anteil","Anwesend","Stimmenanteile"];

$pdf->SetFont("times","B",14);
$pdf->Cell(10,10,"TOP".$d.": "."Beschlussfaehigkeit der Versammlung",0,0);
$pdf->Ln(10);
$pdf->SetFont("times","",8);

if(!mysqli_stmt_prepare($stmt_list_single, $sql_list_single)){
    header("Location: ../versammlung_einladung.php?error=sqlerror");
    exit();
}else{
    

for($k=0;$k<count($spalten);$k++){
    $pdf->Cell($w[$k],7,$spalten[$k],1,0,'C');
}
$pdf->Ln();
/*
for($p=0;$p<count($list);$p++){
    mysqli_stmt_bind_param($stmt_list_single, "iiii",$list[$p],$objektid,$list[$p],$objektid);
    mysqli_stmt_execute($stmt_list_single);
    $result_single = mysqli_stmt_get_result($stmt_list_single);
    
   
    while($row_single = $result_single->fetch_assoc()){
    $single_nachname =$row_single['Name'];
    $single_vorname =$row_single['Vorname'];
    $single_kommi = $row_single['Kommentar'];
    $pdf->Cell($w[0],7,$single_vorname." ".$single_nachname." ".$single_kommi,1,0);
    $pdf->Ln();
        }
    
}
*/

for($v=0;$v<count($empfaenger);$v++){
    $pdf->Cell($w[0],7,$empfaenger[$v][0]." ".$empfaenger[$v][1]." ".$empfaenger[$v][2],1,0);
    $pdf->Cell($w[1],7,"",1,0);
    $pdf->Cell($w[2],7,"",1,0);
    $pdf->Cell($w[3],7,"",1,0);
    $pdf->Ln();
    
    if(!mysqli_stmt_prepare($stmt_insert_beschlussfaehigkeit, $sql_insert_beschlussfaehigkeit)){
        header("Location: ../versammlung_einladung.php?error=sqlerrorinsertbeschlussfk");
        exit();
    }else{
        $kommentar="";
        mysqli_stmt_bind_param($stmt_insert_beschlussfaehigkeit,"is",$empfaenger[$v][7],$kommentar);
        mysqli_stmt_execute($stmt_insert_beschlussfaehigkeit);
    }
    
}

$pdf->SetFont("times","I",8);
$pdf->Cell($w[0],7,"Summe:",1,0,"R");


$pdf->Ln(10);
$pdf->SetFont("times","",12);
$pdf->MultiCell(0,10,$info[$u],1);

//$beschr_eigentuemer_label= "Wohnungsnr./Beschreibung";
//$eigentuemer_label = "eigentuemer";
//$anteil_label = "Anteil";
//$anwesend_label ="Anwesend";
//$stimmenanteile_label= "Stimmenanteile";

$pdf->Ln(10);
}
