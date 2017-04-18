<!-- 
    Document   : artikeltoevoegen
    Created on : 16-jul-2015, 13:20:53
    Author     : Ton van Beuningen
-->
<?php

include "database.php";
$error = '';

if (isset($_POST['submit'])) {
    $nietok= false;
    $productcode = $_POST['productcode'];
    $product =  $_POST['product'];
    $type =  $_POST['type'];
    $fabriekscode = $_POST['fabriek'];
    $inkoop =  $_POST['inkoop'];
    $verkoop =  $_POST['verkoop'];
    if ($productcode == '' ) {
        $nietok = true;
    }
    if ($inkoop=='') {
        $inkoop=0;
    }
    if ($verkoop=='') {
        $verkoop=0;
    }
    $sql = "INSERT INTO artikel (productcode, product, type, fabriekscode, inkoopsprijs, verkoopsprijs) 
            VALUES ('$productcode', '$product', '$type', '$fabriekscode', $inkoop, $verkoop)";
    $result = $conn->exec($sql);    
    if ($result == 0 or $nietok) {
        $error = 'Product kan niet toegevoegd worden..!';
    } else {
        header('Location: ../index.php');
    }
}

?><!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link href="../toolsforever.css" rel="stylesheet" type="text/css" media="screen" />
        <title>ToolsForEver Artikel toevoegen</title>
    </head>
    <body>
    <header>
		<div id="logo"><a href="../index.php"><img src="../afbeeldingen/NewLogo.jpg" /></a></div>
		<div id="titel"><h1>ToolsForEver</h1></div>
		<div id="inlog">
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
        <a href="voorraad.php">Voorraad</a>
		<a href="../info.php">Over ons</a>
	</nav>
	<article>
            <h1>Artikel toevoegen</h1>
            <form action="artikeltoevoegen.php" method="post">
                <p class="error"><?php echo $error; ?></p>
                <label for="productcode">Productcode</label>
                <input type="text" name="productcode" id="productcode" maxlength="7">
                <label for="product">Naam product</label>
                <input type="text" name="product" id="product" maxlength="25">
                <label for="type">Type</label>
                <input type="text" name="type" id="type" maxlength="20">
                <label for="fabriek">Naam fabriek</label>
                <select id="fabriek" name="fabriek">
                <option value="0">Kies...</option>
                <?php
                $sql = "SELECT * FROM fabriek";
                $result = $conn->query($sql);
                foreach($result as $row) {
                     echo '<option value="'.$row["fabriekscode"].'">'.$row["fabrieksnaam"].'</option>';
                }
                ?>
                </select>
                <label for="inkoop">Inkoopsprijs</label>
                <input type="text" name="inkoop" id="inkoop">
                <label for="verkoop">Verkoopsprijs</label>
                <input type="text" name="verkoop" id="verkoop">
                <input type="submit" name="submit" value="Toevoegen">
                <input type="button" value="Annuleren" onclick="location.href='index.php';">
            </form>
        </article>
        </div>
    </body>
</html>
