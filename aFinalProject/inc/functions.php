<?php

function validateSession(){
    if (!isset($_SESSION['adminFullName'])) {
        header("Location: index.php");  //redirects users who haven't logged in 
        exit;
    }
}


function displayAllChampions() {
    global $dbConn;
    
    $sql = "SELECT * FROM champions INNER JOIN abilities ON champions.champId = abilities.champId ORDER BY champName ASC";
    $stmt = $dbConn->prepare($sql);
    $stmt->execute();
    $records = $stmt->fetchAll(PDO::FETCH_ASSOC); //we're expecting multiple records

    foreach ($records as $record) {
        echo "<b>".$record['champName']."</b>";
        echo "<br>";
        echo "<img src=img/champions/".$record['image']."></img>";
        echo "<br>";
        echo $record['champDes'];
        echo "<br>";
        echo "[<a onclick='openModal()' target='champModal'
        href='champInfo.php?champId=".$record['champId']."'>More Info</a>]  ";
        echo "<br><br>";
        echo "<a class='btn btn-primary' role='button' href='updateChamp.php?champId=".$record['champId']."'>Update</a>";
        echo "<form action='deleteChamp.php' onsubmit='return confirmDelete()'>";
        echo "   <input type='hidden' name='champId' value='".$record['champId']."'>";
        echo "   <button class='btn btn-outline-danger' type='submit'>Delete</button>";
        echo "</form>";
        echo "<br><br>";
        
    }
}

function getCategories() {
    global $dbConn;
    
    $sql = "SELECT * FROM om_category ORDER BY catName";
    $stmt = $dbConn->prepare($sql);
    $stmt->execute();
    $records = $stmt->fetchAll(PDO::FETCH_ASSOC); //we're expecting multiple records   
    
    //print_r($records);
    
    return $records;
    
}

function getChampInfo($champId) {
     global $dbConn;
    
    $sql = "SELECT * FROM champions WHERE champId = $champId";
    $stmt = $dbConn->prepare($sql);
    $stmt->execute();
    $record = $stmt->fetch(PDO::FETCH_ASSOC); //we're expecting multiple records   
    
    return $record;
     
    
}

?>