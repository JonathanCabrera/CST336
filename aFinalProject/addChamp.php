<?php
session_start();

include 'inc/dbConnection.php';
$dbConn = startConnection("final");
include 'inc/functions.php';
validateSession();

if (isset($_GET['addChamp'])) { //checks whether the form was submitted
    
    $champId = $_GET['champId'];
    $champName = $_GET['champName'];
    $champDes = $_GET['champDes'];
    $image = $_GET['image'];
    $gender = $_GET['gender'];
    
    
    $sql = "INSERT INTO champions (champId, champName, champDes, image, gender) 
            VALUES (:champId, :champName, :champDes, :image, :gender);";
    $np = array();
    $np[":champId"] = $champId;
    $np[":champName"] = $champName;
    $np[":champDes"] = $champDes;
    $np[":image"] = $image;
    $np[":gender"] = $gender;
    
    $stmt = $dbConn->prepare($sql);
    $stmt->execute($np);
    echo "New Champion was added!";
    header("Location: admin.php");
}

?>
<!DOCTYPE html>
<html>
    <head>
        <title> Admin Section: Add New Champion </title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    </head>
    <body>
        
        <h1> Adding New Champion </h1>
        
         <form>
            <input type="hidden" name="champId">
            Champion name: <input type="text" name="champName"><br>
            
            Description: <textarea name="champDes" cols="50" rows="4"></textarea><br>
            
            Gender: <input type="text" name="gender"><br>
            
            Set Image Url: <input type="text" name="image"><br>
           <input type="submit" name="addChamp" value="Add Champ">
        </form>

    </body>
</html>