<?php
include 'mysql.php';
$connection = new createCon();
$connection->connect();

$query = 'SELECT * FROM  `user`';
$result = mysqli_query($connection->myconn, $query);

if($numrows = mysqli_num_rows($result)) {
  echo $numrows;
  while ($row = mysqli_fetch_assoc($result)) {
    $dbusername = $row['User'];
    $dbpassword = $row['Password'];
    echo "<br>".$dbusername."<br>".$dbpassword;
  }
}
?>