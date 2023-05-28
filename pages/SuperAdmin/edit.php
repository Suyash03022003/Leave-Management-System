<?php

include('../../utils/ManageUserUtils.php');
include('../../utils/EditUserUtils.php');

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
      <form action="../../utils/update.php?email=<?php echo $email?>" method="POST" class="bg-white shadow pl-5 pr-5 pb-5 pt-2 mt-5 rounded-lg " style="border-right:6px solid #11101D;">
        <h4 class="pb-3 pt-2" style="color: #11101D;">Update User</h4>
        <div class="form-row">
          <div class="form-group col-md-6">
            <input type="email"  class="form-control border-top-0 border-right-0 border-left-0 border border-dark bg-white" id="inputEmail4" placeholder=" Email" name="email" value="<?php echo $emailval?>">
          </div>
          <div class="form-group col-md-6">
        
            <input type="text"  class="form-control border-top-0 border-right-0 border-left-0 border border-dark bg-white" id="inputEmail4" placeholder=" Email" name="fullname" value="<?php echo $fullnameval?>">
          </div>
          
        </div>
        <div class="form-row ">
          <div class="form-group col-md-6">
          <select name="deptid" class="form-control border-top-0 border-right-0 border-left-0 border border-dark">
                    <option value="Not Selected" selected disabled hidden>Select Department</option>
                    <?php while($row = mysqli_fetch_assoc($result)) {
                    echo "<option value='$row[deptId]'>$row[deptId]. $row[deptName]</option>";
                    } ?>
                </select>
            </div>
          

        

          <div class="form-group col-md-6">
          <select name="staff" class="form-control bg-white border-top-0 border-right-0 border-left-0  border border-dark">
                    <option value="Not Selected" selected disabled hidden>Staff Type</option>
                    <option value="TEACHING_STAFF">TEACHING_STAFF</option>
                    <option value="NON_TEACHING_STAFF">NON_TEACHING_STAFF</option>
                </select>
          </div>

          <div class="form-group col-md-6">
            <input class="form-control bg-white border-top-0 border-right-0 border-left-0  border border-dark" type="date"  placeholder="Joining Date" name="joining" value="<?php echo $joining?>">
          </div>

          <div class="form-group col-md-6">
                <select name="position" class="form-control bg-white border-top-0 border-right-0 border-left-0  border border-dark">
                    <option value="Not Selected" selected disabled hidden>Select Position</option>
                    <option value="PRINCIPAL">PRINCIPAL</option>
                    <option value="HOD">HOD</option>
                    <option value="FACULTY">FACULTY</option>
                    <option value="ADMIN">ADMIN</option>
                </select>
            </div>

            <div class="form-group col-md-6">
                <select name="status" class="form-control bg-white border-top-0 border-right-0 border-left-0  border border-dark">
                    <option value="ACTIVE" selected >ACTIVE</option>
                    <option value="DEACTIVATED" >DEACTIVATED</option>
                </select>
            </div>

          </div>
          <div class="form-group col-md-12 d-flex justify-content-center"  ><input type="submit" name="submit" class="submitbtn">
       </div>
       
      </form>
    </div>


        
    </section>
</body>

</html>