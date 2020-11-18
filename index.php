<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Mangement System</title>
    <link rel="stylesheet" href="view/css/style.css">
</head>
<body>
    <header>
      <h1>Book Mangement System</h1>
    </header>

    <article>
      <div class="login">
        <h2>Login Page</h2>
        <form action="controller/loginProcess.php" method="post">
          <fieldset class="containerindex">
            <label for = "uname">Username:</label>
            <input type="text" id="uname" name="username">
            <label for="upass">Password:</label>
            <input type="password" id="upass" name="password">
            <input type="submit" value="Login">
          </fieldset>
         </form>
      </div>
    </article> 

    <footer>
      <p>
        © TAFE Claire Wang 2020
      </p>
    </footer>
</body>
</html>
