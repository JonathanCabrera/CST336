<?php
session_start();

include 'inc/dbConnection.php';
$dbConn = startConnection("final");
include 'inc/functions.php';
validateSession();

if (isset($_GET['champId'])) {
  $champInfo = getChampInfo($_GET['champId']);    
}

?>

<!DOCTYPE html>
<html>
    <head>
        <title> Champion Info </title>
    </head>
    <body>
    
    <h3><?=$champInfo['champName']?></h3>
     <?=$champInfo['champDes']?><br>
     <img src='img/champions/<?=$champInfo['image']?>' height='75'/>
 
    </body>
</html>