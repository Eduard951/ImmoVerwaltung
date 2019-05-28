<?php
    require "header.php";
    require "includes/dbh.inc.php";
?>


	<main>
	<?php 
	if(isset($_SESSION['sessionid'])){
	    
	    $sql = "";
	    
	   // $result = $conn->query($sql);
	    
	    echo '
		<h2>Eigentuemerversammlung: Einladung<span class="badge badge-secondary"></span></h2>
        
        
        
		<form action="./includes/versammlung_einladung.inc.php" method="post" target="_blank">
			
            <h5>Datum(Pflichtfeld) :</h5>
            <input class="form-control" type="date" name="datum">
			
            <br>
            <h5>Uhrzeit(Pflichtfeld) :</h5>
            <input class="form-control" type="text" name="uhrzeit">

			<br>
            <h5>Ort(Pflichtfeld) : </h5>
            <input class="form-control" type="text" name="Ort">
            
            <br>
			<br>
            <h5>Einladung Text(Pflichtfeld) : </h5>
            <textarea class="form-control" rows="3" type="text" name="text"></textarea>

            <br>
           
            <h5>Vorlage für Tagesordnung (Pflicht): </h5>
                <select id="cardtype" class="form-control" name="tagesordnung">
                  <option></option>
                  <option>Begruessung,Feststellung der Ordnungsmaessigkeit der Einladung,Beschlussfaehigkeit der Versammlung,Tagesordnung,Wahlen,Verwaltungsberat,Verschiedenes</option>
                  <option>(Neu)</option>
                </select>
            <br>
            
        
		  ';

		
            echo'
        
        <br>
        
        <br><button class="btn btn-success btn-lg" type="submit" name="versammlung_einladung_submit">Einladungen versenden</button>
              

        </form>
        <button onclick="tagesordnung_bearbeitung()" class="btn btn-primary btn-lg">Vorlage auswaehlen und fuer Protokoll fuellen</button>
        <br>
        <br><a href="versammlung_uebersicht.php"><button id="zurueck_btn" class="btn btn-primary btn-lg">Zurueck</button>
';
	}else {
	   echo'';
	}
	?>	
	</main>
	
<?php 
    require "footer.php";
?>

	    <script>


		function tagesordnung_bearbeitung(){  
		var back_btn = document.getElementById("zurueck_btn");
		back_btn.parentNode.removeChild(back_btn);
		
	    var e = document.getElementById("cardtype");
	    var auswahl = e.options[e.selectedIndex].text;
	    var split_auswahl = auswahl.split(",");

	    
	    for(var i=0;i<split_auswahl.length;i++){
		var a = document.createElement("a");
		var btn = document.createElement("button");
		var btn_protokoll = document.createElement("button");
		var br = document.createElement("br");
	    var begruessung_label = document.createElement("h5");
	    begruessung_label.innerHTML= split_auswahl[i]+":";
	    var begruessung_input = document.createElement("textarea");
	    if(split_auswahl[i]=="Feststellung der Ordnungsmaessigkeit der Einladung"){
		    begruessung_input.setAttribute("placeholder","Der Versammlungsleiter stellt fest, dass die Einladung zur Eigentuemerversammlung form- und fristgerecht gem. §24 Abs. 4 Satz 2 WEG versendet wurde.");
	    }
	    else if(split_auswahl[i]=="Begruessung"){
		    begruessung_input.setAttribute("placeholder","Der Versammlungsleiter begruesst alle Anwesenden und eroeffnet die Versammlung.");
	    }
	    begruessung_input.setAttribute("class","form-control");
	    begruessung_input.setAttribute("rows","3");
	    begruessung_input.setAttribute("type","text2");
	    begruessung_input.setAttribute("name",split_auswahl[i]+"_input");
	    a.setAttribute("href","versammlung_uebersicht.php");
	    btn.setAttribute("class","btn btn-primary btn-lg");
	    btn.innerHTML = "Zurueck";

	    btn_protokoll.setAttribute("class","btn btn-success btn-lg");
	    btn_protokoll.innerHTML = "Protokoll hinzufuegen";
	    
	    document.body.appendChild(begruessung_label);
	    document.body.appendChild(begruessung_input);
	    document.body.appendChild(br);
	    }
	    document.body.appendChild(btn_protokoll);
	    document.body.appendChild(a);
	    document.body.appendChild(btn);
	    return false;
		}
	    </script>


