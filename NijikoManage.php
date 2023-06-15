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
</style>


<body>
    <?php require 'component/Tab.php';?>
    <div class="layout">
        <div class="container" id="main">
            <div class="card " style="wEmailidth:30rem; height:30rem; width:60rem;">
                <div class="card-body pt-0 pl-0">
                    <div class="topic">
                        <i class="fas fa-screwdriver"></i>
                        <label class="text">Nijiko Manage</label>
                    </div>
                    <div style="  margin-top: 4rem; display: flex; justify-content:flex-end; margin-right: 2rem;">
                        <button type="button" class="btn-add" data-backdrop="static" data-toggle="modal"
                            data-target="#exampleModal" onclick="Screw_value(),Station_value()">
                            <i class="fas fa-plus-circle"></i>&nbsp; Add Data
                        </button>
                    </div>

                    <!-- nijiko_data table -->
                    <div id="Show_nijiko" class="scroll"></div>

                </div>
            </div>


            <!-- Modal Add -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel"> <i class="fas fa-plus-circle"></i>&nbsp;Add
                                Nijiko</h5>
                        </div>
                        <div class="modal-body p-5">
                            <input id="emp" value="<?php echo $emp; ?>" hidden /> <!-- employee_id of user log in -->
                            <form>
                                <div class="input-group input-group-sm mb-3 ">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-sm">Nijiko Name</span>
                                    </div>
                                    <input type="text" class="form-control" aria-label="Sizing example input"
                                        aria-describedby="inputGroup-sizing-sm" id="nijiko_input">
                                </div>

                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text " style="width: 100px;"
                                            for="inputGroupSelect01">Station</label>
                                    </div>
                                    <select class="custom-select " id="station_loop" onchange="(this.value)">
                                    </select>
                                </div>
                                <div class="input-group input-group-sm ">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text " style="width: 100px;"
                                            for="inputGroupSelect01">Screw Type</label>
                                    </div>
                                    <select class="custom-select " id="screw_loop" onchange="(this.value)">
                                    </select>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                            <button type="button" class="btn btn-success" onclick="Add_Nijiko()">Save</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Edit -->
            <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-pen"></i>&nbsp;Edit Nijiko
                            </h5>
                        </div>
                        <div class="modal-body p-5">
                            <form>
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Device ID</label>
                                    <input class="form-control" id="Part_No">
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Machine Name</label>
                                    <input class="form-control" id="Part_No">
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Part No.</label>
                                    <select class="form-control" id="exampleFormControlSelect1">
                                        <option disable>Select...</option>
                                        <option>1</option>
                                        <option>2</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Station</label>
                                    <select class="form-control" id="exampleFormControlSelect1">
                                        <option disable>Select...</option>
                                        <option>1</option>
                                        <option>2</option>
                                    </select>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                            <button type="button" class="btn btn-success" onclick="Add_Nijiko()">Save</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--------------------------- script function and JS file ---------------------------------->
    <script src="js/Del_Nijiko.js"></script>
    <script src="js/Update_Nijiko.js"></script>
    <script src="js/Add_Nijiko.js"></script>
    <script src="js/Select_Line.js"></script>
    <script src="js/Select_Screw.js"></script>
    <script src="js/Select_Channel.js"></script>
    <script src="js/Select_Station.js"></script>
    <!-- Load data func. -->
    <script>
    $(document).ready(function() {
        Load_Nijiko();
    });
    </script>
    <script>
    function Load_Nijiko() {
        document.getElementById("Show_nijiko").innerHTML = '<span class="loader"></span>';

        setTimeout(function() {
            $.ajax({
                url: "ajax/Nijiko_Table.php",
                async: false,
                cache: false,

                success: function(result) {
                    document.getElementById("Show_nijiko").innerHTML = result;
                }
            });
        }, 1000);
    }
    </script>

    <script>
    function load_value() {
        $.ajax({
            url: "ajax/Station_value.php",
            async: false,
            cache: false,

            success: function(result) {
                var myJson = JSON.parse(result);

                var cartoptions =
                    "<select class='form-select' aria-label='Default select example' id='station_new' >";
                cartoptions += "<option>select....</option>";

                for (let x in myJson) {

                    var id = myJson[x]['ST_ID'];
                    var name = myJson[x]['Station_Name'];
                    cartoptions += "<option value='" + id + "'>" +
                        name + "</option>";
                }
                cartoptions += '</select>';

                document.getElementById("station_loop").innerHTML = cartoptions;

            }
        });
    }
    </script>

    <script>
    function load_part() {
        $.ajax({
            url: "ajax/Part_Value.php",
            async: false,
            cache: false,

            success: function(result) {
                var myJson = JSON.parse(result);

                var cartoptions =
                    "<select class='form-select' aria-label='Default select example' id='part_newa' >";

                cartoptions += "<option>select....</option>";
                for (let x in myJson) {

                    var id = myJson[x]['Part_No'];
                    cartoptions += "<option value='" + id + "'>" + id + "</option>";
                }
                cartoptions += '</select>';
                document.getElementById("partno_loop").innerHTML = cartoptions;

            }
        });
    }
    </script>



</body>