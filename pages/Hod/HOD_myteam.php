<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../css/common.css">
    <link rel="stylesheet" href="../../css/HOD_myteam.css">
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
            <h1 class="heading">My Team</h1>
            <div class="User">

                <table class="tablecontent">
                    <?php
                    $deptId = $_SESSION['deptId'];
                    $sql1 = "SELECT * FROM User where deptId = '$deptId' AND position ='FACULTY' ";
                    $res = mysqli_query($conn, $sql1) or die("result failed in table");

                    if (mysqli_num_rows($res) > 0) { ?>
                        <thead>
                            <tr>
                                <th>UserID</th>
                                <th>Full Name</th>
                                <th>Email</th>
                                <th>Potion</th>
                                <th>Joining Date</th>
                                <th>View Details</th>

                            </tr>
                        </thead>
                    <?php } ?>

                    <tbody id="tbody">
                        <?php
                        while ($row = mysqli_fetch_assoc($res)) {
                        ?>
                            <tr>
                                <td> <?php echo $row['userId']  ?> </td>
                                <td><?php echo $row['fullName'] ?></td>
                                <td><?php echo $row['email'] ?> </td>
                                <td><?php echo $row['position'] ?></td>
                                <td><?php echo $row['joiningDate'] ?></td>



                                <td class="text-end">
                                    <a href="users.php?editid=<?php echo $row['userId'] ?>"><i class="fa-solid fa-eye view"></i></a>
                                </td>
                                <!-- <td> Approved</td> -->
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</body>

</html>