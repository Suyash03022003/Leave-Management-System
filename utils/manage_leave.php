<?php

$leaveId = $_GET['leaveId'];
$userId = $_GET['userId'];

//Run query to get leave details
$query = "SELECT * FROM leavebalance inner join leavetransaction on leavetransaction.transactionId = leavebalance.lastTransaction WHERE leavebalance.leaveId = $leaveId and leavebalance.userId = $userId ";

$result = mysqli_query($conn, $query);

$row = mysqli_fetch_assoc($result);

//Define Values here
$leaveTypeval = $row['leaveType'];
$lastUpdatedOnval = $row['date'];
$balanceval = $row['balance'];


$query = "SELECT fullName FROM user WHERE userId = $userId ";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);

$userNameval = $row['fullName'];

?>