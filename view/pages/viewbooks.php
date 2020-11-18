<?php 
// require("../../model/db.php");
// echo 'connected';
  $viewbooks = "SELECT * FROM book INNER JOIN author ON book.AuthorID = author.AuthorID 
  ORDER BY MillionsSold DESC";
  $stmt = $conn->prepare($viewbooks);
  $stmt->execute();
  $result = $stmt->fetchAll();

  if($stmt->rowCount()< 1 ) {
  echo "Sorry, there are no books.";
  } else {
    foreach( $result as $row ) {
?>
  <div class="flex-container">
    <div class="view">
      <figure>
        <img src="<?php echo $row['coverImagePath'];?>">
        <figcaption>
          <p class="info"><?php echo $row['BookTitle']; ?></p>
          <p class="info">Publication Year: <?php echo $row['YearofPublication']; ?></p>
          <p class="info">Author: <?php echo $row['Name']." ".$row['Surname']; ?></p>
          <p class="info">Sold Numbers(Million): <?php echo $row['MillionsSold']; ?></p>
          <a class="info" href="?link=editbook&BookID=<?php echo $row['BookID']; ?>">
            <button type="button">Update</button>
          </a>
          <a class="info" href="?link=delbook&BookID=<?php echo $row['BookID']; ?>">
            <button type="button">Delete</button>
          </a> 
        <figcaption>
      </figure>  
    </div>
  </div>
<?php
  }
}
?>