<?php

if(isset($_POST['nka_submit'])){
    
    $heizkosten = $_POST['heizkosten'];
    $muell_gesamt = $_POST['muell_gesamt'];
    $aufzug_gesamt = $_POST['aufzug_gesamt'];
    $eigentum_gesamt = $_POST['anteil_gesamt'];
    $verwalter_gesamt = $_POST['verwalter_gesamt'];
    $indiv_gesamt = $_POST['indiv_gesamt'];
    
    $header_array=[$muell_gesamt,$aufzug_gesamt,$eigentum_gesamt,$verwalter_gesamt,$indiv_gesamt];
    
    $muell_key = $_POST['schluessel_muell'];
    $aufzug_key = $_POST['schluessel_aufzug'];
    $eigentum_key = $_POST['schluessel_anteil'];
    $verwalter_key = $_POST['schluessel_verwalter'];
    $indiv_key = $_POST['schluessel_indiv'];
    
    $vs_muell = $_POST['vs_muell'];
    $vs_aufzug = $_POST['vs_aufzug'];
    $vs_eigentum = $_POST['vs_anteil'];
    $vs_verwalter = $_POST['vs_verwalter'];
    $vs_indiv = $_POST['vs_indiv'];
    $wohnung_keys = array();
    for($e=0;$e<count($vs_muell);$e++){
        $wohnung = [$vs_muell[$e],$vs_aufzug[$e],$vs_eigentum[$e],$vs_verwalter[$e],$vs_indiv[$e]];
        array_push($wohnung_keys, $wohnung);
    }
    
    
    $kosten_muell = $_POST['muellabfuhr_kosten_gesamt'];
    $kosten_reinigung = $_POST['reinigung_kosten_gesamt'];
    $kosten_versicherung = $_POST['versicherung_kosten_gesamt'];
    $kosten_haft = $_POST['haftpflicht_kosten_gesamt'];
    $kosten_hausmeister = $_POST['hausmeister_kosten_gesamt'];
    $kosten_treppenhaus = $_POST['treppenhaus_kosten_gesamt'];
    $kosten_sonstige = $_POST['sonstige_kosten_gesamt'];
    $kosten_wartung = $_POST['aufzugwartung_kosten_gesamt'];
    $kosten_strom = $_POST['strom_kosten_gesamt'];
    $kosten_heiz = $_POST['heiz_kosten_gesamt'];
    
    $array_gesamtkosten = [$kosten_muell,$kosten_reinigung,$kosten_versicherung,$kosten_haft,$kosten_hausmeister,$kosten_treppenhaus,$kosten_sonstige,$kosten_wartung,$kosten_strom,$kosten_heiz];
    
    $summe =0;
    
    for($v=0;$v<count($array_gesamtkosten);$v++){
        $summe+= $array_gesamtkosten[$v];
    }
    
    
    $kosten_muell_key = $_POST['muellabfuhr_kosten_gesamt_key'];
    $kosten_reinigung_key  = $_POST['reinigung_kosten_gesamt_key'];
    $kosten_versicherung_key  = $_POST['versicherung_kosten_gesamt_key'];
    $kosten_haft_key  = $_POST['haftpflicht_kosten_gesamt_key'];
    $kosten_hausmeister_key  = $_POST['hausmeister_kosten_gesamt_key'];
    $kosten_treppenhaus_key  = $_POST['treppenhaus_kosten_gesamt_key'];
    $kosten_sonstige_key  = $_POST['sonstige_kosten_gesamt_key'];
    $kosten_wartung_key  = $_POST['aufzugwartung_kosten_gesamt_key'];
    $kosten_strom_key  = $_POST['strom_kosten_gesamt_key'];
    $kosten_heiz_key  = $_POST['heiz_kosten_gesamt_key'];
    
    $array_kosten_keys = [$kosten_muell_key,$kosten_reinigung_key,$kosten_versicherung_key,$kosten_haft_key,$kosten_hausmeister_key,$kosten_treppenhaus_key,$kosten_sonstige_key,$kosten_wartung_key,$kosten_strom_key,$kosten_heiz_key];
    
    $wohngeld = $_POST['wohngeld'];
    $wohngeld_gesamt=$_POST['wohngeld_gesamt'];
    $wohnungen = $_POST['wohnungen'];
    
    $spalten=["Art","Gesamt","Verteilungsschluessel"];
    $w = 35;
    foreach ($wohnungen as $value){
        array_push($spalten, "Wohnung: ".$value);
    }
    
    require './pdf_templates/basic_pdf/pdf_start.php';
    
    $pdf->ln(10);
    $pdf->Cell(10,10,"Nebenkostenabrechnung",0,0);
    $pdf->ln(10);
    $pdf->SetFont("times","B",8);
    for($k=0;$k<count($spalten);$k++){
        $pdf->Cell($w,5,$spalten[$k],1,0,'C');
    }
    $pdf->Ln();
    $pdf->SetFont("times","",8);
    
    $header_types=["Muellabfuhr","Aufzugskosten","Eigentumsanteil","Verwaltergebuehr","Individuelle Abrechnung"];
    $vs_schluessel_types=["A","B","C","D","E"];
    
    for($r=0;$r<count($header_array);$r++){
    $pdf->Cell($w,5,$header_types[$r],1,0);
    $pdf->Cell($w,5,$header_array[$r],1,0);
    $pdf->Cell($w,5,$vs_schluessel_types[$r],1,0);
    for($q=0;$q<count($wohnung_keys);$q++){
    $pdf->Cell($w,5,$wohnung_keys[$q][$r],1,0);
    }
    $pdf->Ln();
    
    }
    $pdf->SetFont("times","B",8);
    $pdf->Cell($w,5,"Kosten",1,0);
    $pdf->SetFont("times","",8);
    $pdf->Ln();
    
    $werte = array();
    
    $ueberschriften = ["Muellabfuhr","Strassenreinigungsgebuehr","Gebaeudeversicherung","Haftpflichtversicherung","Hausmeister","Treppenhausreinigung","Sonstige Bewirtschaftungsk.","Wartung, TUEV Aufzug","Allgemeinstrom","Heizkosten"];
    for($r=0;$r<count($ueberschriften);$r++){
    $pdf->Cell($w,5,$ueberschriften[$r],1,0);
    $pdf->Cell($w,5,$array_gesamtkosten[$r],1,0);
    $pdf->Cell($w,5,$array_kosten_keys[$r],1,0);
    $wohnungswert=0;
    for($q=0;$q<count($wohnung_keys);$q++){
        
        if($array_kosten_keys[$r]==="A"){
            $wert= ($array_gesamtkosten[$r]/$header_array[0])*$wohnung_keys[$q][0];
            $wohnungswert+=$wert;
            $pdf->Cell($w,5,round($wert,2),1,0);
        }else if($array_kosten_keys[$r]==="B"){
            $wert= ($array_gesamtkosten[$r]/$header_array[1])*$wohnung_keys[$q][1];
            $wohnungswert+=$wert;
            $pdf->Cell($w,5,round($wert,2),1,0);
        }else if($array_kosten_keys[$r]==="C"){
            $wert= ($array_gesamtkosten[$r]/$header_array[2])*$wohnung_keys[$q][2];
            $wohnungswert+=$wert;
            $pdf->Cell($w,5,round($wert,2),1,0);
        }else if($array_kosten_keys[$r]==="D"){
            $wert= ($array_gesamtkosten[$r]/$header_array[3])*$wohnung_keys[$q][3];
            $wohnungswert+=$wert;
            $pdf->Cell($w,5,round($wert,2),1,0);
        }else if($array_kosten_keys[$r]==="E"){
            $pdf->Cell($w,5,round($heizkosten[$q]),1,0);
        }
        array_push($werte, $wohnungswert);
    }
    $pdf->Ln();
    }
    $pdf->SetFont("times","B",8);
    $pdf->Cell($w,5,"Summe:",1,0);
    $pdf->SetFont("times","",8);
    $pdf->Cell($w,5,$summe,1,0);
    $pdf->Cell($w,5,"",1,0);
    for($m=0;$m<count($werte);$m++){
        $pdf->Cell($w,5,$werte[$m],1,0);
    }
    $pdf->Output();
    
}
