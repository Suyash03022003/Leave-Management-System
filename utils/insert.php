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
    $query = "SELECT * from department where deptId='$deptId'";
    $result = mysqli_fetch_assoc( mysqli_query($conn, $query) );

    echo "<script> alert( " . $result['deptHod'] . " ) </script>";
    

    //If there is already hod for that specific department
    if( $result['deptHod'] != 0  && $user == 'HOD' ){

            echo "<script>
            alert('CANNOT ASSIGN MORE THAN 1 HOD ')
            window.location.href = '../pages/SuperAdmin/manageEmployees.php'
            </script>";
            exit(0);

    }

    //Add Data to user table
    $query = "INSERT INTO user(email, fullName, deptId, joiningDate, userType, position) VALUES ('$email','$fullname','$deptId','$joining','$staff','$user')";
    $result = mysqli_query($conn, $query);

    //If successfull
    if( $result )  {

    //Get the userId
    $query = "SELECT * from user where email='$email'";
    $result = mysqli_query($conn, $query);

    if( !$result ){
        echo "alert('ERROR OCCURED )";
        exit(0);
    }

    
    $row = mysqli_fetch_assoc($result);
    $userId = $row['userId'];

    //get masterdata details
    $query = "SELECT * from masterdata";
    $result = mysqli_query($conn, $query);
    
    if( !$result ){
        echo "alert('ERROR OCCURED )";
        exit(0);
    }

    //Iterate masterdata to create 0 balance instance in leavebalance table
    foreach ($result as $cols) {

        $leaveId = $cols['leaveId'];
        $leaveType = $cols['leaveType'];
        $date = date( 'Y-m-d H:i:s' );

        //insert into leavetransaction
        $query = "INSERT INTO leavetransaction( transactionId, userId , leaveId , date , reason , status , balance ) VALUES ( NULL ,  $userId , $leaveId ,'$date', 'New User ( 0 Balance )' , 'PENDING' , 0 )";
        $result = mysqli_query($conn, $query);

        if( $result ){

            //get transactionId
            $query = "SELECT * from leavetransaction where userId='$userId' and leaveId='$leaveId' ORDER BY date DESC ";
            $result = mysqli_fetch_assoc( mysqli_query($conn, $query) );
            $transactionId = $result['transactionId'];

            //insert into leavebalance
            $query = "INSERT INTO leavebalance(userId , leaveId , leaveType , balance , lastTransaction ) VALUES ( $userId , $leaveId ,'$leaveType', 0 , $transactionId )";
            $result = mysqli_query($conn, $query);

            if( $result ){

            //update leavetransaction
            $query = "UPDATE leavetransaction SET status= 'SUCCESSFULL' where transactionId = $transactionId ";
            $result = mysqli_query($conn, $query);


            }

        }
            
    }
    
    if ($result) {
        header("location: ../pages/SuperAdmin/manageEmployees.php");
        // exit(0);
    } else {
        echo "User Not Added!";
        // exit(0);
    }

}

else{
    echo " alert(User Not Added) ";
    exit(0);
}

}


?>
