<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Mangement System</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <header>
        <h1>Book mangement system</h1>
        <div style="padding:1em; text-shadow: 2px 2px 5px black;">
          <p>Welcome <b><?php echo $_SESSION['login'] ?></b>! You have successfully logged in. 
          <a style="color:red" href="../../controller/logoutProcess.php">Logout?</a>
        <div>
    </header>
    <nav>
        <ul class="topnav">
            <li><a href="?link=viewbooks">View Books</a></li>
            <li><a href="?link=addbooks">Add Books</a></li>
            <li><a href="?link=showlog">Update History</a></li>
            <?php 
            if(isset($_SESSION['rights'])) {
              if ($_SESSION['rights'] == 'Admin') {
                echo '<li><a href="?link=addusers">Create new users</a></li>';
                }
            }
           ?>
            <li><a href="../../controller/logoutProcess.php">Logout</a></li>
        </ul>
    </nav>
</body>
</html>
