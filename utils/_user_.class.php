<?php
//  Connect database 

    define( "DB" , "bit_leave_management_system");
    require ('../includes/_db_conn.php');

?>


<?php 

//  Declare User Class 

    /*
    @class "User"
    @description "User class that will define properties and methods related to user only"
    */


    class User{

        public $name  ;
        public $deptId  ;
        public $userType  ;
        public $position  ;
        public $email  ;
        public $id  ;

        /*
        @function "__contruct"
        @description "Contructor 
                        --> Establish connection with database
                        --> set's object's email
                        --> check's user is valid or not"
        */

        public function __construct( $email )
        {
            $conn = sql_conn(); //get connection from database
            $this->email = $email;

            if( $this->isValidUser($conn , $email) ){ //Check's if User is valid or not


                //Starting the Session
                session_start();

                //Defining the values in sessions so that it can be used throughout the project
                $_SESSION['fullname'] = $this->name;
                $_SESSION['deptId'] = $this->deptId;
                $_SESSION['userType'] = $this->userType;
                $_SESSION['position'] = $this->position;
                $_SESSION['email'] = $this->email;
                $_SESSION['id'] = $this->id;


            }
             
        }

        /*
        @function "isValidUser"
        @description "Check Whether the user is valid or not"
        @returns { return true or false} 
        */

        public function isValidUser( $conn , $email ){

            // SQL Query to check whether user with this email exists or not
            $sql = "SELECT * FROM " .DB. ".user WHERE email = '".$email. "'";

            $result =  mysqli_query( $conn , $sql);
            $rows = mysqli_fetch_array($result); // Response


            if( !empty( $rows ) ){

                // set position
                 $this->name = $rows['fullName'];
                 $this->deptId = $rows['deptId'];
                 $this->userType = $rows['userType'];
                 $this->position = $rows['position'];
                 $this->id = $rows['userId'];

                return true;
                
            }
            else return false;

        }

        public static function getUserLeaveData( $email ){

            $conn = sql_conn(); //get connection from database
            $sql = "SELECT * FROM " .DB. ".leavebalance inner join leavetransaction on leavetransaction.transactionId = leavebalance.lastTransaction inner join user on user.userId = leavebalance.userId and leavetransaction.leaveId = leavebalance.leaveId where email = '".$email. "'";

            $result =  mysqli_query( $conn , $sql);


            return $result;

        }


    }


?>


<?php  
//Runs the Function to validate and store user information

    function setUser(){

        try{

            // email from POST request
            $email = $_POST['email'];

            // creating a new obj of user
            $newUser = new User($email);
            echo json_encode($newUser);

        }catch(Exception $err){
            return $err;
        }

    }

?>

<?php

    if( isset( $_POST['function'] )  ){ //Check whether Function exists or not

        if( $_POST['function'] == "getUserLeaveData" ){ //for getUserLeaveData function 

            //Get Result
            $result =  User::getUserLeaveData($_POST['email']) ;


            $tableRows = "";
            
            while( $row = mysqli_fetch_array($result) ) {
                
                $tableRows  = $tableRows.
                " <tr>
                    <form method='post' action='../pages/SuperAdmin/editLeaves.php' >
                    
                        <td> ". $row['leaveType'] . "</td>
                        <td> ". $row['balance'] . "</td>
                        <td> ". date( 'd-m-Y H:i' , strtotime( $row['date'] ) )  . "</td>
                        <td> ". $row['reason'] . "</td>
                        <td><a href='../../pages/SuperAdmin/editLeaves.php?userId=" . $row['userId'] . "&leaveId=" . $row['leaveId'] . "' name='manage' class='btn' > Manage </a></td>
                    </form>
                </tr>";                
            }
            

            $table = 
            "<table class='tablecontent'>
            <thead>
            <tr>
            <th>LEAVE TYPE</th>
            <th>BALANCE</th>
            <th>LAST UPDATED ON</th>
            <th>REASON</th>
            <th></th>
            </tr>
            </thead>
            
            <tbody id='tbody'>"
            . $tableRows . 
            
            "</tbody> 
            </table>" ;

            echo $table;
            
        }
        
        if( $_POST['function'] == "setUser" ){

            return setUser();

        }

    }

?>


