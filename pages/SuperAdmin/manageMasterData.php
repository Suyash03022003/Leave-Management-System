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
    <link rel="stylesheet" href="../../css/manageUser.css?v=<?php echo time(); ?>">
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

            <h1 class="heading">Manage Master Data</h1>

            <a href="../../pages/SuperAdmin/addLeaveType.php"><button class="addUser">+</button></a>

            <div class="User">

                <table class="tablecontent">

                    <thead>
                        <tr>
                            <th>LEAVE ID</th>
                            <th>LEAVE TYPE</th>
                            <th>LEAVE DESCRIPTION</th>
                            <th>LEAVE INTERVAL</th>
                            <th>INCREMENT</th>
                            <th>EDIT</th>
                            <th>DELETE</th>
                        </tr>
                    </thead>
                    <tbody id="tbody">
                        <?php

                        $result = LeaveAdmin::getMasterData(); // Returns Array of Tuples in Database

                        foreach ($result as $cols) {
                            echo "<tr>";
                            echo "<td>" . $cols['leaveId'] . "</td>";
                            echo "<td>" . $cols['leaveType'] . "</td>";
                            echo "<td>" . $cols['leaveDesc'] . "</td>";
                            echo "<td>" . $cols['leaveInterval'] . "  Month </td>";
                            echo "<td>" . $cols['increment'] . "  Leaves </td>";
                            echo "<td><a href='../../pages/SuperAdmin/masterData_edit.php?leaveId=$cols[leaveId]' name='edit'><i class='fa-solid fa-pen-to-square edit'></i></a></td>";
                            echo "<td><a href='../../utils/deleteLeaveId.php?leaveId=$cols[leaveId]' name='delete'><i class='fa-solid fa-trash delete'></i></a></td>";
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