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
    <link rel="stylesheet" href="../../css/_leave_admin_.manageLeaves.css?v=<?php echo time(); ?>">
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

            <h1 class="heading">Manage Leaves</h1>

            <!-- Search Bar -->
            <input id="manageUserSearchBar" class="searchBar" type="text" placeholder="Search Email" name="searchInput">

            <div class="User">

            </div>


        </div>
    </section>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

    <script>

        document.getElementById('manageUserSearchBar').addEventListener('keypress', (e) => {

            if (e.key == 'Enter') handleSearch(e);

        })

        const handleSearch = (e) => {

            const email = e.target.value

            // Runs __user_.class.php file and return user information
            $.ajax({
                url: "../../utils/_user_.class.php",
                type: "post",
                data: {
                    function: "getUserLeaveData",
                    email
                },
                success: function(response) {

                    document.querySelector('.User').innerHTML = response


                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }
            });


        }



    </script>

</body>

</html>