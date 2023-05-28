<?php
$selectedLeaveType = $_POST['leaveType'];
include "./includes/_db_conn.php";
$sql1 = "SELECT * FROM leavebalance where userId= (SELECT userId FROM User where email = '$email') ";
  $res = mysqli_query($conn, $sql1) or die("result failed in table");
  while ($row = mysqli_fetch_assoc($res)) { ?>
   <?php $balance =  $row['balance'] ?>
<?php } ?>