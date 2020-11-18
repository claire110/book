<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book mangement system</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <?php
       // prepare sql
       $sql = "SELECT * FROM(((author INNER JOIN book ON author.AuthorID = book.AuthorID)
       INNER JOIN bookplot ON book.BookID = bookplot.BookID))
       INNER JOIN changelog ON bookplot.BookID = changelog.BookID
       WHERE book.BookID = '{$_GET['BookID']}'";  
          
       $stmt = $conn->prepare($sql);
       $stmt->execute();
       $result = $stmt->fetch(PDO::FETCH_ASSOC);	 
    ?>  

    <div class="addnew">
       <h2>Edit book: <?php echo $result['BookTitle'] ?></h2>
	<form action="../../controller/editBookProcess.php"  method="post">
            <div class="container1">
 
                <h3>About Author</h3>
                <input type="hidden" 
                       name=authorid 
                       value="<?php echo $result['AuthorID'] ?>" 
                       >

                <label for="name">Author Name</label>
                <input type="text" 
                       placeholder="Author Name"
                       maxlength="30"  
                       name="name"
                       value="<?php echo $result['Name'] ?>" 
                       required>

                <label for="asurname">Author Surname</label>
                <input type="text" 
                       placeholder="Author Surname" 
                       maxlength="30"  
                       name="surname"
                       value="<?php echo $result['Surname'] ?>" 
                       required>

                <label for="anation">Author Nationality</label>
                <input type="text" 
                       placeholder="Author Nationality"
                       maxlength="50"  
                       name="nationality"
                       value="<?php echo $result['Nationality'] ?>"
                       required>

                <label for="abirth">Year Of Birth</label>
                <input type="number" 
                       placeholder="Author Birth Year" 
                       name="yob" 
                       value="<?php echo $result['BirthYear'] ?>"
                       required>

                <label for="adeath">Year Of Death</label>
                <input type="number" 
                       placeholder="Author Death Year"
                       value="<?php echo $result['DeathYear'] ?>" 
                       name="yod">
            

                <h3>Book information</h3>
                <input type="hidden"
                       name=bookid 
                       value="<?php echo $result['BookID'] ?>" 
                       >

                <label for="booktitle">Book Title</label>
                <input type="text" 
                       placeholder="Enter Book title" 
                       name="bt"
                       value="<?php echo $result['BookTitle'] ?>" 
                       maxlength="200"
                       required>

                <label for="orgtitle">Original Title</label>
                <input type="text" 
                       placeholder="Original Title" 
                       value="<?php echo $result['OriginalTitle'] ?>"
                       name="ot"
                       maxlength="200"   
                       required>

                <label for="yearpub">Year Of Publication</label>
                <input type="number" 
                       placeholder="Year Of Publication" 
                       name="yop"
                       value="<?php echo $result['YearofPublication'] ?>" 
                       required>

                <label for="genre">Genre</label>
                <input type="text" 
                       placeholder="Genre" 
                       name="genre"
                       value="<?php echo $result['Genre'] ?>" 
                       maxlength="200"
                       required>

                <label for="msold">Millions Sold<label>
                <input type="number" 
                       placeholder="Millions sold" 
                       name="sold"
                       value="<?php echo $result['MillionsSold'] ?>" 
                       maxlength="30"
                       required>

                <label for="lang">Language Written</label>
                <input type="text" 
                       placeholder="Language Written" 
                       name="lan"
                       value="<?php echo $result['LanguageWritten'] ?>" 
                       maxlength="30" 
                       required>

                <label for="path">Cover image path</label>
                <input type="text" 
                       placeholder="Cover image path" 
                       name="cip"
                       value="<?php echo $result['coverImagePath'] ?>" 
                       required>

                <h3>Bookplot information</h3>
                <input type="hidden" 
                       name= "bpid" 
                       value="<?php echo $result['BookPlotID'] ?>" 
                       >

                <label for="plot">Plot</label>
                <input type="text" 
                       placeholder="Book Plot" 
                       name="plot" 
                       value="<?php echo $result['Plot'] ?>" 
                       maxlength="2000"
                       required>

                <label for="plotsource">PlotSource</label>
                <input type="url" 
                       placeholder="PlotSource" 
                       name="ps" 
                       value="<?php echo $result['PlotSource'] ?>" 
                       required>

                <!-- Changelog information -->
                <input type="hidden" 
                       name= "changelogid" 
                       value="<?php echo $result['changeLogID'] ?>" 
                       >  
                <input type="hidden" 
                       name= "dcreated" 
                       value="<?php echo $result['dateCreated'] ?>" 
                       >
                <input type="hidden" 
                       name= "dchanged" 
                       value="<?php echo $result['dateChanged'] ?>" 
                       >
                <input type="hidden" 
                       name= "bookid" 
                       value="<?php echo $result['BookID'] ?>" 
                       > 
                <input type="hidden" 
                       name= "userid" 
                       value="<?php echo $result['userID'] ?>" 
                       >                  

                <input type="hidden" name="actiontype" value="editbook">
			    <input type="submit" value="Submit">
			    <input type="button" onclick="location.href='?link=viewbooks';" value="Cancel" />   
            </div>
       </form>
    </div>
</body>
</html>