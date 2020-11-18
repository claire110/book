<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book mangement system</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <h2>Updated history</h2>
    <div class="container1">
      <table>
        <tr>
          <th id="row1">Book ID</th>
          <th>Book Title</th>
          <th>Last Updated by</th>
          <th>Created Time</th>
          <th>Last Updated Time</th>
        </tr>
      </table>
        <?php 
          $updatelog = "SELECT book.BookID,book.BookTitle, changelog.dateCreated,changelog.dateChanged,changelog.userID,users.firstName,users.lastName
          FROM ((book INNER JOIN changelog
          on book.BookID = changelog.BookID)INNER JOIN users ON changelog.userID = users.userID)
          ORDER BY book.BookID ASC";

          $stmt1 = $conn->prepare($updatelog);
          $stmt1->execute();
          $result = $stmt1->fetchAll();

          if($stmt1->rowCount()< 1 ) {
          echo "No book has been created.";
          } else {
            foreach($result as $row) {
        ?>
      <table>
        <tr>
          <td id="row1"><?php echo $row['BookID']; ?></td>
          <td><?php echo $row['BookTitle']; ?></td>
          <td><?php echo $row['firstName'].'&nbsp'.$row['lastName']; ?></td>
          <td> <?php echo $row['dateCreated']; ?></td>
          <td><?php echo $row['dateChanged']; ?></td>
        </tr>
      </table>
        <?php
          }
        }
        ?>
    </div>
</body>
</html>