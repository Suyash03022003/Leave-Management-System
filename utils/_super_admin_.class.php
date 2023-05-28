<?php
//  Connect database 

    define( "DB" , "bit_leave_management_system");
    require ('../../includes/_db_conn.php');

?>


<?php 

//  Declare SuperAdmin Class

    /*
    @class "SuperAdmin"
    @description "SuperAdmin class incorporates all the properties and method related to SuperAdmin"
    */


    class SuperAdmin{

        /*
        @function "__contruct"
        @description "Contructor 
                        --> Establish connection with database
        */

         function __construct()
        {
             //get connection from database

        }
             

        /*
        @function "getTotalEmployee();"
        @description "returns Total no of Employees"
        @returns { return int} 
        */

        public static function getTotalEmployee() {

            // SQL Query to get the count of all employees
            $sql = "SELECT COUNT(userId) FROM " .DB. ".user Where status = 'ACTIVE'";


            $conn = sql_conn();
            $result =  mysqli_query( $conn , $sql);
            $rows = mysqli_fetch_array($result); // Response

            return $rows;

        }

                /*
        @function "getTotalDepartment();"
        @description "returns Total no of Department"
        @returns { return int} 
        */

        public static function getTotalDepartment() {

            // SQL Query to get the count of all departments
            $sql = "SELECT COUNT(deptId) FROM " .DB. ".department";


            $conn = sql_conn();
            $result =  mysqli_query( $conn , $sql);
            $rows = mysqli_fetch_array($result); // Response

            return $rows;

        }

                        /*
        @function "getTotalLeaveTypes();"
        @description "returns Total no of Leave Types"
        @returns { return int} 
        */

        public static function getTotalLeaveTypes() {

            // SQL Query to get the count of all Leave Types
            $sql = "SELECT COUNT(leaveId) FROM " .DB. ".masterData";


            $conn = sql_conn();
            $result =  mysqli_query( $conn , $sql);
            $rows = mysqli_fetch_array($result); // Response

            return $rows;

        }
    
                                /*
        @function "getTotalTeachingStaff();"
        @description "returns Total no of Teaching Staff"
        @returns { return int} 
        */

        public static function getTotalTeachingStaff() {

            // SQL Query to get the count of all Leave Types
            $sql = "SELECT COUNT(userID) FROM " .DB. ".user where userType = 'TEACHING_STAFF' and status='ACTIVE' ";


            $conn = sql_conn();
            $result =  mysqli_query( $conn , $sql);
            $rows = mysqli_fetch_array($result); // Response

            return $rows;

        }

                                        /*
        @function "getTotalNonTeachingStaff();"
        @description "returns Total no of Non-Teaching Staff"
        @returns { return int} 
        */

        public static function getTotalNonTeachingStaff() {

            // SQL Query to get the count of all Leave Types
            $sql = "SELECT COUNT(userID) FROM " .DB. ".user where userType = 'NON_TEACHING_STAFF' and status='ACTIVE'";


            $conn = sql_conn();
            $result =  mysqli_query( $conn , $sql);
            $rows = mysqli_fetch_array($result); // Response

            return $rows;

        }

        public static function getTotakDeactivatedStaff(){

            // SQL Query to get the count of all Leave Types
            $sql = "SELECT COUNT(userID) FROM " .DB. ".user where status = 'DEACTIVATED'";


            $conn = sql_conn();
            $result =  mysqli_query( $conn , $sql);
            $rows = mysqli_fetch_array($result); // Response

            return $rows;


        }
    
    }

?>



