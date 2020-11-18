<?php
    function addUser($username, $password, $role, $firstname, $lastname, $email){
        global $conn;
        try{
            //SQL transaction
            $conn->beginTransaction(); 
            //prepared statement and bind parameters, login table
            $newlogin = "INSERT INTO login(username, password, accessRights) 
            VALUES (:username, :password, :role)";
            $stmt = $conn->prepare($newlogin);
            $stmt->bindValue(':username', $username);
            $stmt->bindValue(':password', $password);
            $stmt->bindValue(':role', $role);
            $stmt->execute();
            $lastUserId = $conn->lastInsertId();
            $lastLoginId = $conn->lastInsertId();
        
            //prepared statement and bind parameters, users table
            $newuser = "INSERT INTO users(userID, firstName, lastName, email, loginID) 
            VALUES (:userId, :firstname, :lastname, :email, :loginId)";
            $stmt = $conn->prepare($newuser);
            $stmt->bindValue(':userId', $lastUserId);
            $stmt->bindValue(':firstname', $firstname);
            // echo "test1";
            $stmt->bindValue(':lastname', $lastname);
            // echo "test2";
            $stmt->bindValue(':email', $email);
            $stmt->bindValue(':loginId', $lastLoginId);
            // execute insert statement
            $stmt->execute();
            $conn->commit();   
        }
        catch(PDOException $ex){
        $conn->rollBack();
        throw $ex;
        }
    }

    function addAuthorandBook($name, $surname, $nationality, $yob, $yod, $bt, $ot, $yop, $genre, $sold, $lan, 
    $cip, $plot, $ps, $date, $userid) {
        global $conn;
        try {
            $conn->beginTransaction(); //SQL transaction
            //insert into author table, prepared statement
            $newauthor = "INSERT INTO author(Name, Surname, Nationality, BirthYear, DeathYear) 
            VALUES (:name, :surname, :nationality, :yob, :yod)";
            $stmt = $conn->prepare($newauthor);
            // bind parameters
            $stmt->bindValue(':name', $name);
            $stmt->bindValue(':surname', $surname);
            $stmt->bindValue(':nationality', $nationality);
            $stmt->bindValue(':yob', $yob);
            $stmt->bindValue(':yod', $yod);
            $stmt->execute();
            $lastAuthorId = $conn->lastInsertId();

            //insert into book table, prepared statement
            $newbook = "INSERT INTO book(BookTitle, OriginalTitle, YearofPublication, Genre, MillionsSold, 
            LanguageWritten, coverImagePath, AuthorID) 
            VALUES (:bt, :ot, :yop, :genre, :sold, :lan, :cip, :authorId)";
            $stmt = $conn->prepare($newbook);
            // bind parameters
            $stmt->bindValue(':bt', $bt);
            $stmt->bindValue(':ot', $ot);
            $stmt->bindValue(':yop', $yop);
            $stmt->bindValue(':genre', $genre);
            $stmt->bindValue(':sold', $sold);
            $stmt->bindValue(':lan', $lan);
            $stmt->bindValue(':cip', $cip);
            $stmt->bindValue(':authorId', $lastAuthorId);  
            $stmt->execute();
            $lastBookId = $conn->lastInsertId();

            //insert into bookplot table, prepared statement
            $newbookplot ="INSERT INTO bookplot(Plot, PlotSource, BookID) 
            VALUES (:plot, :ps, :bookid)";
            $stmt = $conn->prepare($newbookplot);
            // bind parameters
            $stmt->bindValue(':plot', $plot);
            $stmt->bindValue(':ps', $ps);
            $stmt->bindValue(':bookid', $lastBookId);
            $stmt->execute();
            $lastBookPlotID = $conn->lastInsertId();

            //insert into changelog table, prepared statement
            $changelog = "INSERT INTO changelog(dateCreated, BookID, userID) 
            VALUES (:date, :bookid, :userid)";
            $stmt = $conn->prepare($changelog);
            // bind parameters
            $stmt->bindValue(':date', $date);
            $stmt->bindValue(':bookid', $lastBookId);
            $stmt->bindValue(':userid', $userid);
            $stmt->execute();

            //commit
            $conn->commit();   
        }
        catch(PDOException $ex) { 
            $conn->rollBack();
            throw $ex;
        }
    }

    function addBookOnly($bt, $ot, $yop, $genre, $sold, $lan, $authorId, $cip, $plot, $ps, $date, $userid){
        global $conn;
        try {
            $conn->beginTransaction(); //SQL transaction
            //insert into book table, prepared statement
            $newbook = "INSERT INTO book(BookTitle, OriginalTitle, YearofPublication, Genre, MillionsSold,
             LanguageWritten, coverImagePath, AuthorID) 
            VALUES (:bt, :ot, :yop, :genre, :sold, :lan, :cip, :authorId)";
            $stmt = $conn->prepare($newbook);
            // bind parameters
            $stmt->bindValue(':bt', $bt);
            $stmt->bindValue(':ot', $ot);
            $stmt->bindValue(':yop', $yop);
            $stmt->bindValue(':genre', $genre);
            $stmt->bindValue(':sold', $sold);
            $stmt->bindValue(':lan', $lan);
            $stmt->bindValue(':cip', $cip);
            $stmt->bindValue(':authorId', $authorId);  
            $stmt->execute();
            $lastBookId = $conn->lastInsertId();

            //insert into bookplot table, prepared statement
            $newbookplot ="INSERT INTO bookplot(Plot, PlotSource, BookID) 
            VALUES (:plot, :ps, :bookid)";
            $stmt = $conn->prepare($newbookplot);
            // bind parameters
            $stmt->bindValue(':plot', $plot);
            $stmt->bindValue(':ps', $ps);
            $stmt->bindValue(':bookid', $lastBookId);
            $stmt->execute();
            $lastBookPlotID = $conn->lastInsertId();

            //insert into changelog table, prepared statement
            $changelog = "INSERT INTO changelog(dateCreated, BookID, userID) 
            VALUES (:date, :bookid, :userid)";
            $stmt = $conn->prepare($changelog);
            // bind parameters
            $stmt->bindValue(':date', $date);
            $stmt->bindValue(':bookid', $lastBookId);
            $stmt->bindValue(':userid', $userid);
            $stmt->execute();

            //commit 
            $conn->commit();  
        }
        catch(PDOException $ex) { 
            $conn->rollBack();
            throw $ex;
        }
    }

    function editBook($authorid, $name, $surname, $nationality, $yob, $yod, $bookid, $bt, $ot, $yop, $genre, $sold, 
    $lan, $cip, $bpid, $plot, $ps, $userid, $changelogid, $dcreated) {
        global $conn;
        try {
            $conn->beginTransaction(); //SQL transaction
            //update author table, prepared statement
            $editauthor = "UPDATE author SET Name = :name, Surname = :surname, Nationality = :nationality, 
            BirthYear = :yob, DeathYear = :yod WHERE AuthorID = :authorid";        
            $stmt = $conn->prepare($editauthor); 
            // bind parameters       
            $stmt->bindValue(':name', $name);
            $stmt->bindValue(':surname', $surname);        
            $stmt->bindValue(':nationality', $nationality);        
            $stmt->bindValue(':yob', $yob);        
            $stmt->bindValue(':yod', $yod);        
            $stmt->bindValue(':authorid', $authorid);        
            $stmt->execute();

            //update book table, prepared statement
            $editbook = "UPDATE book SET BookTitle = :bt, OriginalTitle = :ot, YearofPublication = :yop, 
            Genre = :genre, MillionsSold = :sold, LanguageWritten = :lan, AuthorID = :authorid, coverImagePath = :cip 
            WHERE BookID = :bookid";        
            $stmt = $conn->prepare($editbook);
            // bind parameters
            $stmt->bindValue(':bt', $bt);
            $stmt->bindValue(':ot', $ot);
            $stmt->bindValue(':yop', $yop);
            $stmt->bindValue(':genre', $genre);
            $stmt->bindValue(':sold', $sold);
            $stmt->bindValue(':lan', $lan);
            $stmt->bindValue(':authorid', $authorid);
            $stmt->bindValue(':cip', $cip);
            $stmt->bindValue(':bookid', $bookid);        
            $stmt->execute();

            //update bookplot table, prepared statement
            $editbookplot = "UPDATE bookplot SET BookPlotID = :bpid, Plot = :plot, PlotSource = :ps WHERE BookID = :bookid";        
            $stmt = $conn->prepare($editbookplot);
            // bind parameters
            $stmt->bindValue(':plot', $plot);
            $stmt->bindValue(':ps', $ps);
            $stmt->bindValue(':bookid', $bookid); 
            $stmt->bindValue(':bpid',$bpid);            
            $stmt->execute();

            //edit changelog table, prepared statement
            $changelog = "UPDATE changelog SET changeLogID= :changelogid, dateCreated = :dcreated, dateChanged = :date, 
            userID = :userid  WHERE BookID = :bookid";
            $stmt = $conn->prepare($changelog);
            // bind parameters
            $stmt->bindValue(':dcreated', $dcreated);
            $stmt->bindValue(':date', $date);
            $stmt->bindValue(':bookid', $bookid);
            $stmt->bindValue(':userid', $userid);
            $stmt->bindValue(':changelogid', $changelogid);
            $stmt->execute();

            //commit
            $conn->commit();   
        }
        catch(PDOException $ex) { 
            $conn->rollBack();
            throw $ex;
        }
    }

    function delBook($bookid, $bt, $ot, $yop, $genre, $sold, $lan, $cip) {
        global $conn;
        try {
            $conn->beginTransaction(); //SQL transaction
            //delete book table, prepared statement
            $delbook = "DELETE FROM book WHERE BookID = :bookid";
            $stmt = $conn->prepare($delbook);
            // bind parameters
            $stmt->bindValue(':bookid', $bookid);
            $stmt->execute();
            //commit
            $conn->commit();   
        }
        catch(PDOException $ex) { 
            $conn->rollBack();
            throw $ex;
        }
    }
?>