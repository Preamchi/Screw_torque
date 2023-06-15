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

.table-condensed {
    font-size: 12px;
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
                        <label class="text">Process Manage</label>
                    </div>
                    <div style="  margin-top: 4rem; display: flex; justify-content:flex-end;  margin-right: 2rem;">
                        <button type="button" class="btn-add" data-toggle="modal" data-target="#addsModal"
                            data-backdrop="static" onclick="Nijiko_Value(),Channel_value(), Model_value()  "><i
                                class="fas fa-plus-circle"></i>&nbsp;
                            Add
                            Data
                        </button>
                    </div>
                    <!-- screw_data table -->

                    <div id="Show1" class="scroll"></div>
                </div>
            </div>
        </div>
    </div>

    <!------------------------------------ all modal screw page ------------------------------------------>

    <!-- Modal Add -->
    <div class=" modal fade bd-example-modal-xl" id="addModal" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog  modal-xl" role="document">
            <div class="modal-content w-10">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        <i class="fas fa-plus-circle"></i>&nbsp;Add Process
                    </h5>
                </div>
                <input id="emp" value="<?php echo $emp; ?>" hidden /> <!-- employee_id of user log in -->
                <div class="modal-body pl-4 pr-4">
                    <div class="row">
                        <div class="col-5" style=" border-right: 2px solid #E9ECEF; ">
                            <form>
                                <label>Station Detail</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text " style="width: 110px;"
                                            for="inputGroupSelect01">Station</label>
                                    </div>
                                    <select class="custom-select col-8" id="station">
                                        <option selected>Choose...</option>
                                        <option value="SHEM-LS-(M-4)-SHOP4.1">SHEM-LS-(M-4)-SHOP4.1</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                    </select>
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text" style="width: 110px;"
                                            for="inputGroupSelect01">Screw
                                            Type</label>
                                    </div>
                                    <select class="custom-select col-8" id="no">
                                        <option selected>Choose...</option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                    </select>
                                </div>
                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" style="width: 110px;"
                                            id="inputGroup-sizing-sm">Nijiko No.</span>
                                    </div>
                                    <input type="text" class="form-control col-8" aria-label="Sizing example input"
                                        aria-describedby="inputGroup-sizing-sm" id="nijiko">
                                </div>

                                <label>Process Detail</label>
                                <div class="row">
                                    <div class="input-group input-group-sm mb-3 col">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" style="width: 90px;"
                                                id="inputGroup-sizing-sm">Channel</span>
                                        </div>
                                        <input type="text" class="form-control col-5" aria-label="Sizing example input"
                                            aria-describedby="inputGroup-sizing-sm" id="ch">
                                    </div>
                                    <div class="input-group input-group-sm mb-3 col pl-0">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" style="width: 90px;"
                                                id="inputGroup-sizing-sm">Sequence</span>
                                        </div>
                                        <input type="text" class="form-control col-5" aria-label="Sizing example input"
                                            aria-describedby="inputGroup-sizing-sm" id="seq">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-group input-group-sm mb-3 col">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" style="width: 90px;"
                                                id="inputGroup-sizing-sm">Torque Set</span>
                                        </div>
                                        <input type="text" class="form-control col-5" aria-label="Sizing example input"
                                            aria-describedby="inputGroup-sizing-sm" id="torque">
                                    </div>
                                    <div class="input-group input-group-sm mb-3 col pl-0">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" style="width: 90px;"
                                                id="inputGroup-sizing-sm">Time Set</span>
                                        </div>
                                        <input type="text" class="form-control col-5" aria-label="Sizing example input"
                                            aria-describedby="inputGroup-sizing-sm" id="time">
                                    </div>
                                </div>
                                <button type="button" class="btn btn-primary" onclick="Add_list()">Add</button>
                                <button type="button" class="btn btn-primary">Clear</button>
                            </form>
                        </div>
                        <div class="col" style="width: 100px; padding-right:4rem;">
                            <label>Data List</label>

                            <table id="table" class="table table-bordered text-center table-condensed"
                                style="margin-top:5px;">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Station</th>
                                        <th scope="col">Nijiko No</th>
                                        <th scope="col">CH</th>
                                        <th scope="col">Seq</th>
                                        <th scope="col">Torque</th>
                                        <th scope="col">Time</th>
                                        <th scope="col">Delete</th>

                                    </tr>
                                </thead>
                                <!--  <tbody>
                                    <tr>
                                        <th scope="row">1</th>
                                        <td>SHEM-LS-(M-16)-Shop5.1</td>
                                        <td>N-26534891</td>
                                        <td>1</td>
                                        <td>1</td>
                                        <td>0.009</td>
                                        <td>0.002</td>
                                    </tr>
                                </tbody> -->
                            </table>

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success" onclick="AddScrew()">Save</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit -->
    <input id="id_hold" hidden />
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-pen"></i>&nbsp;Edit Screw</h5>
                </div>
                <input id="emp" value="<?php echo $emp; ?>" hidden /> <!-- employee_id of user log in -->
                <div class="modal-body p-5">
                    <form>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Part No.</label>
                            <input type="text" class="form-control" id="partno_data">
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Part Serial</label>
                            <input type="text" class="form-control" id="partserial_data">
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

    <!-- Modal Add Ver2 -->
    <input id="id_hold" hidden />
    <div class="modal fade" id="addsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-pen"></i>&nbsp;Add Process</h5>
                </div>
                <input id="emp" value="<?php echo $emp; ?>" hidden /> <!-- employee_id of user log in -->
                <div class="modal-body pl-5">
                    <form>
                        <label>Station Detail</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text " style="width: 110px;"
                                    for="inputGroupSelect01">Channel</label>
                            </div>
                            <select class="custom-select col-8" id="channel_loop" onchange="(this.value)">

                            </select>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text" style="width: 110px;"
                                    for="inputGroupSelect01">Model</label>
                            </div>
                            <select class="custom-select col-8" id="model_loop" onchange="(this.value)">
                            </select>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text" style="width: 110px;"
                                    for="inputGroupSelect01">Nijiko</label>
                            </div>
                            <select class="custom-select col-8" id="nijiko_loop" onchange="(this.value)">
                            </select>
                        </div>
                        <label>Sequence Detail</label>
                        <div class=""></div>
                        <div class="input-group input-group-sm mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" style="width: 110px;"
                                    id="inputGroup-sizing-sm">Sequence</span>
                            </div>
                            <input type="text" class="form-control col-8" aria-label="Sizing example input"
                                aria-describedby="inputGroup-sizing-sm" id="seq1">
                        </div>
                        <div class="input-group input-group-sm mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroup-sizing-sm">Sequenc_Before
                                </span>
                            </div>
                            <input type="text" class="form-control col-8" aria-label="Sizing example input"
                                aria-describedby="inputGroup-sizing-sm" id="seq_before">
                        </div>

                        <div class="input-group input-group-sm mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" style="width: 110px;"
                                    id="inputGroup-sizing-sm">Torque</span>
                            </div>
                            <input type="text" class="form-control col-8" aria-label="Sizing example input"
                                aria-describedby="inputGroup-sizing-sm" id="torq">
                        </div>
                        <div class="input-group input-group-sm mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" style="width: 110px;"
                                    id="inputGroup-sizing-sm">Torque_Max</span>
                            </div>
                            <input type="text" class="form-control col-8" aria-label="Sizing example input"
                                aria-describedby="inputGroup-sizing-sm" id="torq_max">
                        </div>
                        <div class="input-group input-group-sm mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" style="width: 110px;"
                                    id="inputGroup-sizing-sm">Torque_Min</span>
                            </div>
                            <input type="text" class="form-control col-8" aria-label="Sizing example input"
                                aria-describedby="inputGroup-sizing-sm" id="torq_min">
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    <button type=" button" class="btn btn-success" onclick="Add_Process()"
                        data-dismiss="modal">Add</button>
                </div>
            </div>
        </div>
    </div>
    </div>



    <!--------------------------- script function and JS file ---------------------------------->
    <script>
    function Add_list() {
        "use strict";

        var table = document.getElementById("table");

        var row = document.createElement("tr");
        console.log(row);
        var td1 = document.createElement("td");
        var td2 = document.createElement("td");
        var td3 = document.createElement("td");
        var td4 = document.createElement("td");
        var td5 = document.createElement("td");
        var td6 = document.createElement("td");
        var td7 = document.createElement("td");
        var td8 = document.createElement("td");

        td1.innerHTML = document.getElementById("no").value;
        td2.innerHTML = document.getElementById("station").value;
        td3.innerHTML = document.getElementById("nijiko").value;
        td4.innerHTML = document.getElementById("ch").value;
        td5.innerHTML = document.getElementById("seq").value;
        td6.innerHTML = document.getElementById("torque").value;
        td7.innerHTML = document.getElementById("time").value;
        td8.innerHTML = '<input type="button" value="delete" onclick="deleteRow(this)"/>';



        row.appendChild(td1);
        row.appendChild(td2);
        row.appendChild(td3);
        row.appendChild(td4);
        row.appendChild(td5);
        row.appendChild(td6);
        row.appendChild(td7);
        row.appendChild(td8);

        table.children[0].appendChild(row);
    }
    </script>

    <!-- Load data func. -->
    <script>
    $(document).ready(function() {
        load_process();
    });
    </script>

    <script>
    function load_process() {
        document.getElementById("Show1").innerHTML = '<div class="center"><span class="loader"></span></div>';

        setTimeout(function() {
            $.ajax({
                url: "ajax/Process_Table.php",
                async: false,
                cache: false,

                success: function(result) {
                    document.getElementById("Show1").innerHTML = result;
                }
            });
        }, 1000);
    }
    </script>

    <!-- Delete func -->

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
    <script src="js/Update_Screw.js"></script>
    <script src="js/Add_Process.js"></script>
    <script src="js/Select_Nijiko.js"></script>
    <script src="js/Select_Model.js"></script>
    <script src="js/Select_Channel.js"></script>
    <script src="js/Del_Process.js"></script>
</body>


</html>