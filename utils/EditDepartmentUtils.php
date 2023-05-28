<?php

$deptId = $_GET['deptId'];

//Get department details
$query = "SELECT * FROM department WHERE deptId = '$deptId'";
$result = mysqli_query($conn, $query);

$row = mysqli_fetch_assoc($result);


//Set variables
$deptName = $row['deptName'];
$deptHod = $row['deptHod'];


//If there is no HOD
if( $deptHod == 0 ){
    $deptHodEmail = NULL;    
}
else{


    $query1 = "SELECT email FROM user WHERE userId = $deptHod";
    $result1 = mysqli_query($conn, $query1);


    if( !$result1){
        echo "<script>alert('INVALID EMAIL') </script>";
        header("location: ../pages/SuperAdmin/manageDepartment.php");
        exit(0);
    }

    $row = mysqli_fetch_assoc($result1);
    $deptHodEmail = $row['email'];

}


?>