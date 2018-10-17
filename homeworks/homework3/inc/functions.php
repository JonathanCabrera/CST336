<?php

function countCorrect($birthMonth, $myName, $age, $schoolYear, $gender) {
    $total = 0;
    if ($birthMonth == 'dec') $total++;
    if ($myName == "jonathan") $total++;
    if ($age == "20") $total++;
    if ($schoolYear == "junior") $total++;
    if ($gender == "male") $total++;
    return $total;
}

function createErrorMessage($birthMonth, $myName, $age, $schoolYear, $gender) {
    $result = " ";
    if ($birthMonth == "select") $result .= "birth month, ";
    if (!isset($myName)) $result .= "name, ";
    if ($age == "0") $result .= "age, ";
    if ($schoolYear == "select") $result .= "school year, ";
    if (!isset($gender)) $result .= "gender, ";
    return $result;
}


function fixErrorMessage($message) {
    if ($message == "") {
        return "";
    } else {
        return "<h2>The following fields are missing:</h2> " . substr($message, 0, -2); 
    }
}




?>