<?php

include('../../utils/ManageUserUtils.php');

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../../css/common.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../../css/manageUser.css?v=<?php echo time(); ?>">
    <title>Bajaj Institute of Technology, Wardha</title>
</head>

<body>
    <?php
    include "../../includes/super_admin_SideNavbar.php";
    ?>
    <section class="emp-home-section">
        <div class="horizontal_navbar">
            <h1 class="Heading_Heder"> Bajaj Institute Technology Wardha</h1>
        </div>
        <div class="manageUserMain">
            <h1 class="heading">Manage Employees</h1>
            <a href="../../pages/SuperAdmin/addUser.php"><button class="addUser">+</button></a>
            <div class="User">
                <table class="tablecontent">
                    <thead>
                        <tr>
                            <th>USER ID</th>
                            <th>FULL NAME</th>
                            <th>EMAIL</th>
                            <th>DEPARTMENT</th>
                            <th>USER TYPE</th>
                            <th>POSITION</th>
                            <th>STATUS</th>
                            <th>JOINING DATE</th>
                            <th>DEACTIVATION DATE</th>
                            <th>EDIT</th>
                            <th>DEACTIVATE</th>
                        </tr>
                    </thead>
                    <tbody id="tbody">
                        <?php

                        $query1 = "select * from user inner join department on user.deptId = department.deptId ORDER BY status";
                        $result = mysqli_query($conn, $query1);

                        foreach ($result as $cols) {
                            echo "<tr>";
                            echo "<td>" . $cols['userId'] . "</td>";
                            echo "<td>" . $cols['fullName'] . "</td>";
                            echo "<td>" . $cols['email'] . "</td>";
                            echo "<td>" . $cols['deptName'] . "</td>";
                            echo "<td>" . $cols['userType'] . "</td>";
                            echo "<td>" . $cols['position'] . "</td>";
                            echo "<td>" . $cols['status'] . "</td>";
                            echo "<td>" . date( 'd-m-Y' , strtotime($cols['joiningDate']) )  . "</td>";
                            echo "<td>" . ( is_null($cols['deactivationDate']) ? "-" :  date('m-d-Y' , strtotime($cols['deactivationDate']))  ) . "</td>";
                            echo "<td><a href='../../pages/SuperAdmin/edit.php?email=$cols[email]' name='edit'><i class='fa-solid fa-pen-to-square edit'></i></a></td>";
                            echo "<td><a href='../../utils/delete.php?email=$cols[email]' name='delete'><i class='fa-solid fa-trash delete'></i></a></td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</body>

</html>