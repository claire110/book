<?php
session_start();//Start the session
include '../model/db.php';
include '../model/dbFunctions.php';
include '../model/filterInput.php';

//via POST method
if (!empty([$_POST])) {
    $username = testInput($_POST['username']);
    $password = testInput($_POST['password']);

        $stmt = $conn->prepare("SELECT * FROM login INNER JOIN users ON login.loginID = users.loginID 
        WHERE username=:user");
        $stmt->bindParam(':user', $username);
        $stmt->execute();
        $rows = $stmt -> fetch();        
        if (password_verify($password, $rows['password'])) {
            // Set session variables
            $_SESSION['login'] = $rows['username'];  
            $_SESSION['loginid'] = $rows['loginID'];  
            $_SESSION['rights'] = $rows['accessRights'];  
            $_SESSION['userid'] = $rows['userID'];  
            header('location:../view/pages/dashboard.php');//redirect to dashboard page
        }
        else {
            echo "Password or username is incorrect, please try again.";            
            echo "<br><a href='../index.php'>Login again</a>";
        }
    } 
?>