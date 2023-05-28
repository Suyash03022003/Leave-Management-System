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
    <link rel="stylesheet" href="../../css/leaveHistory.css?v=<?php echo time(); ?>">
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
            <h1 class="heading">Leave History</h1>
            <div class="User">
                <table class="tablecontent" width="100%" class="table table-hover" id="dataTables-example">

                    <!-- $db = mysqli_connect("localhost", "root", "", "") or die("connectiion Failed"); -->
                    <?php
                    $email = $_SESSION['email'];
                    $sql1 = "SELECT * FROM leavedetails where userId = (SELECT deptHod FROM department INNER JOIN user ON department.deptHod = user.userId where email = '$email') ";

                    $res = mysqli_query($conn, $sql1);

                    if (mysqli_num_rows($res) > 0) { ?>
                        <thead>
                            <tr>
                                <th>Leave Type</th>
                                <th>From</th>
                                <th>To</th>
                                <th>Reason</th>
                                <th>Application Date</th>
                                <th>Action</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                    <?php } ?>

                    <tbody>
                        <?php
                        while ($row = mysqli_fetch_assoc($res)) {
                        ?>
                            <tr>
                                <td> <?php echo $row['leaveType']  ?> </td>
                                <td><?php echo $row['startDate'] ?> </td>
                                <td><?php echo $row['endDate'] ?></td>
                                <td><?php echo $row['reason'] ?></td>

                                <td><?php echo $row['dateTime'] ?></td>
                                <td class="text-end">
                                    <a href="users.php?editid=<?php echo $row['userId'] ?>" class="btn btn-outline-info btn-rounded"><i class="fas fa-pen view"></i></a>
                                    <a href="users.php?sid=<?php echo $row['userId'] ?>" class="btn btn-outline-danger btn-rounded"><i class="fas fa-trash view"></i></a>
                                </td>
                                <td> <?php echo $row['status'] ?> </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                    <!-- for  Delete button  -->
                    <?php
                    if (isset($_GET['sid'])) {
                        include "config.php";
                        $sid = $_GET['sid'];
                        $sql = "DELETE FROM serviceprovider WHERE sid=$sid";
                        $result = mysqli_query($db, $sql) or die("die in uses.php delete function");
                    }

                    if (isset($_GET['editid'])) {
                        include "config.php";
                        $editid = $_GET['editid'];
                        // $sql= "DELETE FROM serviceprovider WHERE sid=$editid";
                        // $result=mysqli_query($db,$sql) or die("die in uses.php edit function");
                    }
                    ?>


                </table>
            </div>
        </div>
    </section>
</body>

</html>