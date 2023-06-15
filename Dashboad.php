<?php

include "connect/COMMON.php";
include "ajax/Head.php";
if (!session_id()) { session_start(); }
ob_start(); 

?>

<link href="css/ScrewManage.css" rel="stylesheet" />

<style>
* {
    padding: 0;
    margin: 0
}

body {
    background-image: url('img/background.jpg');
    background-repeat: no-repeat;
    background-size: cover;
    background-position: center;
    background-attachment: fixed;
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;

}
</style>



<body>
    <?php require 'component/Tab.php';?>
    <div class="layout">
        <div class="container" id="main">
            <!----------------------------------- Cart-Nigiko Log ----------------------------------------------------->
            <div class="card " style="wEmailidth:30rem; height:30rem; width:60rem;">
                <div class="card-body pt-0 pl-0">

                    <div class="topic">
                        <label class="text">Result Torque</label>
                    </div>


                </div>
            </div>




            <!----------------------------------- Station-Nijikio Log ------------------------------------------------------>

            <!--     <div class="card " style="wEmailidth:30rem; height:30rem; width:60rem;  margin-top: 2rem;">
                <div class="card-body pt-0 pl-0">

                    <div class="topic">
                        <label class="text">Cart-Nijiko Log</label>
                    </div>
                    <div
                        style=" margin-top: 5rem; display: flex; justify-content:center; padding-left:10rem; padding-right:10rem; ">
                        <label style="margin-right:1rem; margin-top:10px">Cart Name </label>
                        <select class="form-select form-select-sm w-25" aria-label="Default select example">
                            <option selected>select cart...</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                        <label style="margin-left:1rem; margin-right:1rem; margin-top:10px">Channel </label>
                        <select class="form-select form-select-sm w-25 mr-4" aria-label="Default select example">
                            <option selected>select channel...</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                        <button class="btn btn-primary" type="button">
                            <i class="fas fa-search"></i></button>
                    </div>
                   
            <div id="Show_log_CN" class="scroll"></div>

        </div>
    </div> -->
            <!-- Data Visualization -->
            <!--    <div class="card "
                style="wEmailidth:30rem; height:30rem; width:60rem; margin-bottom:5rem; margin-top: 2rem;">
                <div class="card-body pt-0 pl-0">

                    <div class="topic">
                        <label class="text">Station-Nijiko Log</label>
                    </div>
                    <div
                        style=" margin-top: 5rem; display: flex; justify-content:center; padding-left:10rem; padding-right:10rem; ">
                        <label style="margin-right:1rem; margin-top:10px">Station Name </label>
                        <select class="form-select form-select-sm w-25" aria-label="Default select example">
                            <option selected>select cart...</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                        <label style="margin-left:1rem; margin-right:1rem; margin-top:10px">Channel </label>
                        <select class="form-select form-select-sm w-25 mr-4" aria-label="Default select example">
                            <option selected>select channel...</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                        <button class="btn btn-primary" type="button"> <i class="fas fa-search"></i></button>
                    </div>
                 
            <div id="Show_log_SN" class="scroll"></div>

        </div>
    </div>

    </div>
    </div> -->

            <!-- Load data func. -->
            <script>
            $(document).ready(function() {
                load_all_view();
            });
            </script>
            <script>
            function load_all_view() {
                document.getElementById("Show_log_CN").innerHTML = '<span class="loader"></span>';

                setTimeout(function() {
                    $.ajax({
                        url: "ajax/Cart_Nijiko_Table.php",
                        async: false,
                        cache: false,

                        success: function(result) {
                            document.getElementById("Show_log_CN").innerHTML = result;
                        }
                    });
                }, 1000);
            }
            </script>
            <!----------------------------------------------------------------------------------------------->
            <!-- Load data func. -->
            <script>
            $(document).ready(function() {
                load_SN();
            });
            </script>
            <script>
            function load_SN() {
                document.getElementById("Show_log_SN").innerHTML = '<span class="loader"></span>';

                setTimeout(function() {
                    $.ajax({
                        url: "ajax/Station_Nijiko_Table.php",
                        async: false,
                        cache: false,

                        success: function(result) {
                            document.getElementById("Show_log_SN").innerHTML = result;
                        }
                    });
                }, 1000);
            }
            </script>

</body>

</html>