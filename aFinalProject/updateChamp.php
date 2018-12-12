<?php
session_start();

include 'inc/dbConnection.php';
$dbConn = startConnection("final");
include 'inc/functions.php';
validateSession();



if (isset($_GET['updateChamp'])){  //user has submitted update form
    $champId = $_GET['champId'];
    $champName = $_GET['champName'];
    $champDes = $_GET['champDes'];
    $image = $_GET['image'];
    $gender = $_GET['gender'];
    
    $sql = "UPDATE champions
            SET champName = :champName,
               champDes = :champDes,
               image = :image,
               gender = :gender
            WHERE champId = " . $champId;
    
    $np = array();
    $np[':champName'] = $champName; 
    $np[':champDes'] = $champDes;
    $np[':image'] = $image;
    $np[':gender'] = $gender;
    
    $stmt = $dbConn->prepare($sql);
    $stmt->execute($np);
    
    header("Location: admin.php");
    exit();
}

if (isset($_GET['champId'])) {
  $champInfo = getChampInfo($_GET['champId']); 
}

?>

<!DOCTYPE html>
<html>
    <head>
        <title> Update Champion! </title>
       
    </head>
    <body>

        <h1> Updating a Champion </h1>
        
        <form>
            <input type="hidden" name="champId" value="<?=$champInfo['champId']?>">
           Champion name: <input type="text" name="champName" value="<?=$champInfo['champName']?>"><br>
           Description: <textarea name="champDes" cols="50" rows="4"> <?=$champInfo['champDes']?> </textarea><br>
           Gender: <input type="text" name="gender" value="<?=$champInfo['Gender']?>"><br>
           Set Image Url: <input type="text" name="image" value="<?=$champInfo['image']?>"><br>
           <input type="submit" name="updateChamp" value="Update Champ">
        </form>
        
        
        
    </body>
</html>