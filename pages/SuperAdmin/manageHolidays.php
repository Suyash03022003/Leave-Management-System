<?php

//  Connect database 

define( "DB" , "bit_leave_management_system");
require ('../../includes/_db_conn.php');
$conn = sql_conn()

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
        <div class="horizontal_navbar">
            <h1 class="Heading_Heder"> Bajaj Institute Technology Wardha</h1>
        </div>
        <div class="manageUserMain">
            <h1 class="heading">Manage Holidays</h1>
            <a href="../../pages/SuperAdmin/addHoliday.php"><button class="addUser">+</button></a>
            <div class="User">
                <table class="tablecontent">
                    <thead>
                        <tr>
                            <th>HOLIDAY NAME</th>
                            <th>DATE</th>
                            <th>DELETE</th>
                        </tr>
                    </thead>
                    <tbody id="tbody">
                        <?php

                        $query1 = "SELECT * FROM holidays";

                        try {
                            $result = mysqli_query($conn, $query1);
                            // $result =  mysqli_fetch_array($result);
                        } catch ( mysqli_sql_exception $e ) {
                            var_dump($e);
                            exit; 
                        }

                        foreach ($result as $cols) {

                            echo "<tr>";
                            echo "<td>" . $cols['holidayName'] . "</td>";
                            echo "<td>" . date( 'd-m-Y' , strtotime( $cols['date'] ) ) . "</td>";
                            echo "<td><a href='../../utils/deleteHoliday.php?date=$cols[date]' name='delete'><i class='fa-solid fa-trash delete'></i></a></td>";
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