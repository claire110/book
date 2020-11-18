<?php
ob_start();
session_start();
require("../model/db.php");
require("../model/dbFunctions.php");
require("../model/filterInput.php");
date_default_timezone_set('Australia/Brisbane');//set time zone

if($_SESSION['rights'] == 'Admin') {
  if (!empty([$_POST])) {
    $bookid= !empty($_POST['bookid']) ? testInput(($_POST['bookid'])): null;
    $actiontype = !empty($_POST['actiontype']) ? testInput(($_POST['actiontype'])): null;

    //record userid who add this book
    $userid = $_SESSION['userid'];
    //current date and time
    $date = date('Y-m-d H:i:s'); 

    if($_POST['actiontype'] == 'delbook') {
      try {
        delBook($bookid, $bt, $ot, $yop, $genre, $sold, $lan, $cip);
        $_SESSION['message'] = "Book deleted successfully";
        header('location:../view/pages/dashboard.php');
      }
      catch(PDOException $e) { 
        echo "Book deleting problems".$e -> getMessage();
        die();
      }
    } else {
      $_SESSION['message'] = "error";
      header('location:../view/pages/dashboard.php');
    }
  }
} else {
  $_SESSION['message'] = "failed, only admin can delete books.";
  header('location:../view/pages/dashboard.php');
}
?>