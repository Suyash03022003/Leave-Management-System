<?php

include('../../utils/_leave_admin_.class.php');

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
</head>

<body>
    <?php
    include "../../includes/super_admin_SideNavbar.php";
    ?>
    <section class="home-section">
        <?php
        include "../../includes/nav.php";
        ?>
        <div class="manageUserMain">

            <h1 class="heading">Add Leave Type</h1>

            <form class="addUserDiv" action="addLeaveType.php" method="POST">

                <div class="rows"><label>Leave Type ( Leave Name ): </label><input type="text" name="leaveType"></div>
                <div class="rows"><label>Leave Interval ( in months ) </label><input type="number" name="leaveInterval"></div>
                <div class="rows"><label>Leave Increment </label><input type="number" name="increment"></div>
                <div class="rows"><label>Leave Description</label><textarea type="text" height="300px" width="200px" name="leaveDesc"></textarea></div>
                <input type="submit" name="submit" class="submitbtn">

            </form>
        </div>
    </section>
</body>

</html>