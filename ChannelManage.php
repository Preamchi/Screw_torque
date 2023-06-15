<?php

if (!session_id()) { session_start(); }
ob_start();

include "connect/COMMON.php";
include "ajax/Head.php";

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

.center {
    display: flex;
    justify-content: center;
    align-items: center;
    margin-Top: 5rem;
}
</style>



<body>
    <?php require 'component/Tab.php';?>
    <div class="layout">
        <div class="container" id="main">

            <!----------------------------------- Channel Manage  ------------------------------------------------------>

            <div class="card "
                style="wEmailidth:30rem; height:30rem; width:60rem; margin-bottom:5rem; margin-top: 2rem;">
                <div class="card-body pt-0 pl-0">
                    <div class="topic">

                        <label class="text">Channel Manage</label>
                    </div>
                    <div style="  margin-top: 4rem; display: flex; justify-content:flex-end; margin-right: 2rem;">
                        <button type="button" class="btn-add" data-backdrop="static" data-toggle="modal"
                            data-target="#addchannelModal" onclick="Station_value(),Model_value()">
                            <i class="fas fa-plus-circle"></i>&nbsp; Add Data
                        </button>
                    </div>
                    <!-- cart_data table -->
                    <div id="Show_Channel" class="scroll"></div>

                </div>
            </div>

        </div>
    </div>
    <!------------------------------------ all modal channel manage ------------------------------------------>
    <!-- Modal Add Channel  -->
    <div class="modal fade" id="addchannelModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-plus-circle"></i>&nbsp;Add
                        Channnel
                    </h5>
                </div>
                <div class="modal-body p-5">
                    <input id="emp" value="<?php echo $emp; ?>" hidden /> <!-- employee_id of user log in -->
                    <form>
                        <div class="input-group input-group-sm mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text " style="width: 112px;"
                                    for="inputGroupSelect01">Model</label>
                            </div>
                            <select class="custom-select " id="model_loop" onchange="(this.value)">
                            </select>
                        </div>
                        <div class="input-group input-group-sm mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text " style="width: 112px;"
                                    for="inputGroupSelect01">Station</label>
                            </div>
                            <select class="custom-select " id="station_loop" onchange="(this.value)">
                            </select>
                        </div>
                        <div class="input-group input-group-sm mb-3 ">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroup-sizing-sm">Channel Name</span>
                            </div>
                            <input type="text" class="form-control" aria-label="Sizing example input"
                                aria-describedby="inputGroup-sizing-sm" id="chname_input">
                        </div>
                        <div class="input-group input-group-sm mb-3 ">
                            <div class="input-group-prepend text-center">
                                <span class="input-group-text" id="inputGroup-sizing-sm"
                                    style="width: 112px;">PLC_REF</span>
                            </div>
                            <input type="text" class="form-control" aria-label="Sizing example input"
                                aria-describedby="inputGroup-sizing-sm" id="plc_input">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-success" onclick="Add_Channel()">Save</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit -->
    <input id="id_hold_channel" hidden />
    <div class="modal fade" id="editchannelModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-pen"></i>&nbsp;Edit Channel</h5>
                </div>
                <div class="modal-body">
                    <form>
                        <input id="emp" value="<?php echo $emp; ?>" hidden /> <!-- employee_id of user log in -->
                        <form>
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Current Cart Name: <input id="last_cart"
                                        style="border:none; outline: none;" readonly /></label>
                                <select class="form-select" aria-label="Default select example" id="cart_value"
                                    onchange="(this.value)">
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Current Part No: <input id="last_part"
                                        style="border:none; outline: none;" readonly /></label>
                                <select class="form-select" aria-label="Default select example" id="partno_value"
                                    onchange="(this.value)">
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Channel Name</label>
                                <input class="form-control" id="CH_Name">
                            </div>
                        </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-success" onclick="Updatechannel()"
                        data-dismiss="modal">Save</button>
                </div>
            </div>
        </div>
    </div>
    <!--------------------------- script function and JS file ---------------------------------->

    <!-- Load data func. -->
    <script>
    $(document).ready(function() {
        Load_Channel();
    });
    </script>

    <script>
    function Load_Channel() {
        document.getElementById("Show_Channel").innerHTML = '<div class="center"><span class="loader"></span></div>';

        setTimeout(function() {
            $.ajax({
                url: "ajax/Channel_Table.php",
                async: false,
                cache: false,

                success: function(result) {
                    document.getElementById("Show_Channel").innerHTML = result;
                }
            });
        }, 1000);
    }
    </script>

    <script src="js/Update_Channel.js"></script>
    <script src="js/Add_Channel.js"></script>
    <script src="js/Select_Station.js"></script>
    <script src="js/Select_Model.js"></script>
    <script src="js/Del_Channel.js"></script>
</body>

</html>