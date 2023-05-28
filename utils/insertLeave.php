<?php
include('../includes/_db_conn.php');
$conn = sql_conn();

if (isset($_POST['submit'])) {
  $email = $_POST['email'];
  $dept = $_POST['dept'];
  $leaveType = $_POST['leaveType'];
  $date = $_POST['date'];
  $fromDate = $_POST['fromDate'];
  $fromType = $_POST['fromType'];
  $toDate = $_POST['toDate'];
  $toType = $_POST['toType'];
  $totalDays = $_POST['totalDays'];
  $reason = $_POST['reason'];
  $adjustedWith = $_POST['adjustedWith'];
  $lecDate = $_POST['lecDate'];
  $lecStartTime = $_POST['lecStartTime'];
  $lecEndTime = $_POST['lecEndTime'];
  $sem = $_POST['sem'];
  $subject = $_POST['subject'];
  $taskAdjustedWith = $_POST['taskAdjustedWith'];
  $taskName = $_POST['taskName'];
  $taskFromDate = $_POST['taskFromDate'];
  $taskToDate = $_POST['taskToDate'];

  $query1 = "SELECT userId FROM user WHERE email = '$email'";
  $result1 = mysqli_query($conn, $query1);
  $row = mysqli_fetch_assoc($result1);
  $userId = $row['userId'];

  $query = "INSERT INTO leavedetails VALUES( NULL , $userId , 'PENDING' , '$date', '$leaveType', '$fromDate', '$fromType', '$toDate', '$toType', $totalDays, '$reason' , NULL , NULL )";
  $resultLeave = mysqli_query($conn, $query) or die('die in details');

  if ($adjustedWith != "Lecture Adjust With.. ") {
    $query = "Select leaveInsId from leavedetails where dateTime = '$date'";
    $resultLeave = mysqli_query($conn, $query) or die('die in details');
    $row = mysqli_fetch_assoc($resultLeave);
    $leaveInsId = $row['leaveInsId'];

    $query1 = "SELECT userId FROM user WHERE email = '$adjustedWith'";
    $result1 = mysqli_query($conn, $query1);
    $row = mysqli_fetch_assoc($result1);
    $adjustedWith = $row['userId'];

    $query2 = "INSERT INTO lectureadjustment VALUES ( NULL , $leaveInsId , $userId , $adjustedWith , 'PENDING', '$lecDate', '$lecStartTime', '$lecEndTime', $sem, '$subject')";
    $result2 = mysqli_query($conn, $query2) or die('die');

    // $to = "$adjustedWith";
    // $subject = "My subject";
    // $txt = "Hello sir";
    // $sender = "From: $email";
    // if (mail($to, $subject, $txt, $sender)) {
    //   echo "Email Sent Successfully!";
    // }
  }

  if ($taskAdjustedWith != "Task Adjust With.. ") {
    $query = "Select leaveInsId from leavedetails where dateTime = '$date'";
    $resultLeave = mysqli_query($conn, $query) or die('die in details');
    $row = mysqli_fetch_assoc($resultLeave);
    $leaveInsId = $row['leaveInsId'];

    $query1 = "SELECT userId FROM user WHERE email = '$taskAdjustedWith'";
    $result1 = mysqli_query($conn, $query1);
    $row = mysqli_fetch_assoc($result1);
    $taskadjustedWith = $row['userId'];

    $query2 = "INSERT INTO taskadjustment VALUES ( NULL , $leaveInsId , $userId , $taskadjustedWith , 'PENDING', '$taskFromDate', $taskToDate, '$taskName')";
    $result2 = mysqli_query($conn, $query2) or die('die');
    
    // $to = "$adjustedWith";
    // $subject = "My subject";
    // $txt = "Hello sir";
    // $sender = "From: $email";
    // if (mail($to, $subject, $txt, $sender)) {
    //   echo "Email Sent Successfully!";
    // }
  }

  header("location: ../pages/Staff/Staff_dashboard.php");
}
echo "Hello";
?>