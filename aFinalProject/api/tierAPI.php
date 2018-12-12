<?php
    include '../inc/dbConnection.php';
    $dbConn = startConnection("final");
    
    $sql ="SELECT tierRank,COUNT(*) as count FROM stats GROUP BY tierRank ORDER BY tierRank ASC";
        
    $stmt = $dbConn->prepare($sql);
    $stmt->execute();
    $records = $stmt->fetchAll(PDO::FETCH_ASSOC); 
    
    echo "<h3>Tier Count:</h3>";
    foreach ($records as $record) {
        echo "<b>Tier ".$record['tierRank'].": </b>".$record['count'];
        echo "<br>";
    }
   
?>