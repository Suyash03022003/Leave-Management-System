
<?php


define( "DB" , "bit_leave_management_system");
require ('../../includes/_db_conn.php');

$conn = sql_conn();

include('../../utils/manage_leave.php');

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../../css/common.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../../css/addUser.css?v=<?php echo time(); ?>">
    <title>Bajaj Institute of Technology, Wardha</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
 
</head>

<body>
    <?php
    include "../../includes/super_admin_SideNavbar.php";
    ?>
    <section class="home-section">
        <?php
        include "../../includes/nav.php";
        ?>
        <div class=" mt-2 d-flex justify-content-center ">

      <form action="../../utils/updateLeaves.php?leaveId=<?php echo $leaveId?>&userId=<?php echo 
      $userId?>" method="POST" class="bg-white shadow pl-5 pr-5 pb-5 pt-2 mt-5 rounded-lg " style="border-right:6px solid #11101D;">

        <h4 class="pb-3 pt-2" style="color: #11101D;">Update Leaves</h4>


        <div class="form-row">
          <div class="form-group col-md-12">
            <!-- <label for="inputEmail4">Email</label> -->

            <span  class="form-control border-top-0 border-right-0 border-left-0 border-bottom-0  border-dark bg-white" id="inputEmail4" name="userName" > Employee Name : <?php echo $userNameval?> </span>
          </div>
        </div>

        <div class="form-row">
          <div class="form-group col-md-12">
            <!-- <label for="inputEmail4">Email</label> -->

            <span  class="form-control border-top-0 border-right-0 border-left-0 border-bottom-0  border-dark bg-white" id="inputEmail4" name="leaveType" > Leave Type : <?php echo $leaveTypeval?> </span>
          </div>
        </div>

        <div class="form-row">
          <div class="form-group col-md-12">
            <!-- <label for="inputEmail4">Email</label> -->

            <span  class="form-control border-top-0 border-right-0 border-left-0 border-bottom-0  border-dark bg-white" id="inputEmail4" name="leaveDesc" > Last Updated On : <?php echo date('d-m-Y' , strtotime($lastUpdatedOnval))  ?> </span>
          </div>
        </div>

        <div class="form-row">
          <div class="form-group col-md-12">
            <!-- <label for="inputEmail4">Email</label> -->
            <input type="number"  class="form-control border-top-0 border-right-0 border-left-0 border  border-dark bg-white" id="inputEmail4" placeholder="Balance" name="balance" value="<?php echo $balanceval?>">
          </div>
        </div>

        <div class="form-row">
          <div class="form-group col-md-12">
            <!-- <label for="inputEmail4">Email</label> -->
            <input type="text"  class="form-control border-top-0 border-right-0 border-left-0 border  border-dark bg-white" id="inputEmail4" placeholder="Reason" name="reason" value="">
          </div>
        </div>
       
        <button type="submit" name="submit" class="btn mt-2" style="background-color: #11101D; color: white;">Submit</button>
      </form>
    </div>
        
    </section>
</body>

</html>