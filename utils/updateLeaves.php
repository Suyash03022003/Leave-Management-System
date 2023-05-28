<?php
include('../includes/_db_conn.php');
$conn = sql_conn();

$userId = $_GET['userId'];
$leaveId = $_GET['leaveId'];

if (isset($_POST['submit'])) {
    
    //get values
    $balance = $_POST['balance'];
    $reason = $_POST['reason'];

    $date = date( 'Y-m-d H:i' );

    //Create a transaction with status pending
    $query = "INSERT INTO `leavetransaction` (`transactionId`, `userId`, `leaveId`, `date`, `reason`, `status`, `balance`) VALUES (NULL, $userId, $leaveId, '$date', '$reason' , 'PENDING' , $balance)";
    $result = mysqli_query($conn, $query);
    
    //If query is successfull
    if( $result ){
        
        //Get the transactionId of transaction that we inserted
        $query = "SELECT transactionId from leavetransaction where userId = $userId and leaveId='$leaveId' and date='$date' ORDER by date DESC";
        $result = mysqli_fetch_assoc( mysqli_query($conn, $query ) );

        $lasttransaction = $result['transactionId'];

        //update leavebalance and give recent trasnaction id
        $query = "UPDATE leavebalance SET balance=$balance , lastTransaction=$lasttransaction WHERE userId = '$userId' and leaveId=$leaveId";
        $result = mysqli_query($conn, $query);

        //If transactionId is updated in leavebalance then
        if ($result) {

            //update transaction status to SUCCESSFULL
            $query = "UPDATE leavetransaction SET status='SUCCESSFULL' WHERE userId = '$userId' and leaveId=$leaveId ORDER by date DESC ";
            $result = mysqli_query($conn, $query);
            header("location: ../pages/SuperAdmin/manageLeaves.php");
            exit(0);
            
        } else {
            
            $query = "UPDATE leavetransaction SET status='UNSUCCESSFULL' WHERE userId = '$userId' and leaveId=$leaveId";
            $result = mysqli_query($conn, $query);
            
            echo "Leaves Not Updated!";
            exit(0);
        }
        
    }
    else{
   
        echo "ERROR OCCURED";
        exit(0);
    }
    



}
?>