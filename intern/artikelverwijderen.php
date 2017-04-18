<!-- 
    Document   : artikelverwijderen
    Created on : 16-jul-2015, 13:21:25
    Author     : Ton van Beuningen
-->
<?php
include_once "database.php";

if (isset($_POST['delete'])) {
    $sql = "DELETE FROM artikel WHERE productcode ='".$_POST['code']."'";
    $conn->exec($sql);
    header("Location: ../index.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>ToolsForEver Artikel verwijderen</title>
    <link href="../toolsforever.css" rel="stylesheet" type="text/css" media="screen" />
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
    		<a class="huidig" href="index.php?prod=1">Producten</a>
    		<a href="fabrieken.php">Fabrieken</a>
    		<a href="locatie.php">Locaties</a>
    		<a href="medewerkers.php">Medewerkers</a>
    		<a href="../info.php">Over ons</a>
        </nav>
        <article>
    <?php
    
    $stmt = $conn->prepare("SELECT * FROM artikel JOIN fabriek ON artikel.fabriekscode = fabriek.fabriekscode WHERE productcode=:productcode");
    $stmt->bindParam(":productcode",$productcode);
    $productcode = $_GET['id'];
    $stmt->execute();
    $row = $stmt->fetch();
    ?>
            <h1>Artikel verwijderen</h1>
            <p>Wilt u het onderstaand artikel verwijderen?</p>
            <p>Product: <?php echo $row['product'];?></p>
            <p>Type: <?php echo $row['type'];?></p>
            <p>Fabriek: <?php echo $row['fabrieksnaam'];?></p>
            <form method="post" action="#">
                    <input type="hidden" name="code" value="<?php echo $row['productcode'];?>" />
                    <input type="submit" name="delete" value="Verwijderen" />
                    <input type="button" value="Annuleren" onclick="location.href='../index.php';" />
            </form>
        </article>
    </div>
</body>
</html>