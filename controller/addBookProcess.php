<?php
session_start();
require("../model/db.php");
require("../model/dbFunctions.php");
require("../model/filterInput.php");
date_default_timezone_set('Australia/Brisbane');//set time zone

if (!empty([$_POST])) {//passing from data to an array
  //input sanitisation
  // author info
  $name = !empty($_POST['name'])? testInput(($_POST['name'])): null; 
  $surname = !empty($_POST['surname'])? testInput(($_POST['surname'])): null;
  $nationality = !empty($_POST['nationality'])? testInput(($_POST['nationality'])): null;
  $yob = !empty($_POST['yob']) ? testInput(($_POST['yob'])): null;
  $yod = !empty($_POST['yod']) ? testInput(($_POST['yod'])): null;
  // book info
  $bt = !empty($_POST['bt']) ? testInput(($_POST['bt'])): null;
  $ot = !empty($_POST['ot']) ? testInput(($_POST['ot'])): null;
  $yop = !empty($_POST['yop']) ? testInput(($_POST['yop'])): null;
  $genre = !empty($_POST['genre']) ? testInput(($_POST['genre'])): null;
  $sold = !empty($_POST['sold']) ? testInput(($_POST['sold'])): null;
  $lan = !empty($_POST['lan']) ? testInput(($_POST['lan'])): null;
  $cip = !empty($_POST['cip']) ? testInput(($_POST['cip'])): null; 
  // bookplot info
  $plot = !empty($_POST['plot']) ? testInput(($_POST['plot'])): null; 
  $ps = !empty($_POST['ps']) ? testInput(($_POST['ps'])): null; 
  
  //record userid who added this book
  $userid = $_SESSION['userid'];
  //record current date and time
  $date = date('Y-m-d H:i:s');  

  if($_POST['actiontype'] == 'addbook') {
    // check if author already exists in the system
    $query = $conn->prepare("SELECT * FROM author WHERE name = :name AND surname = :surname 
    AND Nationality = :nationality AND BirthYear = :yob AND DeathYear = :yod");
    $query->bindValue(':name', $name);
    $query->bindValue(':surname', $surname);
    $query->bindValue(':nationality', $nationality);
    $query->bindValue(':yob', $yob);
    $query->bindValue(':yod', $yod);
    $query->execute();
    $row = $query->fetch(PDO::FETCH_ASSOC);
    $authorId = $row['AuthorID'];

    if ($query->rowCount() < 1) { //if author is not find, add author and book
      try {
        addAuthorandBook($name, $surname, $nationality, $yob, $yod, $bt, $ot, $yop, $genre, 
        $sold, $lan, $cip, $plot, $ps, $date, $userid);
        $_SESSION['message'] = "Author and Book added successfully";
        header('location:../view/pages/dashboard.php');
      }
      catch(PDOException $e) { 
        echo "Book creation problems".$e -> getMessage();
        die();
      }
    }
    else{ 
        // check if book already exists in the system
        $query = $conn->prepare("SELECT * FROM author INNER JOIN book on author.AuthorID = book.authorId 
        WHERE author.name = :name AND author.surname = :surname AND author.Nationality = :nationality 
        AND author.BirthYear = :yob AND author.DeathYear = :yod AND book.BookTitle = :bt AND book.OriginalTitle =:ot
        AND book.YearofPublication = :yop AND book.Genre = :genre AND book.LanguageWritten = :lan");
        $query->bindValue(':name', $name);
        $query->bindValue(':surname', $surname);
        $query->bindValue(':nationality', $nationality);
        $query->bindValue(':yob', $yob);
        $query->bindValue(':yod', $yod);
        $query->bindValue(':bt', $bt);
        $query->bindValue(':ot', $ot);
        $query->bindValue(':yop', $yop);
        $query->bindValue(':genre', $genre);
        $query->bindValue(':lan', $lan);
        $query->execute();
        $row = $query->fetch(PDO::FETCH_ASSOC);
        $bookId = $row['BookID'];
        if ($query->rowCount() < 1) { //book not exists in the system, add book
          try { 
            addBookOnly($bt, $ot, $yop, $genre, $sold, $lan, $authorId, $cip, $plot, $ps, $date, $userid);
            $_SESSION['message'] = "Book added successfully";
            header('location:../view/pages/dashboard.php');
          }
          catch(PDOException $e) { 
            echo "Book creation problems".$e -> getMessage();
            die();
          } 
        }
        else{//book already exists in the system
          echo "Book and Author have already existed in the system!";
          echo "<a href='../view/pages/dashboard.php'> back to homepage</a>";
        }
      exit;
    }
  }
}
?>
