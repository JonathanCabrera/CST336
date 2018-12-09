<?php

include '../../../inc/dbConnection.php';
$dbConn = startConnection("pets");

$sql ="SELECT *, YEAR(CURDATE()) - yob age FROM pets WHERE id = ".$_GET['petid'];
$stmt = $dbConn->prepare($sql);
$stmt->execute();
$record = $stmt->fetch(PDO::FETCH_ASSOC); //we're expecting just one record

//print_r($record);
echo json_encode($record);
?>