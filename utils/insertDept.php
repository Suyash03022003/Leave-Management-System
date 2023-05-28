<?php

include ('../includes/_db_conn.php');
$conn = sql_conn();

//is form submitted ??
if (isset($_POST['submit'])) {

    //Get values
    $deptName = $_POST['deptName'];
    $deptHodEmail = $_POST['deptHodEmail'];

    //Get userid of the email
    $query = "SELECT userId FROM user WHERE email = '$deptHodEmail'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);

    //If the email does not exist assign null to deptHOD
    if( mysqli_num_rows($result) == 0 ){
      
      //Query to insert data into department
      $query = "INSERT INTO department(deptId, deptName, deptHod) VALUES (NULL, '$deptName',NULL)";
      $result = mysqli_query($conn, $query);

    }else{

      $deptHod = $row['userId'];

      //Query to insert data into department
      $query = "INSERT INTO department(deptId, deptName, deptHod) VALUES (NULL, '$deptName',$deptHod)";
      $result = mysqli_query($conn, $query);

    }
    
    if ($result) {
        header("location: ../pages/SuperAdmin/manageDepartment.php");
        exit(0);
    } else {
        echo "Department Not Added!";
        exit(0);
    }
}

?>

