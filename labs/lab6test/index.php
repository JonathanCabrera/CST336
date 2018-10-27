<?php

    $host = "localhost";
    $username = "root";
    $password = "";
    $dbname = "ottermart";
    $dbConn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    
    $dbConn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
     
    $sql = "SELECT catId, catName FROM om_category ORDER BY catName";
    
    $stmt = $dbConn->prepare($sql);
    $stmt->execute();
    $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
    print_r($records);
    
    // foreach ($records as $record) {
    //     echo "<option value='".$record["catId"]."'>".$record["catName"]."</option>";

    // }
?>

<!DOCTYPE html>
<html>
    <head>
        <title> </title>
    </head>
    <body>

    </body>
</html>