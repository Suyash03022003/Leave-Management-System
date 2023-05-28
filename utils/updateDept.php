<?php
include('../includes/_db_conn.php');
$conn = sql_conn();
$deptId = $_GET['deptId'];

//After form is submitted
if (isset($_POST['submit'])) {

    //Setting variables
    $deptName = $_POST['deptName'];
    $deptHodEmail = $_POST['deptHodEmail'];

    //query to get userId of email
    $query1 = "SELECT userId FROM user WHERE email = '$deptHodEmail'";
    $result1 = mysqli_query($conn, $query1);

    //if user does not exists
    if(  mysqli_num_rows($result1) == 0 ){
        echo "<script> alert('Invalid Email') </script>";
        header("location: ../pages/SuperAdmin/manageDepartment.php");
        exit(0);
    }

    $row = mysqli_fetch_assoc($result1);
    
    $deptHod = $row['userId'];
    
    //Set user as hod for department
    $query = "UPDATE department SET deptName='$deptName', deptHod='$deptHod' WHERE deptId = '$deptId'";
    $result = mysqli_query($conn, $query);

    //Set department in user data
    $query = "UPDATE user SET deptId='$deptId', position='HOD' , userType='TEACHING_STAFF' WHERE userId = '$deptHod'";
    $result = mysqli_query($conn, $query);
    
    if ($result) {
        header("location: ../pages/SuperAdmin/manageDepartment.php");
        exit(0);
    } else {
        echo "<script> alert('Department Not Updated!') </script>";
        exit(0);
    }
}
?>