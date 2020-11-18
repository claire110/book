<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book mangement system</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="registration">
        <h2>Registration Form</h2>
        <form action="../../controller/regProcessnewusers.php" method="post">
            <div class="container1">
                <label for="uname">Username</label>
                <input type="text" 
                       placeholder="Enter Username" 
                       name="username" 
                       pattern="(?!.*fuck)[A-Za-z]{3,128}"
                       title="3 characters at least"
                       required>

                <label for="psw">Password</label>
                <input type="password" 
                       placeholder="Enter Password" 
                       name="password" 
                       minlength="4"
                       title="at least 4 or more characters"
                       required>

                <label for="role">Role</label>
                <input type ="radio" name=role value="Admin"> Admin
                <input type ="radio" name=role value="User"> User<br>

                <label for="name">Firstname</label>
                <input type="text" 
                       placeholder="Enter Firstname" 
                       name="firstname" 
                       pattern="(?!.*fuck)[A-Za-z]{3,128}"
                       title="3 characters at least"
                       required>
              
                <label for="Lastname">Lastname</label>
                <input type="text" 
                       placeholder="Enter Lastname" 
                       name="lastname" 
                       pattern="(?!.*fuck)[A-Za-z]{3,128}"
                       title="3 characters at least"
                       required>

                <label for="email">Email</label>
                <input type="email" 
                       placeholder="Enter Email" 
                       name="email" 
                       pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" 
                       title="an email must be in the following order: 
                       characters@characters.domain"
                       required>

                <input type="hidden" name="actiontype" value="reg"/>
                <input type="submit" value="Submit"/>			
	         <input type="button" onclick="location.href='?link=viewbooks';" value="Cancel" />
            </div>
        </form>
    </div>
</body>
</html>