<?php
session_start();

include 'inc/dbConnection.php';
$dbConn = startConnection("final");
include 'inc/functions.php';
validateSession();

$sql = "DELETE FROM champions WHERE champId = " . $_GET['champId'];
$stmt=$dbConn->prepare($sql);
$stmt->execute();

header("Location: admin.php");



?>