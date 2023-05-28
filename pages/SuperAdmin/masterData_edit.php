<?php


define( "DB" , "bit_leave_management_system");
require ('../../includes/_db_conn.php');

$conn = sql_conn();

include('../../utils/edit_masterData_.php');

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../../css/common.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../../css/addUser.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
 
    <title>Bajaj Institute of Technology, Wardha</title>
</head>

<body>
    <?php
    include "../../includes/super_admin_SideNavbar.php";
    ?>
    <section class="home-section">
        <?php
        include "../../includes/nav.php";
        ?>
        <div class="container mt-2 d-flex justify-content-center ">

      <form action="../../utils/updateMasterData.php?leaveId=<?php echo $leaveId?>" method="POST" class="bg-white shadow pl-5 pr-5 pb-5 pt-2 mt-5 rounded-lg " style="border-right:6px solid #11101D;">

        <h4 class="pb-3 pt-2" style="color: #11101D;">Update Leave</h4>

        <div class="form-row">
          <div class="form-group col-md-6">
            <input type="text"  class="form-control border-top-0 border-right-0 border-left-0 border border-dark bg-white" id="inputEmail4" placeholder=" Leave Type" name="leavetype" value="<?php echo $leaveTypeval?>">
          </div>
          <div class="form-group col-md-6">
        
            <input type="text"  class="form-control border-top-0 border-right-0 border-left-0 border border-dark bg-white" id="inputEmail4" placeholder=" Leave Description" name="leaveDesc" value="<?php echo $leaveDescval?>">
          </div>
          
        </div>

        <div class="form-row ">

          <div class="form-group col-md-6">
            <input class="form-control bg-white border-top-0 border-right-0 border-left-0  border border-dark" type="number"  placeholder="Leave Interval" name="leaveInterval" value="<?php echo $leaveIntervalval?>">
          </div>

          <div class="form-group col-md-6">
            <input class="form-control bg-white border-top-0 border-right-0 border-left-0  border border-dark" type="number"  placeholder="Leave Increment" name="leaveincrement" value="<?php echo $leaveincrementval?>">
          </div>

          <div class="form-group col-md-12 d-flex justify-content-center"  ><input type="submit" name="submit" class="submitbtn">

       </div>
       
      </form>

    </div>


        
    </section>
</body>

</html>