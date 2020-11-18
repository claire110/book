<?php
session_start();
require("../model/db.php");
require("../model/dbFunctions.php");
require("../model/filterInput.php");
date_default_timezone_set('Australia/Brisbane');//set time zone

if (!empty([$_POST])) {
  //input sanitisation 
  $authorid= !empty($_POST['authorid']) ? testInput(($_POST['authorid'])): null;
  $bookid= !empty($_POST['bookid']) ? testInput(($_POST['bookid'])): null;
  $name = !empty($_POST['name'])? testInput(($_POST['name'])): null; 
  $surname = !empty($_POST['surname'])? testInput(($_POST['surname'])): null;
  $nationality = !empty($_POST['nationality'])? testInput(($_POST['nationality'])): null;
  $yob = !empty($_POST['yob']) ? testInput(($_POST['yob'])): null;
  $yod = !empty($_POST['yod']) ? testInput(($_POST['yod'])): null; 
  $bt = !empty($_POST['bt']) ? testInput(($_POST['bt'])): null;
  $ot = !empty($_POST['ot']) ? testInput(($_POST['ot'])): null;
  $yop = !empty($_POST['yop']) ? testInput(($_POST['yop'])): null;
  $genre = !empty($_POST['genre']) ? testInput(($_POST['genre'])): null;
  $sold = !empty($_POST['sold']) ? testInput(($_POST['sold'])): null;
  $lan = !empty($_POST['lan']) ? testInput(($_POST['lan'])): null;
  $cip = !empty($_POST['cip']) ? testInput(($_POST['cip'])): null; 
  $bpid = !empty($_POST['bpid']) ? testInput(($_POST['bpid'])): null;
  $plot = !empty($_POST['plot']) ? testInput(($_POST['plot'])): null;
  $ps = !empty($_POST['ps']) ? testInput(($_POST['ps'])): null; 

  $changelogid = !empty($_POST['changelogid']) ? testInput(($_POST['changelogid'])): null;
  $dcreated = !empty($_POST['dcreated']) ? testInput(($_POST['dcreated'])): null; 
  // $userid = !empty($_POST['userid']) ? testInput(($_POST['userid'])): null; 

  $actiontype = !empty($_POST['actiontype']) ? testInput(($_POST['actiontype'])): null;
  $userid = $_SESSION['userid']; //record userid who add this book
  $date = date('Y-m-d H:i:s');  //record current date and time

  if($_POST['actiontype'] == 'editbook') {
    try {
      editBook($authorid, $name, $surname, $nationality, $yob, $yod, $bookid, $bt, $ot, $yop, 
      $genre, $sold, $lan, $cip, $bpid, $plot, $ps, $userid, $changelogid, $dcreated, $date);
      $_SESSION['message'] = "Edit Successfully";
      header('location:../view/pages/dashboard.php');
    }
    catch(PDOException $e) { 
      echo "Book update failed:".$e -> getMessage();
      die();
    }
  } else {
    $_SESSION['message'] = "Update Failed.";
    header('location:../view/pages/dashboard.php');
  }
}
?>
