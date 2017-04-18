<?php
$melding = 'Inloggen';
session_start();
?><!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>ToolsForEver</title>
	<link href="toolsforever.css" rel="stylesheet" type="text/css" media="screen" />
</head>
<body>
	<header>
		<div id="logo"><a href="index.php"> <img src="afbeeldingen/NewLogo.jpg" /></a></div>
		<div id="titel"><h1>ToolsForEver</h1></div>
		<div id="inlog">
	      <form method="post" action="index.php">
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
<?php if (isset($_SESSION['user'])) {  ?>
	  <nav>
	    <a href="index.php">Startpagina</a>
	        <?php if ($_SESSION['user']['rights'] == 0) {
      echo '<a href="index.php?prod=1">Producten</a>';
    } ?>
	    <a href="intern/fabrieken.php">Fabrieken</a>
	    <a href="intern/locaties.php">Locaties</a>
	    <a href="intern/medewerkers.php">Medewerkers</a>
	    <a href="intern/voorraad.php">Voorraad</a>
	    <a href="info.php">Over ons</a>
	  </nav>
<?php } else { ?>
	<nav>
		<a href="index.php">Startpagina</a>
		<a class="huidig" href="info.php">Over ons</a>
	</nav>
<?php } ?>
	<article>
            <fieldset>
                <legend>Postadres</legend>
                <p>ToolsForEver</p>
                <p>Enter 36-42</p>
                <p>Eindhoven</p>
            </fieldset>
            <fieldset>
                <legend>Bezoekadres</legend>
                <p>ToolsForEver</p>
                <p>Postbus 12345</p>
                <p>5600 VM Eindhoven</p>
            </fieldset>
             <fieldset>
                <legend>Contact</legend>
                <p>Telefoon: (040) 987 65 00</p>
                <p>Fax: (040) 987 65 99</p>
                <p>Email: info@toolsforever.nl</p>
            </fieldset>
	</article>
	</div>
	<footer>
		<p>&copy; 2013 Fastdevelopment</p>
	</footer>
</body>
</html>