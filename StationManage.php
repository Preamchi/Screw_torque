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



<body>
    <?php require 'component/Tab.php';?>
    <div class="layout">
        <div class="container" id="main">
            <!----------------------------------- Line ----------------------------------------------------->
            <div class="card " style="wEmailidth:30rem; height:30rem; width:60rem; margin-top: 69rem;">
                <div class="card-body pt-0 pl-0">

                    <div class="topic">
                        <!--        <i class="fas fa-cog"></i> -->
                        <label class="text">Line</label>
                    </div>
                    <div style="  margin-top: 4rem; display: flex; justify-content:flex-end;  margin-right: 2rem;">
                        <button type="button" class="btn-add" data-toggle="modal" data-target="#AddlineModal"
                            data-backdrop="static"><i class="fas fa-plus-circle"></i>&nbsp; Add Data
                        </button>
                    </div>
                    <!-- screw_data table -->
                    <div id="Show_Line" class="scroll"></div>
                </div>
            </div>

            <!-- Modal Add -->
            <div class=" modal fade" id="AddlineModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">
                                <i class="fas fa-plus-circle"></i>&nbsp;Add Line
                            </h5>
                        </div>
                        <input id="emp" value="<?php echo $emp; ?>" hidden /> <!-- employee_id of user log in -->
                        <div class="modal-body p-5">
                            <form>

                                <div class="input-group input-group-sm ">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-sm">Line Name</span>
                                    </div>
                                    <input type="text" class="form-control" aria-label="Sizing example input"
                                        aria-describedby="inputGroup-sizing-sm" id="linename_input">
                                </div>

                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-success" onclick="Add_Line()">Save</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal Edit -->
            <input id="id_line" hidden />
            <div class=" modal fade" id="EditlineModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">
                                <i class="fas fa-plus-circle"></i>&nbsp;Edit Line
                            </h5>
                        </div>
                        <input id="emp" value="<?php echo $emp; ?>" hidden /> <!-- employee_id of user log in -->
                        <div class="modal-body p-5">
                            <form>

                                <div class="input-group input-group-sm ">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-sm">Line Name</span>
                                    </div>
                                    <input type="text" class="form-control" aria-label="Sizing example input"
                                        aria-describedby="inputGroup-sizing-sm" id="linename_data">
                                </div>

                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-success" onclick="Update_Line()">Save</button>
                        </div>
                    </div>
                </div>
            </div>
            <!----------------------------------- Model ------------------------------------------------------>

            <div class="card " style="wEmailidth:30rem; height:30rem; width:60rem;  margin-top: 2rem;">
                <div class="card-body pt-0 pl-0">
                    <div class="topic">
                        <!--     <i class="fas fa-cog"></i> -->
                        <label class="text">Station</label>
                    </div>
                    <div style="  margin-top: 4rem; display: flex; justify-content:flex-end;  margin-right: 2rem;">
                        <button type="button" class="btn-add" data-toggle="modal" data-target="#AddstationModal"
                            data-backdrop="static"><i class="fas fa-plus-circle"></i>&nbsp; Add
                            Data
                        </button>
                    </div>
                    <!-- screw_data table -->
                    <div id="Show_Station" class="scroll"></div>


                </div>
            </div>

            <!-- Model Add -->
            <div class=" modal fade" id="AddmodelModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">
                                <i class="fas fa-plus-circle"></i>&nbsp;Add Model
                            </h5>
                        </div>
                        <input id="emp" value="<?php echo $emp; ?>" hidden /> <!-- employee_id of user log in -->
                        <div class="modal-body p-5">
                            <form>

                                <div class="input-group input-group-sm  mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-sm">Model Name</span>
                                    </div>
                                    <input type="text" class="form-control" aria-label="Sizing example input"
                                        aria-describedby="inputGroup-sizing-sm" id="modelname_input">
                                </div>
                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text " style="width: 100px;"
                                            for="inputGroupSelect01">Line</label>
                                    </div>
                                    <select class="custom-select " id="line_loop" onchange="(this.value)">

                                    </select>
                                </div>
                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text " style="width: 100px;"
                                            for="inputGroupSelect01">Station</label>
                                    </div>
                                    <select class="custom-select " id="station_loop" onchange="(this.value)">

                                    </select>
                                </div>

                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-success" onclick="Add_Model()">Save</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Edit model  -->
            <input id="id_model" hidden />
            <div class=" modal fade" id="EditmodelModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">
                                <i class="fas fa-plus-circle"></i>&nbsp;Edit Model
                            </h5>
                        </div>
                        <input id="emp" value="<?php echo $emp; ?>" hidden /> <!-- employee_id of user log in -->
                        <div class="modal-body p-5">
                            <form>

                                <div class="input-group input-group-sm  mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-sm">Model Name</span>
                                    </div>
                                    <input type="text" class="form-control" aria-label="Sizing example input"
                                        aria-describedby="inputGroup-sizing-sm" id="modelname_data">
                                </div>
                                <label>Current Line:&nbsp;</label><input type="text" id="line_data1"
                                    style="border:none; " disabled />
                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text " style="width: 100px;"
                                            for="inputGroupSelect01">New Line</label>
                                    </div>
                                    <select class="custom-select " id="line_loop1" onchange="(this.value)">

                                    </select>
                                </div>

                                <label>Current Station:&nbsp;
                                </label><input type="text" id="station_data2" style="border:none;" disabled />
                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text " style="width: 100px;" for="inputGroupSelect01">
                                            New Station</label>
                                    </div>
                                    <select class="custom-select " id="station_loop1" onchange="(this.value)"></select>

                                </div>

                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-success" onclick="Update_Model()">Save</button>
                        </div>
                    </div>
                </div>
            </div>
            <!----------------------------------- Station ------------------------------------------------------>
            <div class="card "
                style="wEmailidth:30rem; height:30rem; width:60rem; margin-bottom:5rem; margin-top: 2rem;">
                <div class="card-body pt-0 pl-0">

                    <div class="topic">
                        <!--     <i class="fas fa-cog"></i> -->
                        <label class="text">Model</label>
                    </div>
                    <div style="  margin-top: 4rem; display: flex; justify-content:flex-end;  margin-right: 2rem;">
                        <button type="button" class="btn-add" data-toggle="modal" data-target="#AddmodelModal"
                            data-backdrop="static" onclick="Line_value(),Station_value()"><i
                                class="fas fa-plus-circle"></i>&nbsp; Add
                            Data
                        </button>
                    </div>
                    <!-- screw_data table -->
                    <div id="Show_Model" class="scroll"></div>

                </div>
            </div>

        </div>
    </div>
    </div>
    <!-- Station Add -->
    <div class=" modal fade" id="AddstationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        <i class="fas fa-plus-circle"></i>&nbsp;Add Station
                    </h5>
                </div>
                <input id="emp" value="<?php echo $emp; ?>" hidden /> <!-- employee_id of user log in -->
                <div class="modal-body p-5">
                    <form>
                        <div class="input-group input-group-sm mb-3 ">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroup-sizing-sm">Station Name</span>
                            </div>
                            <input type="text" class="form-control" aria-label="Sizing example input"
                                aria-describedby="inputGroup-sizing-sm" id="stname_input">
                        </div>
                        <!--   <div class="input-group input-group-sm mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text " style="width: 100px;"
                                    for="inputGroupSelect01">Model</label>
                            </div>
                            <select class="custom-select " id="model_loop" onchange="(this.value)">

                            </select>
                        </div> -->
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success" onclick="Add_Station()">Save</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Station Edit -->
    <input id="id_station" hidden />
    <div class=" modal fade" id="EditstationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        <i class="fas fa-plus-circle"></i>&nbsp;Edite Station
                    </h5>
                </div>
                <input id="emp" value="<?php echo $emp; ?>" hidden /> <!-- employee_id of user log in -->
                <div class="modal-body p-5">
                    <form>
                        <div class="input-group input-group-sm mb-3 ">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroup-sizing-sm">Station Name</span>
                            </div>
                            <input type="text" class="form-control" aria-label="Sizing example input"
                                aria-describedby="inputGroup-sizing-sm" id="station_data1">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success" onclick="Update()">Save</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Load data func. -->
    <script>
    $(document).ready(function() {
        Load_Line();
    });
    </script>

    <script>
    function Load_Line() {
        document.getElementById("Show_Line").innerHTML = '<div class="center"><span class="loader"></span></div>';

        setTimeout(function() {
            $.ajax({
                url: "ajax/Line_Table.php",
                async: false,
                cache: false,

                success: function(result) {
                    document.getElementById("Show_Line").innerHTML = result;
                }
            });
        }, 1000);
    }
    </script>
    <script src='js/Update_Line.js'></script>
    <script src='js/Add_Line.js'></script>
    <script src='js/Del_Line.js'></script>


    <script>
    $(document).ready(function() {
        Load_Model();
    });
    </script>
    <script>
    function Load_Model() {
        document.getElementById("Show_Model").innerHTML = '<div class="center"><span class="loader"></span></div>';

        setTimeout(function() {
            $.ajax({
                url: "ajax/Model_Table.php",
                async: false,
                cache: false,

                success: function(result) {
                    document.getElementById("Show_Model").innerHTML = result;
                }
            });
        }, 1000);
    }
    </script>
    <script src='js/Update_Model.js'></script>
    <script src='js/Add_Model.js'></script>
    <script src='js/Del_Model.js'></script>

    <script>
    $(document).ready(function() {
        Load_Station();
    });
    </script>
    <script>
    function Load_Station() {
        document.getElementById("Show_Station").innerHTML = '<div class="center"><span class="loader"></span></div>';

        setTimeout(function() {
            $.ajax({
                url: "ajax/Station_Table.php",
                async: false,
                cache: false,

                success: function(result) {
                    document.getElementById("Show_Station").innerHTML = result;
                }
            });
        }, 1000);
    }
    </script>
    <script src='js/Update_Station.js'></script>
    <script src='js/Add_Station.js'></script>
    <script src='js/Del_Station.js'></script>
    <script src='js/Select_Model.js'></script>
    <script src='js/Select_Line.js'></script>
    <script src='js/Select_Station.js'></script>

</body>

</html>