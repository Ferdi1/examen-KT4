<!--    Document   : fabrieken
    Created on : 12-jul-2015, 14:27:11
    Author     : Ton
-->
<?php
$melding = 'Inloggen';
session_start();
?><!DOCTYPE html>
<html>
    <head>
	<meta charset="utf-8" />
	<title>ToolsForEver</title>
	<link href="../toolsforever.css" rel="stylesheet" type="text/css" media="screen" />
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
		<a class="huidig" href="fabrieken.php">Fabrieken</a>
		<a href="locaties.php">Locaties</a>
		<a href="medewerkers.php">Medewerkers</a>
                <a href="voorraad.php">Voorraad</a>
		<a href="../info.php">Over ons</a>
	</nav>
	<article>
            <h1>Overzicht fabrieken</h1>
            <p>Deze functie is niet geimplementeerd. Deze pagina is vergelijkbaar 
                met het overzicht van artikelen.</p>
        </article>
        </div>
    </body>
</html>
