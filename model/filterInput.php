<?php
//sanitise data sent via POST and SEND
function testInput($data){
    $data = trim($data);//removes whitespace and other predefined characters from both sides of a string
    $data = stripslashes($data);//removes backslashes
    $data = htmlspecialchars($data);//Convert special characters to HTML entities
    $data = htmlentities($data);//Convert characters to HTML entities
    return $data;
}
?>

