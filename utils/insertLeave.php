<?php
include('../includes/_db_conn.php');
$conn = sql_conn();

if (isset($_POST['submit'])) {

  
    //Get variables

    $email = $_POST['email'];
    $date = $_POST['date'];
    $leaveType = $_POST['leaveType'];

    $leave_start_date = $_POST['fromDate'];
    $leave_start_date_type = $_POST['fromType'];
    
    $leave_end_date = $_POST['toDate'];
    $leave_end_date_type = $_POST['toType'];

    $totalDays = $_POST['totalDays'];
    $reason = $_POST['reason'];


    //Query to fetch userId from email
    $query = " Select * from user where email = '$email' ";
    $result = mysqli_fetch_assoc ( mysqli_query( $conn , $query ) );

    $userId = $result['userId'];

    //Query to add data into leavedetails

    $query = " INSERT INTO leavedetails( leaveInsId , userId , status , dateTime , leaveType, startDate , startDateType , endDate , endDateType, totalDays, reason ) VALUES ( NULL ,  $userId , 'PENDING' , '$date' , '$leaveType' , '$leave_start_date' , '$leave_start_date_type' ,  '$leave_end_date' , '$leave_end_date_type' , $totalDays , '$reason') ";

    $result = mysqli_query($conn , $query);

    //If error Occures
    if( !$result ){

      echo 
      "<script>
      
          alert('Error occured during adding data ');
          window.location.href = '../pages/Hod/HOD_apply_leave.php'

      </script> ";

    }


    //----------------------------- HAndling Lecture Adjustments-----------------------------------//

    //handle Lecture Adjustments
    $total_lec_adjustments =  $_POST['totalLec'];
    $adjustedWith = $_POST['lec-adjustedWith-$0'];


    //If NO lecture is adjusted
    if( $total_lec_adjustments == 1 && $adjustedWith == "Lecture Adjust With.."  ){

      header("location: ../pages/Hod/leave_history.php");
      exit(0);

    }


    //Get Leave instance Id

    $query = "SELECT * from leavedetails where dateTime = '$date' and userId = $userId";
    $result = mysqli_fetch_assoc( mysqli_query($conn , $query) );

    $leaveInsId = $result['leaveInsId'];


    //For every lecture adjustment

    for( $i = 0 ; $i <= $total_lec_adjustments ; $i++ ){

        $adjustedWith = $_POST['lec-adjustedWith-$'.$i.''];

        //Get User id with adjustedwith faculty
        $query = " SELECT * from user where email = '$adjustedWith' " ;
        $result = mysqli_fetch_assoc( mysqli_query($conn , $query) );

        $adjustedWith = $result['userId'];


        $adjustmentDate = $_POST['lec-date-$'.$i.''];
        $lecStartTime = $_POST['lec-startTime-$'.$i.''];
        $lecEndTime = $_POST['lec-endTime-$'.$i.''];
        $sem = $_POST['lec-sem-$'.$i.''];
        $sub = $_POST['lec-sub-$'.$i.''];

        //Query to add data into lectureAdjutment

        $query = " INSERT INTO lectureadjustment( lecAdjustId , leaveInsId , applicantId , adjustedWith , status , date, startTime , endTime , semester , subject ) VALUES ( NULL , $leaveInsId ,  $userId , $adjustedWith , 'PENDING' , '$adjustmentDate' , '$lecStartTime' , '$lecEndTime' , '$sem' ,  '$sub') ";

        $result = mysqli_query($conn , $query);

        // Errro Handling
        if( !$result ){
         
          echo 
          "<script>
          
              alert('Error occured during adjusting lectures ');
              window.location.href = '../pages/Hod/HOD_apply_leave.php'
    
          </script> ";
          
        }


    }

    //----------------------------- HAndling Task Adjustments-----------------------------------//



}

?>