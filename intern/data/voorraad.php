<?php
include("../database.php");

$locatie = $_GET['locatie'];
$artikel = $_GET['artikel'];
$sql = "SELECT aantal FROM artikel 
        INNER JOIN voorraad ON artikel.productcode = voorraad.productcode  
        LEFT JOIN locatie ON locatie.locatiecode = voorraad.locatiecode 
        WHERE voorraad.locatiecode='$locatie' AND voorraad.productcode='$artikel'";
$result = $conn->query($sql);
foreach ($result as $row) {
    if ($row['aantal'] > 0) {
        echo '<span class="invoorraad">';
    } else {
        echo '<span class="uitvoorraad">';
    }
    echo $row['aantal'].' x</span>';
}
?>