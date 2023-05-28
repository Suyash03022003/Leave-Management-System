<?php
include "../../includes/Authentication_verified.php"
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="../../css/sideNavbar_comman.css">
  <link rel="stylesheet" href="../../css/common.css?v=<?php echo time(); ?>">
  <!-- <link rel="stylesheet" href="../../css/Staff_dashboard.css"> -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <!-- <script src="../../js/calcu_total_days.js"></script> -->
</head>

<body>
  <?php
  include "../../includes/HOD_SideNavbar.php";
  include('../../includes/_db_conn.php');
  $conn = sql_conn();
  ?>
  <section class="home-section">



  <!-- //NAvbar -->
    <?php
    include "../../includes/nav.php";
    ?>
    <div class="container mt-2 d-flex justify-content-center ">
   <?php     

  $email = $_SESSION['email'];

  //get leave details of the user
 $sql1 = "SELECT * FROM leavebalance where userId= (SELECT userId FROM User where email = '$email')";

 $res = mysqli_query($conn, $sql1) or die("result failed in table");

 while ($row = mysqli_fetch_assoc($res)) { ?>

   <?php $balance =  $row['balance'] ?>
  
 <?php } ?>
 
      <form action="../../utils/insertLeave.php" method="POST" class="bg-white shadow pl-5 pr-5 pb-5 pt-2 mt-5 rounded-lg " style="border-right:6px solid #11101D;">

        <h4 class="pb-3 pt-2" style="color: #11101D;">Apply for Leave</h4>

        <div class="form-row">
          <div class="form-group col-md-6">

            <?php

            $email = $_SESSION['email'];
            
            //Query to get user details
            $sql1 = "SELECT * FROM user where email = '$email'";
            $res = mysqli_query($conn, $sql1) or die("result failed in table");
            $row = mysqli_fetch_assoc($res) 
            
            ?>

            <!-- //Input Email -->
            <input type="email" readonly class="form-control border-top-0 border-right-0 border-left-0 border border-dark bg-white" id="email" placeholder=" Email" name="email" value="<?php echo $row['email'] ?>">

          </div>

          <div class="form-group col-md-6">

            <?php

            $deptId = $_SESSION['deptId'];

            //Query to get department info
            $sql1 = "SELECT * FROM department where deptId = '$deptId'";
            $res = mysqli_query($conn, $sql1) or die("result failed in table");
            $row = mysqli_fetch_assoc($res) ?>

            <!-- //Department -->
            <input type="text" readonly class="form-control bg-white border-top-0 border-right-0 border-left-0 border border-dark " id="inputEmail4" placeholder="Department" name="dept" value="<?php echo $row['deptName'] ?>">

          </div>

        </div>
        <div class="form-row">

          <div class="form-group col-md-6">

            <select required id="leaveType" name="leaveType" class="form-control border-top-0 border-right-0 border-left-0 border border-dark" data-toggle="tooltip" data-placement="top" title="Select Leave Type" name="leaveType">

              <option value="" disable>Choose Leave Type</option>

              <?php 

              //Query to get leaveTypes
              $sql1 = "SELECT * FROM masterdata";
              $res = mysqli_query($conn, $sql1) or die("result failed in table");

              while ($row = mysqli_fetch_assoc($res)) { ?>

                <option value="<?php echo $row['leaveType'] ?>" >
                 <?php echo $row['leaveType'] ?>
                </option>
                
              <?php } ?>

            </select>

          </div>

          <div class="form-group col-md-6">
            
          <!-- //Get current date -->
            <input type="text" readonly name="date" class="form-control bg-white border-top-0 border-right-0 border-left-0  border border-dark" id="inputPassword4" placeholder="Today Date" value="<?php echo date("Y/m/d") ?>">

          </div>

        </div>

        <div class="form-row">

          <div class="form-group col-md-3">

          <!-- //Get from date -->

            <input type="text" required name="fromDate" data-toggle="tooltip" data-placement="top" title="Start Leave Date" placeholder="From" onfocus="(this.type='date')" onblur="(this.type='text')" class="form-control border-top-0 border-right-0 border-left-0  border border-dark" id="fromDateId" min="<?php echo date('Y-m-d') ?>" >

          </div>

          <div class="form-group col-md-2">

          <!-- //Get from date type-->

            <select required id="fromType" name="fromType" 
            class="form-control border-top-0 border-right-0 border-left-0 border border-dark">

              <option value="" selected disable>Day Type</option>
              <option value="First Half">First Half</option>
              <option value="Second Half">Second Half</option>
              <option value="Full">Full</option>

            </select>
            
          </div>

          <div class="form-group col-md-3">

          <!-- //Get to date -->

            <input type="text" required name="toDate" data-toggle="tooltip" data-placement="top" title="End Leave Date" placeholder="To" onfocus="(this.type='date')" onblur="(this.type='text')" class="form-control border-top-0 border-right-0 border-left-0  border border-dark" id="toDateId" placeholder="To" min="<?php echo date('Y-m-d') ?>"  >

          </div>

          <div class="form-group col-md-2">

          <!-- //Get to date type -->

            <select required id="toType" name="toType" class="form-control border-top-0 border-right-0 border-left-0 border border-dark">

            <option value="" selected disable>Day Type</option>
              <option value="First Half">First Half</option>
              <option value="Second Half">Second Half</option>
              <option value="Full">Full</option>

            </select>

          </div>

          <div class="form-group col-md-2">

          <!-- //total days -->
            <input type="number" name="totalDays" placeholder="Total Days" data-toggle="tooltip" data-placement="top" title="Total Leave Days" class="form-control border-top-0 border-right-0 border-left-0  border border-dark" id="totalDaysId">

          </div>
        </div>
     
        <?php 
        $queryholi = "SELECT date FROM holidays";
        $result = mysqli_query($conn, $queryholi) or die("result failed in table");
        
        // Store the fetched data in an array
        $dataArray = array();
        while ($row = $result->fetch_assoc()) {
          $dataArray[] = $row;
        } 
        $jsonArray = json_encode($dataArray);
        
        ?>


        <script>

        //Declarations

        var endDate;
        var startDate
        var balance ;

        const leaveType = document.getElementById('leaveType');
        const startDateInput = document.getElementById('fromDateId');
        const startDateType = document.getElementById('fromType')
        
        const endDateInput = document.getElementById('toDateId');
        const endDateType = document.getElementById('toType');
        
        const totalDays = document.getElementById('totalDaysId');
          
        
        //Event listener
        endDateType.addEventListener('change', (e)=>{ calculateTotalDays( startDateInput.value , endDateInput.value )});
        leaveType.addEventListener('change', ()=>{ calculateBalance( leaveType.value )});

            
          //Calculate Available balance leaves

          function calculateBalance(leaveType){
              
            // Get email values
            let email = document.getElementById('email');
            email = email.value

            // Runs _user_.class.php file and return user information
                $.ajax({
                      url: "../../utils/leave_apply.php",
                      type: "post",
                      data: {
                          function: "getLeaveType",
                          leaveType,
                          email
                      },
                      success: function(response) {

                        balance = response
                                                                      
                      },
                      error: function(jqXHR, textStatus, errorThrown) {
                          console.log(textStatus, errorThrown);
                          alert('Error occured during calulating current balance')
                      }
                });



          }

          //Calculate Total days

          function calculateTotalDays( startDate , endDate ) {
            
            let newStartDate = new Date( startDate );
            let newEndDate =   new Date( endDate );
            
            
            //validation for dates
            if ( newStartDate > newEndDate ) {
              
              alert("Invalid date range. Please ensure that the start date is before the end date.");
              endDateInput.value = " "
              
            } else {

              //calculate difference
              const timeDiff = newEndDate.getTime() - newStartDate.getTime();
              
              let totaldays = Math.floor(timeDiff / (1000 * 60 * 60 * 24)) ;
              console.log( timeDiff );

              //If enddatetype is full 

            if( endDateType.value === "Full" ){

                if( startDateType.value != 'Full' ){
                  totaldays += 0.5;
                }
                else{
                  totaldays += 1;
                }

                if( balance < totaldays ){
                  console.log(balance);
                  alert(' Insufficient Balance !')
                  // window.location.reload();
                }
                else{
                  // Display the total days in the input field
                  totalDays.value = totaldays;
                }
                
            }

            else if(  endDateType.value !== "Full") {

              //set total days for full and half days
              if( startDateType.value != 'Full' ){
                  totaldays ;
                }
              else{
                totaldays += 0.5;
               }

               //Check for sandwich leaves
               if( endDateType.value === "First Half" ){

                let sandwichleaves = 0

                // Runs _user_.class.php file and return user information
                $.ajax({
                      url: "../../utils/leave_apply.php",
                      type: "post",
                      data: {
                          function: "getSandwichLeaves",
                          startDate,
                          endDate
                      },
                      success: function(response) {

                        alert(" Sandwich Leaves : " + response + " Leaves");

                        sandwichleaves = response
                        totaldays -= sandwichleaves

                        if( balance < totaldays ){
                  console.log(balance);
                  alert(' Insufficient Balance !')
                  // window.location.reload();
                }
                else{
                  // Display the total days in the input field
                  totalDays.value = totaldays;
                }
                                                                      
                      },
                      error: function(jqXHR, textStatus, errorThrown) {
                          console.log(textStatus, errorThrown);
                          alert('Error occured during calulating current balance')
                      }
                });


               }

                }

            else{

              if( balance < totaldays ){
                  console.log(balance);
                  alert(' Insufficient Balance !')
                  // window.location.reload();
                }
                else{
                  // Display the total days in the input field
                  totalDays.value = totaldays;
                }

            }

          }
             }



        </script>
        <!-- Lecture Adjustment Section -->

        <div class="form-row" id="dynamicadd">
          <div class="form-group col-md-3">
            <select id="inputState" name="adjustedWith" class="form-control border-top-0 border-right-0 border-left-0 border border-dark">
              <option selected disable>Lecture Adjust With.. </option>
              <?php $sql1 = "SELECT * FROM user";
              $res = mysqli_query($conn, $sql1) or die("result failed in table");
              while ($row = mysqli_fetch_assoc($res)) { ?>
                <option><?php echo $row['email'] ?></option>

              <?php } ?>
            </select>

          </div>

          <div class="form-group col-md-2">
            <input type="text" name="lecDate" onfocus="(this.type='date')" onblur="(this.type='text')" placeholder="Lecture Date" class="form-control border-top-0 border-right-0 border-left-0  border border-dark" id="inputPassword4">
          </div>
          <div class="form-group col-md-2">
            <input type="text" name="lecStartTime" onfocus="(this.type='time')" onblur="(this.type='text')" placeholder="start Time" class="form-control border-top-0 border-right-0 border-left-0  border border-dark" id="inputPassword4">
          </div>
          <div class="form-group col-md-2">
            <input type="time " name="lecEndTime" onfocus="(this.type='time')" onblur="(this.type='text')" placeholder="End Time" class="form-control border-top-0 border-right-0 border-left-0  border border-dark" id="inputPassword4">
          </div>
          <div class="form-group col-md-1">
            <input type="text" name="sem" placeholder="Sem" class="form-control border-top-0 border-right-0 border-left-0  border border-dark">
          </div>
          <div class="form-group col-md-1">
            <input type="text" name="subject" placeholder="Subject" class="form-control border-top-0 border-right-0 border-left-0  border border-dark" id="inputPassword4">
          </div>
          <div class="form-group col-sm-12 col-md-1">
            <button class=" btn" id="add" name="btn[]" style="background-color: #11101D; color:white">Add</button>
          </div>
        </div>

        <!-- Task Adjustment -->

        <div class="form-row" id="dynamicadd1">
          <div class="form-group col-md-3">
            <select id="inputState" name="adjustedWith1" class="form-control border-top-0 border-right-0 border-left-0 border border-dark">
              <option selected disable>Task Adjust With.. </option>
              <?php $sql1 = "SELECT * FROM user";
              $res = mysqli_query($conn, $sql1) or die("result failed in table");
              while ($row = mysqli_fetch_assoc($res)) { ?>
                <option><?php echo $row['email'] ?></option>

              <?php } ?>
            </select>

          </div>
          <div class="form-group col-md-3">
            <input type="text" name="sem" placeholder="Task Name" class="form-control border-top-0 border-right-0 border-left-0  border border-dark">
          </div>
          <div class="form-group col-md-2">
            <input type="text" name="lecDate" onfocus="(this.type='date')" onblur="(this.type='text')" placeholder="From" class="form-control border-top-0 border-right-0 border-left-0  border border-dark" id="inputPassword4">
          </div>
          <div class="form-group col-md-2">
            <input type="text" name="lecDate" onfocus="(this.type='date')" onblur="(this.type='text')" placeholder="To" class="form-control border-top-0 border-right-0 border-left-0  border border-dark" id="inputPassword4">
          </div>
          <div class="form-group col-sm-12 col-md-1">
            <button class=" btn" id="add1" name="btn1[]" style="background-color: #11101D; color:white">Add</button>
          </div>
        </div>
        <button type="submit" name="submit" class="btn mt-2" style="background-color: #11101D; color: white;">Apply</button>
      </form>
    </div>
  </section>
