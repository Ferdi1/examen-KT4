<?php
$servername = "localhost";
$username = "root";
$password = "dev01dev";
$dbname = "toolsforever";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Juist verbonden met de database; 
    }
catch(PDOException $e)
    {
    		echo "Verbinding met database $dbname mislukt:<br>" . $e->getMessage();
    }
?>