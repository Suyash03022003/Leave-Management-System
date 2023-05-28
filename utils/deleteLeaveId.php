<?php

include ('../includes/_db_conn.php');
$conn = sql_conn();

//Get the variables
$leaveId = $_GET['leaveId'];


//Manage transactions 
$query = "UPDATE leavetransaction SET leaveId=NULL WHERE leaveId='$leaveId' ";
$result = mysqli_query($conn, $query);

if( !$result ){
    echo " alert('ERROR OCCURED DURING ADJUSTING TRANSACTIONS ') ";
    exit(0);
}


//Remove leave balance for that specific leave type
$query = "DELETE FROM leavebalance WHERE leaveId='$leaveId' ";
$result = mysqli_query($conn, $query);

if( !$result ){
    echo " alert('ERROR OCCURED DURING REMOVING EMPLOYEES LEAVES') ";
    exit(0);
}

//Remove leave type form masterdata
$query = "DELETE FROM masterdata WHERE leaveId='$leaveId' ";
$result = mysqli_query($conn, $query);

if( !$result ){
    echo " alert('ERROR OCCURED') ";
    exit(0);
}



if(isset($result)){
    header("Location: http://localhost/Leave-Management-System/pages/SuperAdmin/manageMasterData.php");
}
else
    header("Location: http://localhost/Leave-Management-System/pages/SuperAdmin/manageMasterData.php");  
?>
