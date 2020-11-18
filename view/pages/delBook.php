<?php
  // prepare sql
  $sql = "SELECT * FROM book WHERE BookID = '{$_GET['BookID']}'";
  $stmt = $conn->prepare($sql);
  $stmt->execute();
  $result = $stmt->fetch(PDO::FETCH_ASSOC);	 
  ?> 
<div class="delinfo" style="margin:2em;">
    <form action="../../controller/delBookProcess.php" method="post">
      <p style="margin-bottom:2em;"> Do you want to delete :"<?php echo $result['BookTitle'] ?>"?</p>
        <input type="hidden" name="bookid" value="<?php echo $_GET['BookID'] ?>">
        <input type="hidden" name="actiontype" value="delbook">
        <input type="submit" value="   OK   ">
        <input type="button" onclick="location.href='dashboard.php';" value="Cancel" />
    </form>
</div>
