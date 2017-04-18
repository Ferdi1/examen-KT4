<!-- 
    Document   : artikelwijzigen
    Created on : 16-jul-2015, 13:21:09
    Author     : Ton
-->
<?php include "database.php" ?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>ToolsForEver Artikel wijzigen</title>
        <link href="../toolsforever.css" rel="stylesheet" type="text/css" media="screen" />
        <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.12.0.min.js"></script>

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
	<?php
        $error = '';
        $stmt=$conn->prepare("SELECT * FROM artikel JOIN fabriek ON artikel.fabriekscode = fabriek.fabriekscode WHERE productcode=:productcode");
        $stmt->bindParam(":productcode",$productcode);
        $productcode=$_GET["productcode"];
        $stmt->execute();
        $row = $stmt->fetch();
    ?>
            <h1>Gegevens van een product wijzigen</h1>
            <p class="error"><?php echo $error ?></p>
            <form action="#" method="post">
                <input type="hidden" name="productcode" id="productcode" value="<?php echo $row['productcode'];?>" />
                <label for="product">Naam product</label>
                <input type="text" name="product" id="product" maxlength="25" value="<?php echo $row['product'];?>" />
                <label for="type">Type</label>
                <input type="text" name="type" id="type" maxlength="20" value="<?php echo $row['type'];?>" />
                <label for="fabriek">Naam fabriek</label>
                <select id="fabriek" name="fabriek">
                <?php
                    $sql = "SELECT * FROM fabriek";
                    $result = $conn->query($sql);
                    foreach($result as $row2) {
                        $selected = ($row['fabriekscode'] == $row2['fabriekscode']) ? 'selected ' : '';
                        echo '<option '.$selected.'value="'.$row2['fabriekscode'].'">'.$row2['fabrieksnaam'].'</option>';
                    }
                ?>
                </select>
                <label for="inkoop">Inkoopsprijs</label>
                <input type="text" name="inkoop" id="inkoop" value="<?php echo $row["inkoopsprijs"];?>" />
                <label for="verkoop">Verkoopsprijs</label>
                <input type="text" name="verkoop" id="verkoop" value="<?php echo $row["verkoopsprijs"];?>" />
                <input type="button" value="wijzigen" onclick="saveData()">
                <input type="button" value= "annuleren" onclick="location.href='../index.php';">
            </form>
        </article>
        </div>
<script>
    function saveData() {
        var artikelObj = { 
            product:$("#product").val(),
            productcode:$("#productcode").val(),
            type:$("#type").val(),
            fabriek:$("#fabriek").val(),
            inkoop:$("#inkoop").val(),
            verkoop:$("#verkoop").val()
        };

        $.post("data/wijzigen.php",artikelObj, function(){
           location.href='/index.php';
         });
    
    }
</script>
</body>
</html>
