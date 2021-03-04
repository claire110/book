<?php
ob_start();
// Start the session
session_start();

// Set session variables
$_SESSION['time_start_login'] = time();
require("../../model/db.php");
require("../../model/dbFunctions.php");

if (isset($_SESSION['login']) == true) {
  include ("header.php");
?>  
  <article>
    <div class="message">
      <?php 
      if(isset($_SESSION['message'])) {
         echo $_SESSION['message'];
         unset($_SESSION['message']);
      }
      ?>
    </div>
    <?php
      if (isset( $_GET['link'] ) ) {
        $action = $_GET['link'];
        switch ($action){
          case "viewbooks":
          require("viewbooks.php"); break;

          case "addbooks":
          require("addBook.php"); break;

          case "editbook":
          require("editBook.php"); break;

          case "delbook":
          require("delBook.php"); break;

          case "addusers":
          require("registration.php"); break;

          case "showlog":
          require("changelog.php"); break;
        }
      } else {
        include ("viewbooks.php");
      }
    ?>
  </article>
  
<?php
  include ("footer.php");
} else  {
  header("location:../../index.php");  
}
?>