<?php
    include 'inc/functions.php';
?>
    
<!DOCTYPE html>
<html>
    <head>
        <title> How well do you know Me Quiz? </title>
    </head>
    <style>
        @import url("css/styles.css");
        body {
            text-align: center;
        }
    </style>
    <body>
        <div id="main">
        <h1> How well do you know me Quiz!</h1>
        </div>
        <form method="GET">
            1. What month was I born? <br>
            <select name="birthMonth">
              <option value="select">Select Month</option>
              <option value="nov">November</option>
              <option value="dec">December</option>
              <option value="jan">January</option>
              <option value="feb">February</option>
            </select>
            <br> <br>
            2. How do I spell my name? <br>
            <input type="radio" name="myName" value="jonathan"> Jonathan <br>
            <input type="radio" name="myName" value="johnathon"> Johnathon <br>
            <input type="radio" name="myName" value="jonothon"> Jonothon <br>
            <input type="radio" name="myName" value="johnathan"> Johnathan 
            <br> <br>
            3. What's my age? (I'm in my 20's) <br>
            <input type="text" name="age" value="0">
            <br> <br>
            4. What year am I in? <br>
            <select name="schoolYear">
              <option value="select">Select School Year</option>
              <option value="freshman">Freshman</option>
              <option value="sophomore">Sophomore</option>
              <option value="junior">Junior</option>
              <option value="senior">Senior</option>
            </select>
            <br> <br>
            5. What's my gender? <br>
            <input type="radio" name="gender" value="male"> Male <br>
            <input type="radio" name="gender" value="female"> Female 
            <br> <br>
            <input type="submit">
        </form>
        
        <?php
            $birthMonth = $_GET["birthMonth"];
            $myName = $_GET["myName"];
            $age = $_GET["age"];
            $schoolYear = $_GET["schoolYear"];
            $gender = $_GET["gender"];
            
            if (isset($birthMonth) && isset($myName) && isset($age) && isset($schoolYear) && isset($gender)) {
                 $correctAnswers = countCorrect($birthMonth, $myName, $age, $schoolYear, $gender);
                if ($birthMonth == 'dec' && $myName == "jonathan" &&
                $age == "20" && $schoolYear == "junior" && $gender == "male") {
                    echo "<br><h1>Congrats! you got all 5 question correct!</h1>";    
                } else {
                    echo "<h1>your score is $correctAnswers out of 5</h1>";
                }
            } else {
                $message = createErrorMessage($birthMonth, $myName, $age, $schoolYear, $gender);
                $message = fixErrormessage($message);
                echo "<h1>$message</h1>";
            }

            
        ?>
        
    </body>
</html>