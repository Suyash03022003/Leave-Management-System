<!DOCTYPE html>
<?php error_reporting(0); ?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../css/common.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../../css/manageUser.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../../css/HOD_myteam.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../../css/HOD_viewUserDetails.css?v=<?php echo time(); ?>">
</head>

<body>
    <?php
    include "../../includes/Authentication_verified.php";
    include "../../includes/HOD_SideNavbar.php";
    include('../../includes/_db_conn.php');
    $conn = sql_conn();
    $userid = $_GET['userId'];
    $query = "SELECT * FROM user WHERE userId = $userid";
    $run_query = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($run_query);

    $dept = $row['deptId'];
    $query_fetchingDept = "SELECT * FROM department WHERE deptId = $dept";
    $run_query_fetchingDept = mysqli_query($conn, $query_fetchingDept);
    $row_dept = mysqli_fetch_assoc($run_query_fetchingDept);
    $deptName = $row_dept['deptName'];

    $query_fetch_leavebalance = "SELECT * FROM leavebalance WHERE userId = $userid";
    $run_query_fetch_leavebalance = mysqli_query($conn, $query_fetch_leavebalance);
    ?>
    <section class="home-section">
        <?php
        include "../../includes/nav.php";
        ?>
        <div class="manageUserMain">
            <h1 class="heading"><?php echo $row['fullName'] ?> (<?php echo $row['position'] ?>)</h1>
            <div class="profileContainer">
                <p><span>Email: </span><?php echo $row['email'] ?></p>
                <p><span>Department: </span><?php echo $deptName ?></p>
                <p><span>Joining Date: </span><?php echo $row['joiningDate'] ?></p>
                <p><span>Staff: </span><?php echo $row['userType'] ?></p>
                <p><span><?php echo $row['status'] ?></span> User</p>
            </div>
            <div class="userleavebalance">
                <p class="leavebalancehead">Leave Balance</p>
                <table class="tablecontent" width="100%">
                    <thead>
                        <tr>
                            <th>Sr. No.</th>
                            <th>Leave Type</th>
                            <th>Balance</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        while ($row_fetch_leavebalance = mysqli_fetch_assoc($run_query_fetch_leavebalance)) {
                        ?>
                            <tr>
                                <td><?php echo $i ?> </td>
                                <td><?php echo $row_fetch_leavebalance['leaveType'] ?> </td>
                                <td><?php echo $row_fetch_leavebalance['balance'] ?></td>
                            </tr>
                        <?php $i++;
                        } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</body>

</html>