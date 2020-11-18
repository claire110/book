<?php
session_start();
require("../model/db.php");
require("../model/dbFunctions.php");
require("../model/filterInput.php");

  if (!empty([$_POST])) {
    //input sanitation
    $username = !empty($_POST['username'])? testInput(($_POST['username'])): null; 
    $mypass = !empty($_POST['password'])? testInput(($_POST['password'])): null;
    $password = password_hash($mypass, PASSWORD_DEFAULT); //hash the password
    $role = !empty($_POST['role']) ? testInput(($_POST['role'])): null;
    $firstname = !empty($_POST['firstname']) ? testInput(($_POST['firstname'])): null;
    $lastname = !empty($_POST['lastname'])? testInput(($_POST['lastname'])): null;
    $email = !empty($_POST['email']) ? testInput(($_POST['email'])): null;

    if (isset($_REQUEST['actiontype']) && $_REQUEST['actiontype'] == "reg"){ 
      $query = $conn->prepare("SELECT username FROM login WHERE username = :username");
      $query->bindValue(':username', $username);
      $query->execute();
      if ($query->rowCount() < 1) {
        try {
          addUser($username, $password, $role, $firstname, $lastname, $email);
          $_SESSION['message'] = "User acount has been created.";
          header('location:../view/pages/dashboard.php');
        }
        catch(PDOException $e) { 
          echo "Registration failed:".$e -> getMessage();
          die();
        }           
      }
      else {
        echo "Username already exists, please try another";
        echo "<br><a href='../view/pages/dashboard.php?link=addusers'>Go back</a>";
      }
      exit;
    }
  }
?>