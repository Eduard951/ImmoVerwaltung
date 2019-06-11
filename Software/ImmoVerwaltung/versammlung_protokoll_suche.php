<?php
    require "header.php";
?>

<main>
	<?php
	echo'
        <form method="POST" action="versammlung_protokoll.php"><br>
            Datum der Versammlung: <input type="date" name="vers_datum">
            <button class="btn btn-success btn-lg" type="submit" name="protokoll_suchen">Suchen</button>
        </form>
        <br><a href="versammlung_uebersicht.php"><button class="btn btn-primary btn-lg">Zurueck</button>
    ';
	?>
	
</main>

<?php 
    require "footer.php";
?>
