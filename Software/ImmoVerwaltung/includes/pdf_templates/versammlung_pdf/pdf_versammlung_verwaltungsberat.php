<?php

$sql_insert_baustein_verwaltungsberat="INSERT INTO ev_protokoll_baustein(Text,Nr,Ueberschrift, Protokoll_ID,BeschlussfkID,BeschluesseID)VALUES(?,?,?,(SELECT ev_protokoll.Protokoll_ID FROM ev_protokoll JOIN eigen_vers ON ev_protokoll.VersammlungID=eigen_vers.VersammlungID WHERE eigen_vers.ObjektID=?),0,1);";
$sql_insert_ev_beschluesse = "INSERT INTO ev_beschluesse(BausteinID,Text,Abst_Typ,Regel)VALUES ((SELECT MAX(ev_protokoll_baustein.BausteinID)FROM ev_protokoll_baustein),?,?,?)";

$stmt_insert_baustein_verwaltungsberat= mysqli_stmt_init($conn);
$stmt_insert_ev_beschluesse= mysqli_stmt_init($conn);

if(!mysqli_stmt_prepare($stmt_insert_baustein_verwaltungsberat, $sql_insert_baustein_verwaltungsberat)){
    header("Location: ../versammlung_einladung.php?error=sqlerrorbaustein_verwaltungsberat");
    exit();
}else{
    
    mysqli_stmt_bind_param($stmt_insert_baustein_verwaltungsberat,"sisi",$info[$u],$d,$topnames[$u],$iddd);
    mysqli_stmt_execute($stmt_insert_baustein_verwaltungsberat);
}

if(!mysqli_stmt_prepare($stmt_insert_ev_beschluesse, $sql_insert_ev_beschluesse)){
    header("Location: ../versammlung_einladung.php?error=sqlerrorbeschluesse");
    exit();
}else{
    $text= $info[$u];
    $abst_regel="";
    $regel="";
    mysqli_stmt_bind_param($stmt_insert_ev_beschluesse,"sss",$text,$abst_regel,$regel);
    mysqli_stmt_execute($stmt_insert_ev_beschluesse);
}

//breite der spalten
$width = array(45, 45, 45, 45);
$height = array(15,7,7,15);
$header=["Beschluss", "Abstimmung", "Beschlussregel","Abstimmungsergebnis"];

$pdf->SetFont("times","B",14);
$pdf->Cell(10,10,"TOP".$d.": "."Verwaltungsberat",0,0);
$pdf->Ln(10);
$pdf->SetFont("times","",12);

for($y=0;$y<count($header);$y++){
    $pdf->Cell($width[$y],$height[$y],$header[$y],1,0,'C');
    $pdf->MultiCell(145,$height[$y],"",1);
    //$pdf->Ln();
}
$pdf->Ln(5);
$pdf->SetFont("times","",12);
$pdf->MultiCell(0,10,$info[$u],1);


$pdf->Ln(20);

