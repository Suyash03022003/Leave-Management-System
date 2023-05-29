<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bajaj Institute of Technology, Wardha</title>
    <link rel="stylesheet" href="../css/login.css?v<?php echo time(); ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">

</head>

<body>

    <div class="main">

        <h1>Leave Management System</h1>

        <!-- HTML API for Sign in with Google Function -->
        <!-- //! Do not remove this part  -->

        <div id="g_id_onload" data-client_id="983317266916-01juk5ugf6rfg0fop30213s6d0k3atun.apps.googleusercontent.com" data-context="signin" data-ux_mode="popup" data-auto_prompt="false" data-callback='handleCredentialResponse'>
        </div>

        <div class="g_id_signin" data-type="standard" data-shape="rectangular" data-theme="outline" data-text="signin_with" data-size="large" data-locale="en-GB" data-logo_alignment="left">
        </div>


    </div>

    <script src="https://accounts.google.com/gsi/client" async defer></script>
    <script src="https://unpkg.com/jwt-decode/build/jwt-decode.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

    <!-- Script to validate emails -->
    <script>
        function handleCredentialResponse(response) {

            // decodes the credentials
            const responsePayload = jwt_decode(response.credential);
            const email = responsePayload.email


            // Validates College Email
            if (email.includes('@bitwardha')) {

                // Runs _user_.class.php file and return user information
                $.ajax({
                    url: "../utils/_user_.class.php",
                    type: "post",
                    data: {
                        function: "setUser",
                        email
                    },
                    success: function(response) {

                        console.log(response);

                        const userData = JSON.parse(response)


                        if (userData.position === "ADMIN") window.location.href = 'SuperAdmin/super_admin_dashboard.php'
                       else if (userData.position === "FACULTY") window.location.href = 'Staff/Staff_dashboard.php'
                       else if (userData.position === "HOD") window.location.href = 'Hod/HOD_dashboard.php'
 
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log(textStatus, errorThrown);
                    }
                });

            } else alert('Invalid Email ID')

        }
    </script>
</body>

</html>