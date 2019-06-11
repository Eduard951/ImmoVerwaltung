<?php
    require "header.php";
    require "includes/dbh.inc.php";
?>

	<main>
	<?php 
	if(isset($_SESSION['sessionid'])){
	    
	    $sql = "";
	   
	    
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

            <br><br>
        
        
                <h4>Tagesordnung (Pflicht)</h4>
                    <form action="./includes/versammlung_einladung.inc.php" method="POST" id="formTops">
                    	<div id="tops">
                    		<div class="top">
                    			<h7>Top 1</h7>
                    			<input name="topnames[]" toppoint="1" value=""></input>
                    			<textarea class="topaddtext nonedisplay" toppoint="1" name="info[]"></textarea>
                                <select name="top_type[]"><option value="Freitext">Freitext</option><option value="Beschlussfaehigkeit der Versammlung">Beschlussfaehigkeit der Versammlung</option><option value="Verwaltungsberat">Verwaltungsberat</option></select>
                    		</div>
                    		<input type="hidden" id="numberoftops" value="1" autocomplete="off"></input>
                    	</div>
                    <br><button class="btn btn-success btn-lg" type="submit" name="versammlung_einladung_submit">Einladungen versenden</button>
                    </form>
                    <button id="addtop">Top hinzufuegen</button>
                    <button id="showprot">Protokoll weiterbearbeiten</button><br>
     
        <br>
        <br><a href="versammlung_uebersicht.php"><button id="zurueck_btn" class="btn btn-primary btn-lg">Zurueck</button>
        '.$_SESSION['objektid'].'';
            
            
	}else {
	   echo'';
	}
	?>	
	</main>
	
<?php 
    require "footer.php";
?>

<script type="text/javascript">
	var showtopaddtext=false;

	$("#addtop").on("click", function(){
		$("#numberoftops").val(parseInt($("#numberoftops").val())+1);
		if (showtopaddtext){
			$("#tops").append('<div class="top"><h7>Top '+$("#numberoftops").val()+'</h7><input name="topnames[]" toppoint="'+$("#numberoftops").val()+'" value=""></input><textarea class="topaddtext" toppoint="'+$("#numberoftops").val()+'" name="info[]"></textarea><select name="top_type[]"><option value="Freitext">Freitext</option><option value="Beschlussfaehigkeit der Versammlung">Beschlussfaehigkeit der Versammlung</option><option value="Verwaltungsberat">Verwaltungsberat</option></select></div>');
		}
		else{
			$("#tops").append('<div class="top"><h7>Top '+$("#numberoftops").val()+'</h7><input name="topnames[]" toppoint="'+$("#numberoftops").val()+'" value=""></input><textarea class="topaddtext nonedisplay" toppoint="'+$("#numberoftops").val()+'" name="info[]"></textarea><select name="top_type[]"><option value="Freitext">Freitext</option><option value="Beschlussfaehigkeit der Versammlung">Beschlussfaehigkeit der Versammlung</option><option value="Verwaltungsberat">Verwaltungsberat</option></select></div>');
		}
	});
	$("#showprot").on("click", function(){
		$(".topaddtext").removeClass("nonedisplay");
		showtopaddtext=true;
	});
</script>

<style>
	.nonedisplay{
		display:none;
	}
</style>


