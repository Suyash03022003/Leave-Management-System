<?php

include ('../includes/_db_conn.php');
$conn = sql_conn();
$email = $_GET['email'];

if (isset($_POST['submit'])) {
    $emailval = $_POST['email'];
    $fullname = $_POST['fullname'];
    $deptid = $_POST['deptid'];
    $joining = $_POST['joining'];
    $staff = $_POST['staff'];
    $position = $_POST['position'];
    $query = "UPDATE user SET email='$emailval',fullname='$fullname',deptId='$deptid',joiningDate='$joining',userType='$staff',position='$position' WHERE email = '$email'";
    $result = mysqli_query($conn, $query);
    
    if ($result) {
        header("location: ../pages/SuperAdmin/manageEmployees.php");
        exit(0);
    } else {
        echo "User Not Updated!";
        exit(0);
    }
}

?>
