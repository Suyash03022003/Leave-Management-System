<?php

//  Connect database 

define( "DB" , "bit_leave_management_system");
require ('../../includes/_db_conn.php');
$conn = sql_conn()
// include('../../utils/ManageDepartmentUtils.php');

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
    <script src="https://kit.fontawesome.com/9dcdbf7660.js" crossorigin="anonymous"></script>
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
            <h1 class="heading">Manage Departments</h1>
            <a href="../../pages/SuperAdmin/addDept.php"><button class="addUser">+</button></a>
            <div class="User">
                <table class="tablecontent">
                    <thead>
                        <tr>
                            <th>DEPARTMENT ID</th>
                            <th>DEPARTMENT NAME</th>
                            <th>DEPARTMENT HOD</th>
                            <th>EDIT</th>
                            <th>DELETE</th>
                        </tr>
                    </thead>
                    <tbody id="tbody">
                        <?php

                        $query1 = "SELECT * FROM department ";

                        try {
                            $result = mysqli_query($conn, $query1);
                            // $result =  mysqli_fetch_array($result);
                        } catch ( mysqli_sql_exception $e ) {
                            var_dump($e);
                            exit; 
                        }

                        

                        foreach ($result as $cols) {

                            $userid = $cols['deptHod'];

                             if ($userid == 0) {
                                $hodName = 'Null';
                             }
                             else{

                                 
                                $query1 = "SELECT fullName FROM user WHERE userId = $userid";
                                $result1 = mysqli_query($conn, $query1);
                                $row = mysqli_fetch_assoc($result1);
                                $hodName = $row['fullName'];
                            }

                            echo "<tr>";
                            echo "<td>" . $cols['deptId'] . "</td>";
                            echo "<td>" . $cols['deptName'] . "</td>";
                            echo "<td>" . $hodName . "</td>";
                            echo "<td><a href='../../pages/SuperAdmin/editDept.php?deptId=$cols[deptId]' name='edit'><i class='fa-solid fa-pen-to-square edit'></i></a></td>";
                            echo "<td><a href='../../utils/deleteDept.php?deptId=$cols[deptId]' name='delete'><i class='fa-solid fa-trash delete'></i></a></td>";
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