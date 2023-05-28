<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../css/common.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../../css/manageUser.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../../css/leaveHistory.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../../css/HOD.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../../css/Staff_dashboard.css">
    <script src="https://kit.fontawesome.com/65712a75e6.js" crossorigin="anonymous"></script>
</head>

<body>
    <?php
    include "../../includes/HOD_SideNavbar.php";
    include('../../includes/_db_conn.php');
    include "../../includes/Authentication_verified.php";

    $conn = sql_conn();
    ?>
    <section class="home-section">
        <?php
        include "../../includes/nav.php";
        ?>
        <div class="manageUserMain">
            <h1 class="heading">Leaves Applied</h1>
            <div class="User">
                
                <table class="tablecontent leave_table">
                    <?php 
                    $email=$_SESSION['email'] ;
                    // $deptId= $_SESSION['deptId'] ;
                    // $sql1 = "SELECT userId FROM User where email = '$email' ";
                    $sql1 = "SELECT * FROM leavedetails where userId IN (SELECT userId FROM user where deptId = '$_SESSION[deptId]') AND status = 'PENDING'";
                    $res = mysqli_query($conn, $sql1) or die("result failed in table");

                    if (mysqli_num_rows($res) > 0) { ?>
                        <thead>
                            <tr>
                                <th>Applicant Name</th>
                                <th>Leave Type</th>
                                <th>Status</th>
                                <th>View Details</th>
                            </tr>
                        </thead>
                    <?php }
                    
                    else{
                        echo "<p class='heading' >NO REQUESTS AT THIS TIME !!</p>";
                    }    

                    ?>

                    <tbody id="tbody">
                        <?php
                        while ($row = mysqli_fetch_assoc($res)) {
                            $name = $row['userId'];
                            $fetch_name = "SELECT fullName FROM user WHERE userId = $name;";
                            $fetch_name_result = mysqli_query($conn, $fetch_name);
                            $fetched_name_row = mysqli_fetch_assoc($fetch_name_result);
                        ?>
                            <tr>
                                <td><?php echo $fetched_name_row['fullName']  ?> </td>
                                <td><?php echo $row['leaveType']  ?> </td>
                                <td><?php echo $row['status'] ?></td>
                                <td class="text-end">
                                    <a href="HOD_leave_approval.php?id=<?php echo $row['leaveInsId']?>"><i class="fa-solid fa-eye view"></i></a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</body>

</html>