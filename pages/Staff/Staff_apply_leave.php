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
  include "../../includes/Staff_SideNavbar.php";
  include('../../includes/_db_conn.php');
  $conn = sql_conn();
  ?>
  <section class="home-section">
    <div class="horizontal_navbar">
      <h1 class="Heading_Heder"> Bajaj Institute Technology Wardha</h1>
    </div>
    <div class="container mt-2 d-flex justify-content-center ">
      <?php

      $email = $_SESSION['email'];
      $sql1 = "SELECT * FROM leavebalance where userId= (SELECT userId FROM User where email = '$email')";

      $res = mysqli_query($conn, $sql1) or die("result failed in table");

      while ($row = mysqli_fetch_assoc($res)) { ?>

        <?php $balance =  $row['balance'] ?>

      <?php } ?>

      <?php
      $email = $_SESSION['email'];


      ?>
      <form action="../../utils/insertLeave.php" method="POST" class="bg-white shadow pl-5 pr-5 pb-5 pt-2 mt-5 rounded-lg " style="border-right:6px solid #11101D;">

        <h4 class="pb-3 pt-2" style="color: #11101D;">Apply for Leave</h4>
        <div class="form-row">
          <div class="form-group col-md-6">
            <!-- <label for="inputEmail4">Email</label> -->
            <?php
            $email = $_SESSION['email'];
            $sql1 = "SELECT * FROM user where email = '$email'";
            $res = mysqli_query($conn, $sql1) or die("result failed in table");
            $row = mysqli_fetch_assoc($res) ?>
            <input type="email" readonly class="form-control border-top-0 border-right-0 border-left-0 border border-dark bg-white" id="inputEmail4" placeholder=" Email*" name="email" value="<?php echo $row['email'] ?>">
          </div>
          <div class="form-group col-md-6">
            <!-- <label for="inputPassword4">Password</label> -->
            <?php
            $deptId = $_SESSION['deptId'];
            $sql1 = "SELECT * FROM department where deptId = '$deptId'";
            $res = mysqli_query($conn, $sql1) or die("result failed in table");
            $row = mysqli_fetch_assoc($res) ?>
            <input type="text" readonly class="form-control bg-white border-top-0 border-right-0 border-left-0 border border-dark " id="inputEmail4" placeholder="Department" name="dept" value="<?php echo $row['deptName'] ?>">
          </div>

        </div>
        <div class="form-row">
          <div class="form-group col-md-6">
            <select required id="leaveTypeId" name="leaveType" class="form-control border-top-0 border-right-0 border-left-0 border border-dark" data-toggle="tooltip" data-placement="top" title="Select Leave Type" name="leaveType">
              <option value="" disable>Choose Leave Type *</option>
              <?php $sql1 = "SELECT * FROM masterdata";
              $res = mysqli_query($conn, $sql1) or die("result failed in table");
              while ($row = mysqli_fetch_assoc($res)) { ?>
                <option value="<?php echo $row['leaveType'] ?>"><?php echo $row['leaveType'] ?></option>
              <?php } ?>
            </select>
          </div>




          <div class="form-group col-md-6">
            <input type="text" readonly name="date" class="form-control bg-white border-top-0 border-right-0 border-left-0  border border-dark" id="inputPassword4" placeholder="Today Date" value="<?php echo date("Y/m/d") ?>">
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-3">
            <input type="text" name="fromDate" data-toggle="tooltip" data-placement="top" title="Start Leave Date" placeholder="From*" onfocus="(this.type='date')" onblur="(this.type='text')" class="form-control border-top-0 border-right-0 border-left-0  border border-dark" id="fromDateId" placeholder="To" required>

          </div>

          <div class="form-group col-md-2">
            <select required name="fromType" class="form-control border-top-0 border-right-0 border-left-0 border border-dark" id="fromDateId1">
              <option selected disabled>Day Type*</option>
              <option value="FirstHalf">First Half</option>
              <option value="SecondHalf">Second Half</option>
              <option value="Full">Full</option>
            </select>
          </div>

          <div class="form-group col-md-3">
            <input type="text" required name="toDate" data-toggle="tooltip" data-placement="top" title="End Leave Date" placeholder="To*" onfocus="(this.type='date')" onblur="(this.type='text')" class="form-control border-top-0 border-right-0 border-left-0  border border-dark" id="toDateId" placeholder="To">
          </div>
          <div class="form-group col-md-2">
            <select required id="toTypeId" name="toType" class="form-control border-top-0 border-right-0 border-left-0 border border-dark">
              <option selected disabled>Day Type*</option>
              <option value="FirstHalf">First Half</option>
              <option value="SecondHalf">Second Half</option>
              <option value="Full">Full</option>
            </select>
          </div>
          <div class="form-group col-md-2">
            <input type="number" name="totalDays" placeholder="Total Days*" data-toggle="tooltip" data-placement="top" title="Total Leave Days" class="form-control border-top-0 border-right-0 border-left-0  border border-dark" id="totalDaysId">
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

        <!-- Date calculator -->
        <script>
          var endDate;
          var startDate;
          const leaveType = document.getElementById('leaveTypeId');
          const startDateInput = document.getElementById('fromDateId');
          const endDateInput = document.getElementById('toDateId');
          const totalDaysInput = document.getElementById('totalDaysId');
          const todayType = document.getElementById('toTypeId');
          const fromdayType = document.getElementById('fromDateId1');


          // Add event listeners to the date inputs
          leaveType.addEventListener('change', findLeaveType);
          startDateInput.addEventListener('change', calculateTotalDays);
          endDateInput.addEventListener('change', calculateTotalDays);
          todayType.addEventListener('change', calculateMondayAndHoliday);
          // fromdayType.addEventListener('change', calculateMondayAndHoliday);


          var balance = 0; //Initial Balance

          // Function to find leave type and count leave type 
          function findLeaveType() {
            // Taking Leave Value From Dropdown
            var leaveTypeValue = leaveType.value;
            // Create a new XMLHttpRequest object
            var xhttp = new XMLHttpRequest();
            // Define the PHP script URL and set the request as asynchronous
            var phpScriptUrl = "your-php-script.php";
            xhttp.open("POST", phpScriptUrl, true);
            // Set the appropriate HTTP header for the request
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            // Define the callback function to handle the server response
            xhttp.onreadystatechange = function() {
              if (this.readyState === 4 && this.status === 200) {
                // Response received, do something with it if needed
                balance = parseInt(this.responseText);
                console.log(balance)
              }
            };
            // Send the AJAX request with the JavaScript variable as data
            xhttp.send("leaveTypeValue=" + encodeURIComponent(leaveTypeValue));
          }


          // Function to Calculate Total Day 
          function calculateTotalDays() {

            startDate = new Date(startDateInput.value);
            endDate = new Date(endDateInput.value);
            if (startDate > endDate) {
              alert("Invalid date range. Please ensure that the start date is before the end date.");
              endDateInput.value = " "
            } else {
              // Calculate the difference in days
              const timeDiff = endDate.getTime() - startDate.getTime();
              const totalDays = Math.floor(timeDiff / (1000 * 60 * 60 * 24)) + 1;
              // Display the total days in the input field
              totalDaysInput.value = totalDays;

              // To Check Balance is sufficent or not 
              if (balance < totalDays) {
                alert("insufficient leave Balance !! Try Another Dates");
                endDateInput.value = " "
                totalDaysInput.value = " ";
              }
              // To det default value of day type 
              document.getElementById("toTypeId").selectedIndex = 0;
            }

          }
          // Calculate Monday and if user takes FirstHalf day on monday then sandwich is not happend 
          function calculateMondayAndHoliday() {

            startDate = new Date(startDateInput.value);
            endDate = new Date(endDateInput.value);
            console.log(endDate)
            const selectedToValue = todayType.value;
            const selectedFromValue = fromdayType.value;
            console.log(selectedFromValue)


            // console.log(selectedToValue)
            const dayOfWeek = endDate.getDay();
            // console.log(dayOfWeek);
            var jsonArray = <?php echo $jsonArray; ?>;
            // console.log(jsonArray[0].date);

            // The function "isDateInRange" calculates holidays if a FirstHalf-day is present to the next day's holiday
            function isDateInRange(inputDate, startDate, endDate) {
              const input = new Date(inputDate);
              const EndDate = new Date(endDate);
              input.setDate(input.getDate() + 1); //to find next day of  holiday
              console.log(EndDate)
              return EndDate.getTime() === input.getTime(); //Compaire EndDate and next day of holiday
            }

            var z = 0;
            for (z = 0; z < jsonArray.length; z++) {
              var inputDate = jsonArray[z].date;
              console.log(inputDate)
              if (selectedToValue === "FirstHalf" && selectedFromValue === "Full") {
                const isInRange = isDateInRange(inputDate, startDate, endDate);
                console.log(isInRange)
                if (isInRange) {
                  alert("It is a {Description} holiday on the previous day!");
                  // alert("Date range is valid.");
                  // Calculate the difference in days
                  const timeDiff = endDate.getTime() - startDate.getTime();
                  const totalDays = Math.floor(timeDiff / (1000 * 60 * 60 * 24));
                  // Display the total days in the input field
                  totalDaysInput.value = totalDays;
                  break;
                } else {
                  const timeDiff = endDate.getTime() - startDate.getTime();
                  const totalDays = Math.floor(timeDiff / (1000 * 60 * 60 * 24)) + 0.5;
                  // Display the total days in the input field
                  totalDaysInput.value = totalDays;
                }
              }
            }

            if (selectedFromValue === "FirstHalf" && selectedToValue === "FirstHalf") {
              const timeDiff = endDate.getTime() - startDate.getTime();
              alert("hello")
              const totalDays = Math.floor(timeDiff / (1000 * 60 * 60 * 24));
              // Display the total days in the input field
              totalDaysInput.value = totalDays;
            } else if (selectedFromValue === "FirstHalf" && selectedToValue === "Full") {
              const timeDiff = endDate.getTime() - startDate.getTime();
              const totalDays = Math.floor(timeDiff / (1000 * 60 * 60 * 24)) + 0.5
              // Display the total days in the input field
              totalDaysInput.value = totalDays;
            } else if (selectedFromValue === "SecondHalf" && selectedToValue === "SecondHalf") {
              const timeDiff = endDate.getTime() - startDate.getTime();
              const totalDays = Math.floor(timeDiff / (1000 * 60 * 60 * 24))
              // Display the total days in the input field
              totalDaysInput.value = totalDays;
            } else if (selectedFromValue === "Full" && selectedToValue === "Full") {
              const timeDiff = endDate.getTime() - startDate.getTime();
              const totalDays = Math.floor(timeDiff / (1000 * 60 * 60 * 24)) + 1
              // Display the total days in the input field
              totalDaysInput.value = totalDays;
            } else if (selectedFromValue === "SecondHalf" && selectedToValue === "Full") {
              const timeDiff = endDate.getTime() - startDate.getTime();
              const totalDays = Math.floor(timeDiff / (1000 * 60 * 60 * 24)) + 0.5
              // Display the total days in the input field
              totalDaysInput.value = totalDays;
            }
            //If Sunday and the next day of Sunday are half days, calculate the total day
            if (dayOfWeek === 1 && selectedToValue === "FirstHalf") {
              alert("It's Monday!");
              // alert("Date range is valid.");
              // Calculate the difference in days
              const timeDiff = endDate.getTime() - startDate.getTime();
              const totalDays = Math.floor(timeDiff / (1000 * 60 * 60 * 24));
              // Display the total days in the input field
              totalDaysInput.value = totalDays;
            }


          }
        </script>

        <!-- Reason -->

        <div class="form-row mb-4">


          <input type="text" required class="form-control bg-white border-top-0 border-right-0 border-left-0 border border-dark " id="inputEmail4" placeholder="Enter Reason*" name="reason">

        </div>

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
            <input type="text" name="lecDate" onfocus="(this.type='date')" onblur="(this.type='text')" placeholder="Lecture Date" class="form-control border-top-0 border-right-0 border-left-0  border border-dark" id="lecDateId">
          </div>
          <div class="form-group col-md-2">
            <input type="text" name="lecStartTime" onfocus="(this.type='time')" onblur="(this.type='text')" placeholder="Start Time" class="form-control border-top-0 border-right-0 border-left-0  border border-dark" id="inputPassword4">
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



        <script>
          const lectureDate = document.getElementById('lecDateId');
          lectureDate.addEventListener('change', isLectureDateInRange);

          function isLectureDateInRange() {
            var date = new Date(lectureDate.value);
            startDate = new Date(startDateInput.value);
            endDate = new Date(endDateInput.value);

            if (!(date >= startDate && date <= endDate)) {
              alert("Date is invalid! Choose a date between Your Leave Dates");
              lectureDate.value = " "
            }
          }
        </script>




        <!-- Task Adjustment -->

        <div class="form-row" id="dynamicadd1">
          <div class="form-group col-md-3">
            <select id="inputState" name="taskAdjustedWith" class="form-control border-top-0 border-right-0 border-left-0 border border-dark">
              <option selected disable>Task Adjust With.. </option>
              <?php $sql1 = "SELECT * FROM user";
              $res = mysqli_query($conn, $sql1) or die("result failed in table");
              while ($row = mysqli_fetch_assoc($res)) { ?>
                <option><?php echo $row['email'] ?></option>

              <?php } ?>
            </select>

          </div>
          <div class="form-group col-md-3">
            <input type="text" name="taskName" placeholder="Task Name" class="form-control border-top-0 border-right-0 border-left-0  border border-dark">
          </div>
          <div class="form-group col-md-2">
            <input type="text" name="taskFromDate" onfocus="(this.type='date')" onblur="(this.type='text')" placeholder="From" class="form-control border-top-0 border-right-0 border-left-0  border border-dark" id="inputPassword4">
          </div>
          <div class="form-group col-md-2">
            <input type="text" name="taskToDate" onfocus="(this.type='date')" onblur="(this.type='text')" placeholder="To" class="form-control border-top-0 border-right-0 border-left-0  border border-dark" id="inputPassword4">
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
      $('#dynamicadd').append('<div class="form-row" id="form-row' + i + '"><div class="form-group col-md-3"> <select id="inputState" name="adjustedWith" class="form-control border-top-0 border-right-0 border-left-0 border border-dark"><option selected disable>Lecture Adjust With.. </option><?php $sql1 = "SELECT * FROM user";
                                                                                                                                                                                                                                                                                                    $res = mysqli_query($conn, $sql1) or die("result failed in table");
                                                                                                                                                                                                                                                                                                    while ($row = mysqli_fetch_assoc($res)) { ?> <option><?php echo $row['email'] ?></option><?php } ?></select></div><div class="form-group col-md-2"><input type="text" onfocus="(this.type="date")" onblur="(this.type="text")"   placeholder="Lecture Date" class="form-control border-top-0 border-right-0 border-left-0  border border-dark" id="inputPassword4" > </div><div class="form-group col-md-2"><input type="text" onfocus="(this.type="date")" onblur="(this.type="text")"  placeholder="start Time" class="form-control border-top-0 border-right-0 border-left-0  border border-dark" id="inputPassword4" ></div><div class="form-group col-md-2"><input type="text"  onfocus="(this.type="time")"onblur="(this.type="text")" placeholder="End Time" class="form-control border-top-0 border-right-0 border-left-0  border border-dark" id="inputPassword4" ></div> <div class="form-group col-md-2"> <input type="text" name="lecture[]" placeholder="Subject" class="form-control border-top-0 border-right-0 border-left-0  border border-dark" id="inputPassword4"></div><div class="form-group col-sm-12 col-md-1"><button type="button" id="' + i + '" class="btn btn-danger remove_row">-</button></div> </div>');
    });
    $('#add1').click(function(e) {
      alert('Want to Adjust Lecture');
      e.preventDefault();
      j++;
      $('#dynamicadd1').append('<div class="form-row" id="form-row' + j + '"><div class="form-group col-md-3"><select id="inputState" name="adjustedWith1" class="form-control border-top-0 border-right-0 border-left-0 border border-dark"><option selected disable>Task Adjust With.. </option><?php $sql1 = "SELECT * FROM user";
                                                                                                                                                                                                                                                                                                  $res = mysqli_query($conn, $sql1) or die("result failed in table");
                                                                                                                                                                                                                                                                                                  while ($row = mysqli_fetch_assoc($res)) { ?> <option><?php echo $row['email'] ?></option><?php } ?></select></div><div class="form-group col-md-3"><input type="text" name="sem" placeholder="Task Name" class="form-control border-top-0 border-right-0 border-left-0  border border-dark"></div><div class="form-group col-md-2"><input type="text" name="lecDate" onfocus="(this.type="date")" onblur="(this.type="text")" placeholder="From" class="form-control border-top-0 border-right-0 border-left-0  border border-dark" id="inputPassword4"></div><div class="form-group col-md-2"><input type="text" name="lecDate" onfocus="(this.type="date")" onblur="(this.type="text")" placeholder="To" class="form-control border-top-0 border-right-0 border-left-0  border border-dark" id="inputPassword4"></div><div class="form-group col-sm-12 col-md-1"><button type="button" id="' + j + '" class="btn btn-danger remove_row">-</button></div> </div>');
    });
    $(document).on('click', '.remove_row', function() {
      var row_id = $(this).attr("id");
      $('#form-row' + row_id + '').remove();
    });
  });
</script>

</html>