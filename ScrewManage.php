<?php

include "connect/COMMON.php";
include "ajax/Head.php";

if (!session_id()) { session_start(); }
ob_start(); 

$emp = $_SESSION[Name];

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

.scroll {
    margin-Top: 1rem;
    max-height: 320px;
    overflow-y: scroll;
}

.center {
    display: flex;
    justify-content: center;
    align-items: center;
    margin-Top: 5rem;
}
</style>


<!------------------------------------ body: screw page ------------------------------------------>

<body>
    <!-- Tab menu -->
    <?php require 'component/Tab.php';?>

    <div class="layout">
        <div class="container" id="main">
            <div class="card " style="wEmailidth:30rem; height:30rem; width:60rem">
                <div class="card-body pt-0 pl-0">
                    <div class="topic">
                        <i class="fas fa-cog"></i>
                        <label class="text">Screw Manage</label>
                    </div>
                    <div style="  margin-top: 4rem; display: flex; justify-content:flex-end;  margin-right: 2rem;">
                        <button type="button" class="btn-add" data-toggle="modal" data-target="#AddscrewModal"
                            data-backdrop="static"><i class="fas fa-plus-circle"></i>&nbsp; Add Data
                        </button>
                    </div>
                    <!-- screw_data table -->
                    <div id="Show_Screw" class="scroll"></div>
                </div>
            </div>
        </div>
    </div>

    <!------------------------------------ all modal screw page ------------------------------------------>

    <!-- Modal Add -->
    <div class=" modal fade" id="AddscrewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        <i class="fas fa-plus-circle"></i>&nbsp;Add Screw
                    </h5>
                </div>
                <input id="emp" value="<?php echo $emp; ?>" hidden /> <!-- employee_id of user log in -->
                <div class="modal-body p-4">
                    <form class="col pl-5">
                        <div class="input-group input-group-sm mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" style="width: 100px;" id="inputGroup-sizing-sm">Part
                                    No</span>
                            </div>
                            <input type="text" class="form-control col-8" aria-label="Sizing example input"
                                aria-describedby="inputGroup-sizing-sm" id="partno_input">
                        </div>
                        <div class="input-group input-group-sm mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" style="width: 100px;" id="inputGroup-sizing-sm">Screw
                                    Name</span>
                            </div>
                            <input type="text" class="form-control col-8" aria-label="Sizing example input"
                                aria-describedby="inputGroup-sizing-sm" id="screwname_input">
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success" onclick="Add_Screw()">Save</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit -->
    <input id="id_screw" hidden />
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-pen"></i>&nbsp;Edit Screw</h5>
                </div>
                <input id="emp" value="<?php echo $emp; ?>" hidden /> <!-- employee_id of user log in -->
                <div class="modal-body p-4">
                    <form class="col pl-5">
                        <div class="input-group input-group-sm mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" style="width: 100px;" id="inputGroup-sizing-sm">Part
                                    No</span>
                            </div>
                            <input type="text" class="form-control col-8" aria-label="Sizing example input"
                                aria-describedby="inputGroup-sizing-sm" id="partno_data">
                        </div>
                        <div class="input-group input-group-sm mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" style="width: 100px;" id="inputGroup-sizing-sm">Screw
                                    Name</span>
                            </div>
                            <input type="text" class="form-control col-8" aria-label="Sizing example input"
                                aria-describedby="inputGroup-sizing-sm" id="screwname_data">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    <button type=" button" class="btn btn-success" onclick="Update()"
                        data-dismiss="modal">Update</button>
                </div>
            </div>
        </div>
    </div>
    </div>

    <!--------------------------- script function and JS file ---------------------------------->

    <!-- Load data func. -->
    <script>
    $(document).ready(function() {
        Load_Screw();
    });
    </script>

    <script>
    function Load_Screw() {
        document.getElementById("Show_Screw").innerHTML = '<div class="center"><span class="loader"></span></div>';

        setTimeout(function() {
            $.ajax({
                url: "ajax/Screw_Table.php",
                async: false,
                cache: false,

                success: function(result) {
                    document.getElementById("Show_Screw").innerHTML = result;
                }
            });
        }, 1000);
    }
    </script>
    <script src="js/Update_Screw.js"></script>
    <script src="js/Add_Screw.js"></script>
    <script src="js/Del_Screw.js"></script>

</body>

</html>