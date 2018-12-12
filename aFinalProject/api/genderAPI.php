<?php
    include '../inc/dbConnection.php';
    $dbConn = startConnection("final");
    
    $sql ="SELECT Gender,COUNT(*) as count FROM champions GROUP BY Gender ";
        
    $stmt = $dbConn->prepare($sql);
    $stmt->execute();
    $records = $stmt->fetchAll(PDO::FETCH_ASSOC); 
    
    echo "<h3>Gender Count:</h3>";
    foreach ($records as $record) {
        $gender = $record['Gender'];
        if ($gender == 'M') {
            echo "<b>Male: </b>".$record['count'];    
        } else {
            echo "<b>Female: </b>".$record['count'];            
        }
        echo "<br>";
    }
   
?>