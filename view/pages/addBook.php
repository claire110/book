<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Mangement System</title>
    <link rel="stylesheet" href="../css/style.css">
<body>
    <div class="addnew">
        <h2>Add new book</h2>
        <form action="../../controller/addBookProcess.php" method="post">
            <div class="container1">
                <!-- author tabel -->
                <h3>About Author</h3>
                <label for="name">Author Name</label>
                <input type="text" 
                       placeholder="Author Name"
                       maxlength="30"  
                       name="name" 
                       required>

                <label for="asurname">Author Surname</label>
                <input type="text" 
                       placeholder="Author Surname" 
                       maxlength="30"  
                       name="surname" 
                       required>

                <label for="anation">Author Nationality</label>
                <input type="text" 
                       placeholder="Author Nationality"
                       maxlength="50"  
                       name="nationality" 
                       required>

                <label for="abirth">Year Of Birth</label>
                <input type="number" 
                       placeholder="Author Birth Year" 
                       name="yob" 
                       required>

                <label for="adeath">Year Of Death</label>
                <input type="number" 
                       placeholder="Author Death Year" 
                       name="yod">

                <!-- book tabel -->
                <h3>Book information</h3>
                <label for="booktitle">Book Title</label>
                <input type="text" 
                       placeholder="Enter Book title" 
                       maxlength="200"  
                       name="bt" 
                       required>

                <label for="orgtitle">Original Title</label>
                <input type="text" 
                       placeholder="Original Title"
                       maxlength="200" 
                       name="ot" 
                       required>

                <label for="yearpub">Year Of Publication</label>
                <input type="number" 
                       placeholder="Year Of Publication"
                       name="yop" 
                       required>

                <label for="genre">Genre</label>
                <input type="text" 
                       placeholder="Genre" 
                       maxlength="200" 
                       name="genre" 
                       required>

                <label for="msold">Millions Sold<label>
                <input type="number" 
                       placeholder="Millions sold" 
                       maxlength="30" 
                       name="sold" 
                       required>

                <label for="lang">Language Written</label>
                <input type="text" 
                       placeholder="Language Written"
                       maxlength="30" 
                       name="lan" 
                       required>

                <label for="path">Cover image path</label>
                <input type="text" 
                       placeholder="../images/default.png" 
                       name="cip" 
                       required>
                       
                <!-- bookplot table -->
                <h3>Bookplot information</h3>
                <label for="plot">Plot</label>
                <input type="text" 
                       placeholder="Enter Book Plot" 
                       maxlength="2000"
                       name="plot" 
                       required>

                <label for="plotsource">PlotSource</label>
                <input type="url" 
                       placeholder="Enter PlotSource" 
                       name="ps" 
                       required>

                <input type="hidden" name="actiontype" value="addbook">
		  <input type="submit" value="Submit">
		  <input type="button" onclick="location.href='?link=viewbooks';" value="Cancel"/>   
            </div>
        </form>
    </div>
</body>
</html>