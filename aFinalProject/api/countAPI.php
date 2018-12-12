<?php
    include '../inc/dbConnection.php';
    $dbConn = startConnection("final");
    
    $sql ="SELECT COUNT(*) AS total FROM champions";
        
    $stmt = $dbConn->prepare($sql);
    $stmt->execute();
    $records = $stmt->fetchAll(PDO::FETCH_ASSOC); 

    foreach ($records as $record) {
        echo "<h3>Total Champions: </h3> <b>Total: </b>".$record['total'];
    }
   
?>