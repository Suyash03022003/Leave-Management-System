<?php

include ('../includes/_db_conn.php');
$conn = sql_conn();

//After User has submitted form
if (isset($_POST['submit'])) {
    
    //Take necessary details
    $email = $_POST['email'];
    $fullname = $_POST['fullname'];
    $deptId = $_POST['deptId'];
    $joining = $_POST['joining'];
    $staff = $_POST['staff'];
    $user = $_POST['user'];

    //Add Data to user table
    $query = "INSERT INTO user(email, fullName, deptId, joiningDate, userType, position) VALUES ('$email','$fullname','$deptId','$joining','$staff','$user')";
    $result = mysqli_query($conn, $query);
    
    //Get the userId
    $query = "SELECT userId from user where email='$email'";
    $result = mysqli_query($conn, $query);

    $row = mysqli_fetch_assoc($result);
    $userId = $row['userId'];
    
    //get masterdata details
    $query = "SELECT * from masterdata";
    $result = mysqli_query($conn, $query);
    
    //Iterate masterdata to create 0 balance instance in leavebalance table
    foreach ($result as $cols) {

        $leaveId = $cols['leaveId'];
        $leaveType = $cols['leaveType'];
        $date = date( 'Y-m-d H:i' );

        //insert into leavebalance
        $query = "INSERT INTO leavebalance(userId , leaveId , leaveType , balance , lastUpdatedOn ) VALUES ( $userId , $leaveId ,'$leaveType',0, '$date' )";
        $result = mysqli_query($conn, $query);
        
    }
    
    if ($result) {
        header("location: ../pages/SuperAdmin/manageEmployees.php");
        exit(0);
    } else {
        echo "User Not Added!";
        exit(0);
    }
}

?>
