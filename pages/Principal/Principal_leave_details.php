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
    <link rel="stylesheet" href="../../css/leave_approval.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../../css/Staff_dashboard.css?v=<?php echo time(); ?>">
    <script src="https://kit.fontawesome.com/65712a75e6.js" crossorigin="anonymous"></script>
</head>

<body>
    <?php
    include "../../includes/Principal_SideNavbar.php";
    include('../../includes/_db_conn.php');
    include "../../includes/Authentication_verified.php";
    $conn = sql_conn();
    $leave_id = $_GET['id'];

    $query = "SELECT * FROM leavedetails WHERE leaveInsId = $leave_id";

    $run_query = mysqli_query($conn, $query);

    $fecth_row_query = mysqli_fetch_assoc($run_query);
    $name = $fecth_row_query['userId'];

    $fetch_name = "SELECT fullName FROM user WHERE userId = $name";

    $fetch_name_result = mysqli_query($conn, $fetch_name);
    $fetched_name_row = mysqli_fetch_assoc($fetch_name_result);

    ?>
    <section class="home-section">
        <?php
        include "../../includes/nav.php";
        ?>
        <div class="manageUserMain">
            <h1 class="heading">Leaves Applicant - <?php echo $fetched_name_row['fullName'] ?></h1>
            <div class="User">

                <div class="leaveDetails">

                    <p><label>Leave Type: </label><span><?php echo $fecth_row_query['leaveType'] ?></span></p>

                    <div class="start">
                        <p><label>From: </label><span><?php echo $fecth_row_query['startDate'] ?></span></p>
                        <p><span><?php echo $fecth_row_query['startDateType'] ?> Day</span></p>
                    </div>
                    <div class="end">
                        <p><label>To: </label><span><?php echo $fecth_row_query['endDate'] ?></span></p>
                        <p><span><?php echo $fecth_row_query['endDateType'] ?> Day</span></p>
                    </div>

                    <p><label>Applying Date: </label><span><?php echo $fecth_row_query['dateTime'] ?></span></p>

                    <p><label>Reason: </label><span><?php echo $fecth_row_query['reason'] ?></span></p>

                    <p><label>Status: </label><span><?php echo $fecth_row_query['status'] ?></span></p>


                </div>
                <div class="action">
                    <a href="../../utils/principal_approve.php?id=<?php echo $leave_id?>"><p class="approve"><i class="fa-solid fa-check"></i><span>Approve</span></p></a>
                    <a href="../../utils/principal_reject.php?id=<?php echo $leave_id?>"><p class="reject"><i class="fa-solid fa-xmark"></i><span>Reject</span></p></a>
                </div>
            </div>
        </div>
    </section>
</body>

</html>