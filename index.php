<?php
$melding = '<h3>Inloggen</h3>';
session_start();
if (isset($_POST['loguit'])) {
  unset($_SESSION['user']);
} else if (isset($_POST['login'])) {
  require "intern/database.php";
  $gebruikersnaam = $_POST['naam'];
  $wachtwoord = sha1($_POST['ww']);
  $count = 0;
  $sql = "SELECT * FROM medewerker WHERE gebruikersnaam='$gebruikersnaam' AND wachtwoord='$wachtwoord'";
  $result = $conn->query($sql);
  foreach ($result as $row) {
      $_SESSION['user'] = $row;

      $count++;
  }
  if ($count==0) {
    $melding = '<span class="error">Onjuiste gebruikersnaam of wachtwoord</span>';
  }
}



// var_dump($_SESSION);die;

?><!DOCTYPE html>
<html>
<head>
	<title>ToolsForEver Overzicht artikelen</title>
	<link href="toolsforever.css" rel="stylesheet" type="text/css" media="screen" />
</head>
<body>
	<header>
		<div id="logo"><a href="index.php"><img src="afbeeldingen/NewLogo.jpg" /></a></div>
		<div id="titel"><h1>ToolsForEver</h1></div>
		<div id="inlog">
      <form method="post" action="index.php">
    <?php
    if (isset($_SESSION['user'])) {
      echo '<p>Medewerker: '.$_SESSION['user']['voorletters'].' '. $_SESSION['user']['voorvoegsel'].' '.$_SESSION['user']['achternaam'].'</p><input type="submit" name="loguit" value="Uitloggen">'; 
      require "intern/database.php";
    } else { 
    ?>
      <?php echo $melding; ?>
        <label>Gebruikersnaam</label><input type="text" id="naam" name="naam" placeholder="Gebruikersnaam"><br>
        <label for="ww">Wachtwoord</label><input type="password" id="ww" name="ww" placeholder="Wachtwoord">
        <label>&nbsp;</label><input type="submit" value="Inloggen" name="login">
    <?php } ?>
      </form>
		</div>
	</header>
	<div id="wrapper">
  <?php if (isset($_SESSION['user'])) {  ?>
  <nav>
  <?php if(isset($_GET['prod'])) { ?>
    <a href="index.php">Startpagina</a>
    <a class="huidig" href="index.php?prod=1">Producten</a>
  <?php } else { ?>
    <a class="huidig" href="index.php">Startpagina</a>
    <?php if ($_SESSION['user']['rights'] == 0) {
      echo '<a href="index.php?prod=1">Producten</a>';
    } ?>
  <?php } ?>
    <a href="intern/fabrieken.php">Fabrieken</a>
    <a href="intern/locaties.php">Locaties</a>
    <a href="intern/medewerkers.php">Medewerkers</a>
    <a href="intern/voorraad.php">Voorraad</a>
    <a href="info.php">Over ons</a>
  </nav>
  <?php } else { ?>
  <nav>
    <a class="huidig" href="index.php">Startpagina</a>
    <a href="info.php">Over ons</a>
  </nav>
  <?php } 
  if(isset($_GET['prod'])) { ?>
	<article>
            <h1>Overzicht artikelen</h1>
            <input type="button" value="Toevoegen" onclick="location.href='intern/artikeltoevoegen.php';" />
            <table>
              <thead>
                <td>productcode</td>
                <td>product</td>
                <td>fabriekscode</td>
                <td>fabriek</td>
                <td>inkoopsprijs</td>
                <td>Verkoopsprijs</td>
              </thead>
                <?php
              
              include "database.php";

// session_start();
// var_dump($_SESSION['user']);die;
// session_start();
//                 $sql = "SELECT * FROM medewerker";
//   $result = $conn->query($sql);



              
// var_dump($_SESSION['user']['rights']);die;

  // foreach ($result as $row) {var_dump($row);die;}
  
          if($_SESSION['user']['rights'] == 0) {
              $sql = "SELECT * FROM artikel JOIN fabriek ON artikel.fabriekscode = fabriek.fabriekscode";
              $result = $conn->query($sql);
              foreach ($result as $row) {
                echo "<tr>";
                echo "<td>" . $row["productcode"] . "</td>";
                echo "<td>" . $row["product"] . "</td>";
                echo "<td>" . $row["fabriekscode"] . "</td>";
                echo "<td>" . $row["fabrieksnaam"] . "</td>";
                echo "<td>" . $row["inkoopsprijs"] . "</td>";
                echo "<td>" . $row["verkoopsprijs"] . "</td>";
                echo "<td><a href='intern/artikelwijzigen.php?productcode=" . $row["productcode"]. "'\><img src='../afbeeldingen/wijzigen.png'/></a></td>";
                echo "<td><a href='intern/artikelverwijderen.php?id=" . $row["productcode"]. "'\><img src='../afbeeldingen/verwijderen.png'/></a></td>";
              }
            } else if($_SESSION['user']['rights'] == 1) {
              echo "No Privileges";
            }


              
              ?>
                
            </table>
	</article>
  <?php } else { ?>
  <article>
    <img src="afbeeldingen/Hoofdkantoor.jpg" />
    <p>
      Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
    </p>
    <br />
    <p>
      Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
    </p>
                <p>U kunt inloggen door op de knop Inloggen (rechtsboven) te klikken.</p>
  </article>

  <?php } ?>
	</div>
	<footer>
		<p>&copy; 2013 FastDevelopment</p>
	</footer>
</body>
</html>