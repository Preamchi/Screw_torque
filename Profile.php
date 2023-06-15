<?php
include "ajax/Head.php";
include "connect/COMMON.php";
if (!session_id()) { session_start(); }
ob_start(); 

/* User Login */
$employee_login = $_SESSION[Name];

?>


<link href="css/Profile.css" rel="stylesheet" />
<style>
* {
    padding: 0;
    margin: 0
}

/* BG:Sea */
body {
    background-image: url('img/background.jpg');
    background-repeat: no-repeat;
    background-size: cover;
    background-position: center;
    background-attachment: fixed;
    display: flex;
    justify-content: center;
    align-items: center;
}
</style>


<body>
    <!-- Menu Tab Left-->
    <?php require 'component/Tab.php';?>
    <!-- Card Profile -->
    <div class="container" id="main" style="margin-left:4rem;">
        <div class="card " style="wEmailidth: 30rem; height:25rem">
            <div class="card-body pt-0 pl-0">
                <!-- Head Topic -->
                <div class="topic">
                    <i class="fas fa-address-card"></i>
                    <label class="text">My Profile</label>
                </div>
                <!-- Employee_Id OF User Log In -->
                <input id="employee_login" value="<?php echo $employee_login; ?>" hidden />
                <!-- Form Profile -->
                <form class="textbox ml-3 p-3 ">
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Employee ID</label>
                        <input type="text" class="form-control" id="employee_id" disabled>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Username</label>
                        <input type="text" class="form-control" id="employee_name" disabled>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Role</label>
                        <input type="text" class="form-control" id="employee_role" disabled>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <!--------------------------- Script Function And JS File ---------------------------------->

    <!-- Load Data Func. -->
    <script>
    $(document).ready(function() {
        Profile();
    });
    </script>

    <script>
    function Profile() {
        var emp_login = document.getElementById("employee_login").value;

        $.ajax({
            url: "ajax/User_Profile.php",
            async: false,
            cache: false,
            data: {
                Emp_Login: emp_login
            },
            success: function(result) {

                const myJson = JSON.parse(result);
                document.getElementById("employee_id").value = myJson.Emp_ID;
                document.getElementById("employee_name").value = myJson.Emp_Name;
                document.getElementById("employee_role").value = myJson.Emp_Role;
            }
        });

    }
    </script>

    <!-- Jquery -->
    <script src='js/jquery.min.js'></script>
    <script src='js/jquery.js'></script>
</body>

</html>