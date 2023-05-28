<?php

  include('../includes/_db_conn.php');
  $conn = sql_conn();

if( isset( $_POST['function'] )  ){

    if( $_POST['function'] == "getLeaveType" ){

        //get details
        $leaveType =  $_POST['leaveType'];
        $email = $_POST['email'];

        //Query to get balance
        $query = "SELECT balance from leavebalance where leaveType = '$leaveType' and userId=( SELECT userId from user where email='$email' ) ";
        $result = mysqli_query( $conn , $query );
        $result = mysqli_fetch_assoc($result);

        echo $result['balance'] ;
    
    }

    else if( $_POST['function'] == "getSandwichLeaves" ){

        //get details
        $startDate =  $_POST['startDate'];
        $endDate = $_POST['endDate'];

        $query = "SELECT * from holidays where date between '$startDate' and '$endDate' ORDER BY date DESC";

        $result = mysqli_query( $conn , $query );
        $output = array();

        while( $item =  mysqli_fetch_assoc($result) ){

            array_push( $output , date( 'Y-m-d' ,  strtotime($item['date'])) );

        }


        $answer = array();
        $index = 1;
        $count = 0;

        for( $i = 0 ; $i <= sizeof($output) ; $i++ ){
            
            array_push( $answer , array_search( date( 'Y-m-d' ,  strtotime( '-'. $index .' day' ,  strtotime($endDate))) , $output ) );
            
            if(  array_search( date( 'Y-m-d' ,  strtotime( '-'. $index .' day' ,  strtotime($endDate))) , $output )  != "" || date( 'l' , strtotime(''.date( 'Y-m-d' ,  strtotime( '-'. $index .' day' ,  strtotime($endDate))).'') ) == 'Sunday' ){

                $index++;
                $count++;
                
            }else{
                
                array_push( $answer , array_search( date( 'Y-m-d' ,  strtotime( '-'. $index .' day' ,  strtotime($endDate))) , $output ));
                break;
            }

        }
            

       echo $count;

    }

}



?>