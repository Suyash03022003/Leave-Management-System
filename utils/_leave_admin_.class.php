<?php
//  Connect database 

    define( "DB" , "bit_leave_management_system");
    require ('../../includes/_db_conn.php');

?>

<?php 


    /*
    @class "LeaveAdmin"
    @description "LeaveAdmin class incorporates all the properties and method related to LeaveAdmin"
    */

    class LeaveAdmin{
             

        /*
        @function "getTotalEmployee();"
        @description "returns Total no of Employees"
        @returns { return int} 
        */

        public static function getMasterData() {

            // SQL Query to get the count of all employees
            $sql = "SELECT * FROM " .DB. ".masterdata";


            $conn = sql_conn();
            $result =  mysqli_query( $conn , $sql);

            $rows = array();

            while( $row = mysqli_fetch_array($result) ) {
                $rows[] = $row;
            }

            return $rows ;

        }

                /*
        @function "findUser();"
        @description "returns The Details of User"
        @returns { return Array}
        */

        public static function findUser() {

            // SQL Query to get the count of all employees
            $sql = "SELECT * FROM " .DB. ".masterdata";


            $conn = sql_conn();
            $result =  mysqli_query( $conn , $sql);

            $rows = array();

            while( $row = mysqli_fetch_array($result) ) {
                $rows[] = $row;
            }

            return $rows ;

        }

        

    
    }

?>


<?php

if (isset($_POST['submit'])) {

    //Get the values
    $leaveType = $_POST['leaveType'];
    $leaveDesc = $_POST['leaveDesc'];
    $leaveInterval = $_POST['leaveInterval'];
    $increment = $_POST['increment'];
    
    $conn = sql_conn();

    //insert into masterdata
    $query = "INSERT INTO masterdata(leaveId , leaveType, leaveDesc, leaveInterval, increment) VALUES (NULL , '$leaveType','$leaveDesc','$leaveInterval','$increment' )";

    $result = mysqli_query($conn, $query);
    
    //If result exists
    if ($result) {
        
        //Get user details
        $query = "SELECT * from user";
        $userInfo = mysqli_query($conn, $query);

        //Get Leave Details
        $query = "SELECT * from masterdata where leaveType='$leaveType'";
        $leaveInfo = mysqli_fetch_assoc( mysqli_query($conn, $query) );

        $leaveId = $leaveInfo['leaveId'];

        //For Every User available
        foreach( $userInfo as $rows ){

            $userId = $rows['userId'];
            $date = date( 'Y-m-d H:i' );

            //start a transaction
            $query = "INSERT INTO leaveTransaction(transactionId , userId , leaveId, date, reason, status, balance) VALUES (NULL ,'$userId','$leaveId' , '$date' , 'New Leave ( 0 Balance )' , 'PENDING' , 0 )";

            $result = mysqli_query($conn, $query);

            if( !$result ) {
                echo "alert('ERROR OCCURED DURING ADDING LEAVES')";
                exit(0);
            }
            else{

            //get transactionId
            $query = "SELECT * from leavetransaction where userId='$userId' and leaveId='$leaveId' ORDER BY date DESC ";
            $result = mysqli_fetch_assoc( mysqli_query($conn, $query) );
            $transactionId = $result['transactionId'];

            }

            //Update Balance
            $query = "INSERT INTO leavebalance(userId , leaveId , leaveType , balance , lastTransaction ) VALUES ( $userId , $leaveId ,'$leaveType', 0 , $transactionId )";
            $result = mysqli_query($conn, $query);

            if( !$result ){
                echo "alert(ERROR OCCURED DURING ADDING BALANCE )";
                exit(0);
            }

            //Close transaction
            $query = "UPDATE leavetransaction SET status= 'SUCCESSFULL' where transactionId = $transactionId ";
            $result = mysqli_query($conn, $query);

            if( !$result ){
                echo "alert(ERROR OCCURED DURING UPDATING TRANSACTION )";
                exit(0);
            }

        }

        header("location: ../../pages/SuperAdmin/manageMasterData.php");
        exit(0);
    } else {
        echo "alert(User Not Added!)";
        exit(0);
    }
}

?>








