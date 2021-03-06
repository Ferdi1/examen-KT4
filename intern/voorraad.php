<!-- 
    Document   : Voorraad
    Created on : 12-jul-2013, 14:27:11
    Author     : Ton van Beuningen
-->
<?php
$melding = 'Inloggen';
session_start();
include "database.php";
?>
<!DOCTYPE html>
<html>
    <head>
	<meta charset="utf-8" />
	<title>ToolsForEver</title>
	<link href="../toolsforever.css" rel="stylesheet" type="text/css" media="screen" />
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.12.0.min.js"></script>

</head>
<body>
	<header>
		<div id="logo"><a href="../index.php"><img src="../afbeeldingen/NewLogo.jpg" /></a></div>
		<div id="titel"><h1>ToolsForEver</h1></div>
		<div id="inlog">
	      <form method="post" action="../index.php">
	    <?php
	    if (isset($_SESSION['user'])) {
	      echo '<p>Medewerker: '.$_SESSION['user']['voorletters'].' '. $_SESSION['user']['voorvoegsel'].' '.$_SESSION['user']['achternaam'].'</p><input type="submit" name="loguit" value="Uitloggen">'; 
	    } else { 
	    ?>
	      <h3><?php echo $melding; ?></h3>
	        <label>Gebruikersnaam</label><input type="text" id="naam" name="naam" placeholder="Gebruikersnaam">
	        <label for="ww">Wachtwoord</label><input type="password" id="ww" name="ww" placeholder="Wachtwoord">
	        <label>&nbsp;</label><input type="submit" value="Inloggen" name="login">
	    <?php } ?>
	      </form>
		</div>
	</header>
	<div id="wrapper">
	<nav>
		<a href="../index.php">Startpagina</a>
		    <?php if ($_SESSION['user']['rights'] == 0) {
      echo '<a href="index.php?prod=1">Producten</a>';
    } ?>
		<a href="fabrieken.php">Fabrieken</a>
		<a href="locaties.php">Locaties</a>
		<a href="medewerkers.php">Medewerkers</a>
                <a class="huidig" href="voorraad.php">Voorraad</a>
		<a href="../info.php">Over ons</a>
	</nav>
	<article>
            <h1>Voorraad</h1>
                <select id="artikel" name="artikel">
                	<option value="0">Kies een product</option>
					<?php
					$sql = "SELECT * FROM artikel";
					$result = $conn->query($sql);
					foreach ($result as $row) {
					    echo ('<option value="'.$row["productcode"].'">'.$row["product"].'</option>');
					}
					?>
                </select>
                <select id="locatie" name="locatie">
                	<option value="0">Kies een locatie</option>
                    <?php
                    $sql = "SELECT * FROM locatie";
					$result = $conn->query($sql);
                   	foreach ($result as $row) {
					    echo ('<option value="'.$row["locatiecode"].'">'.$row["locatie"].'</option>');
 					}             
                     ?>
                </select>
                <button onclick="showData()">aantal opvragen</button>
            <div id="data"></div>
        </article>
        </div>
<script>
    function showData() {
        locatie=$("#locatie").val();
        artikel=$("#artikel").val();
        $.get("data/voorraad.php?locatie="+locatie+"&artikel="+artikel, function(data){
      
        $("#data").html(data);
    });
    
}
       
</script>
</body>
</html>
