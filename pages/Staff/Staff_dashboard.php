<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../css/common.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../../css/Staff_dashboard.css">
    <script src="https://kit.fontawesome.com/65712a75e6.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
</head>

<body>
    <?php
    include "../../includes/Staff_SideNavbar.php";
    include('../../includes/_db_conn.php');
    include('../../includes/Authentication_verified.php');

    $conn = sql_conn();

    $email = $_SESSION['email']

    ?>
    <section class="home-section">
        <?php
        include "../../includes/nav.php";
        ?>
        <div class="text container">Dashboard</div>
        <div class="container bg-white rounded-lg shadow-lg mt-3 ">
            <div class="row p-3 rounded-lg shadow-lg d-flex justify-content-sm-center  " style="transition: all all 0.5s ease; border-right:6px solid #11101D">
                <?php $sql1 = "SELECT * FROM leavebalance INNER JOIN user ON user.userId = leavebalance.userId where email = '$email'"; 
                $res = mysqli_query($conn, $sql1) or die("result failed in table");
                while ($row = mysqli_fetch_assoc($res)) { ?>
                    <div class="col-md-3 col-sm-12  rounded-lg m-3 bg-white shadow-lg fit-content" style="border-right:6px solid #11101D ">
                        <div class="row p-2 pr-0 ">
                            <!-- <div class="col-3 pl-3 pt-2   "><i class="fa-solid fa-users " style="font-size:25px; text-align: center;"></i></div> -->
                            <div class="col-12  ">
                                <div class="row pb-1 pl-2 d-flex justify-content-sm-center">
                                    <h5><?php echo $row['leaveType'] ?></h5>
                                </div>
                                <div class="row d-flex justify-content-sm-center ">
                                    <!-- PHP CODE HERE -->
                                    <h3><?php echo $row['balance'] ?></h3>
                                </div>
                            </div>
                        </div>
                        <div class="row border-top p-2">
                            <small class="text-muted" style="font-size: smaller;">Nice</small>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>

        <!-- Table  for latest Leave Reqquest -->
        <div class="content mt-3 row rounded-lg">
            <div class="container clg-12  bg-white rounded-lg  " style="transition: all all 0.5s ease; border-right:6px solid #11101D">
                <div class="page-title p-4">
                    <h3> Latest Leave Application
                        <a href="roles.html" class="btn btn-sm btn-outline-primary float-end"><i class="fas fa-user-shield"></i> Roles</a>
                    </h3>
                </div>
                <div class="box box-primary">
                    <div class="box-body">
                        <table width="100%" class="table table-hover" id="dataTables-example">
                            
                             <!-- $db = mysqli_connect("localhost", "root", "", "") or die("connectiion Failed"); -->
                            <?php $sql1 = "SELECT * FROM leavedetails Limit 5";
                            $res = mysqli_query($conn, $sql1) or die("result failed in table");
                           
                            if (mysqli_num_rows($res) > 0) { ?>
                                <thead>
                                    <tr>
                                        <th>Leave Type</th>
                                        <th>From</th>
                                        <th>To</th>
                                        <th>Reason</th>
                                        <th>Posting Date</th>
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
                                            <a href="users.php?editid=<?php echo $row['userId'] ?>" class="btn btn-outline-info btn-rounded"><i class="fas fa-pen"></i></a>
                                            <a href="users.php?sid=<?php echo $row['userId'] ?>" class="btn btn-outline-danger btn-rounded"><i class="fas fa-trash"></i></a>
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
            </div>
        </div>

    </section>

</body>

</html>