</body>
<script>
  $(document).ready(function() {
    var i = 1,
      j = 1001;
    $('#add').click(function(e) {
      alert('Want to Adjust Lecture');
      e.preventDefault();
      i++;
      $('#dynamicadd').append('<div class="form-row" id="form-row' + i + '"><div class="form-group col-md-3"> <select id="inputState" name="adjustedWith" class="form-control border-top-0 border-right-0 border-left-0 border border-dark"><option selected disable>Lecture Adjust With.. </option><?php $sql1 = "SELECT * FROM user";$res = mysqli_query($conn, $sql1) or die("result failed in table");while ($row = mysqli_fetch_assoc($res)) { ?> <option><?php echo $row['email'] ?></option><?php } ?></select></div><div class="form-group col-md-2"><input type="text" onfocus="(this.type="date")" onblur="(this.type="text")"   placeholder="Lecture Date" class="form-control border-top-0 border-right-0 border-left-0  border border-dark" id="inputPassword4" > </div><div class="form-group col-md-2"><input type="text" onfocus="(this.type="date")" onblur="(this.type="text")"  placeholder="start Time" class="form-control border-top-0 border-right-0 border-left-0  border border-dark" id="inputPassword4" ></div><div class="form-group col-md-2"><input type="text"  onfocus="(this.type="time")"onblur="(this.type="text")" placeholder="End Time" class="form-control border-top-0 border-right-0 border-left-0  border border-dark" id="inputPassword4" ></div> <div class="form-group col-md-2"> <input type="text" name="lecture[]" placeholder="Subject" class="form-control border-top-0 border-right-0 border-left-0  border border-dark" id="inputPassword4"></div><div class="form-group col-sm-12 col-md-1"><button type="button" id="' + i + '" class="btn btn-danger remove_row">-</button></div> </div>');
    });
    $('#add1').click(function(e) {
      alert('Want to Adjust Lecture');
      e.preventDefault();
      j++;
      $('#dynamicadd1').append('<div class="form-row" id="form-row' + j + '"><div class="form-group col-md-3"><select id="inputState" name="adjustedWith1" class="form-control border-top-0 border-right-0 border-left-0 border border-dark"><option selected disable>Task Adjust With.. </option><?php $sql1 = "SELECT * FROM user";$res = mysqli_query($conn, $sql1) or die("result failed in table");while ($row = mysqli_fetch_assoc($res)) { ?> <option><?php echo $row['email'] ?></option><?php } ?></select></div><div class="form-group col-md-3"><input type="text" name="sem" placeholder="Task Name" class="form-control border-top-0 border-right-0 border-left-0  border border-dark"></div><div class="form-group col-md-2"><input type="text" name="lecDate" onfocus="(this.type="date")" onblur="(this.type="text")" placeholder="From" class="form-control border-top-0 border-right-0 border-left-0  border border-dark" id="inputPassword4"></div><div class="form-group col-md-2"><input type="text" name="lecDate" onfocus="(this.type="date")" onblur="(this.type="text")" placeholder="To" class="form-control border-top-0 border-right-0 border-left-0  border border-dark" id="inputPassword4"></div><div class="form-group col-sm-12 col-md-1"><button type="button" id="' + j + '" class="btn btn-danger remove_row">-</button></div> </div>');
    });
    $(document).on('click', '.remove_row', function() {
      var row_id = $(this).attr("id");
      $('#form-row' + row_id + '').remove();
    });
  });
</script>

</html>