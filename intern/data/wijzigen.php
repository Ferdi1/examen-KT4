
<?php
include_once '../database.php';
    $nietok= false;
    $productcode = $_POST["productcode"];
    $product =  $_POST["product"];
    $type =  $_POST["type"];
    $fabriekscode = $_POST["fabriek"];
    $inkoop =  $_POST["inkoop"];
    $verkoop =  $_POST["verkoop"];
    if ($productcode == "" ) {
        $nietok = true;
    }
    if ($inkoop=="") {
        $inkoop=0;
    }
    if ($verkoop=="") {
        $verkoop=0;
    }
    $sql = "UPDATE artikel SET 
    product = '$product', 
    type = '$type',
    fabriekscode = '$fabriekscode',
    inkoopsprijs = $inkoop, 
    verkoopsprijs = $verkoop
    WHERE productcode='$productcode'"; 
    $result = $conn->exec($sql);
    
    if ($result == 0 or $nietok) {
        $error = "Product kan niet gewijzigd worden..!";
        echo $error. "status" .$sql;
    } else {
        header("location: ../index.php");
    }
?>