<?php

include "connect/COMMON.php";
include "ajax/Head.php";
if (!session_id()) { session_start(); }
ob_start(); 

/* User Login */
$admin_login = $_SESSION[Name];

?>

<!DOCTYPE html>
<html lang="en">


<link href="css/UserManage.css" rel="stylesheet" />
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
    <!-- Menu Tab Left-->
    <?php require 'component/Tab.php';?>
    <div class="layout">
        <!-- Card UserManage -->
        <div class="container" id="main">
            <div class="card " style="wEmailidth:30rem; height:30rem; width:60rem">
                <div class="card-body pt-0 pl-0">
                    <!-- Head Topic -->
                    <div class="topic">
                        <i class="fas fa-user-friends"></i>
                        <label class="text">User Manage</label>
                    </div>
                    <!-- Button Add User -->
                    <div style="  margin-top: 4rem; display: flex; justify-content:flex-end;  margin-right: 2rem;">
                        <button type="button" class="btn-add" data-toggle="modal" data-target="#AddUserModal"
                            data-backdrop="static">
                            <i class="fas fa-user-plus"></i>&nbsp; Add User
                        </button>
                    </div>
                    <!-- user_data table -->
                    <div id="Show" class="scroll"></div>
                </div>
            </div>


            <!--------------------------- All Modal ---------------------------------->
            <!-- Modal Add -->
            <div class="modal fade" id="AddUserModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-user-plus"></i>&nbsp;Add
                                User</h5>
                        </div>
                        <input id="admin_login" value="<?php echo $admin_login; ?>" hidden />
                        <div class="modal-body p-5">
                            <form><label for="exampleFormControlInput1">Employee ID</label>
                                <div class="form-group d-flex justify-content-between">
                                    <input type="text" class="form-control col-lg-10" id="input"
                                        placeholder="GID (10 digit) OR ID (8 digit)">
                                    <button type="button" class="btn btn-primary" onclick="Search_User()"><i
                                            class="fas fa-search"></i></button>
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Name</label>
                                    <input type="text" class="form-control" id="emp_name" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Role</label>
                                    <select class="form-select" aria-label="Default select example" id="emp_role">
                                        <option value="">Select Role...</option>
                                        <option value="Admin">Admin</option>
                                        <option value="User">User</option>
                                    </select>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                            <button type="button" class="btn btn-success" onclick="Add_user()">Save</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal Edit -->
            <input id="id_hold_user" hidden />
            <div class="modal fade" id="UserEditModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-user-edit"></i>&nbsp;Edit
                                User
                            </h5>
                        </div>

                        <div class="modal-body p-5">
                            <!-- Employee_Id OF User Log In -->
                            <input id="admin_login" value="<?php echo $admin_login; ?>" hidden />
                            <!-- Form User Edit -->
                            <form>
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Employee ID: </label>
                                    <input id="employee_id" style="border:none; outline: none;" readonly />
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Emplyee Name: </label>
                                    <input id="employee_name" style="border:none; outline: none;" readonly />
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Current Role: <input id="employee_role"
                                            style="border:none; outline: none;" readonly /></label>
                                    <select class="form-select" aria-label="Default select example" id="role_value"
                                        onchange="(this.value)">
                                        <option value="">Role new...</option>
                                        <option value="Admin">Admin</option>
                                        <option value="User">User</option>
                                    </select>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                            <button type="button" class="btn btn-success" onclick="Update_User()"
                                id="myBtn">Save</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--------------------------- script function and JS file ---------------------------------->

    <!-- Load data func. -->
    <script>
    $(document).ready(function() {
        load_all_view();
    });
    </script>
    <script>
    function load_all_view() {
        document.getElementById("Show").innerHTML = '<div class="center"><span class="loader"></span></div>';

        setTimeout(function() {
            $.ajax({
                url: "ajax/User_Table.php",
                async: false,
                cache: false,

                success: function(result) {
                    document.getElementById("Show").innerHTML = result;
                }
            });
        }, 1000);
    }
    </script>

    <!-- Delete func -->
    <script>
    function Delete(e) {

        var emp_id = e;

        $.ajax({
            type: "GET",
            url: "ajax/User_Del.php",
            async: false,
            cache: false,
            data: {
                Emp_ID: emp_id
            },

            success: function(result) {
                Swal.fire({
                    width: 400,
                    title: 'Delete Successfully!',
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 1500
                });
                load_all_view();


            }

        });

    }
    </script>


    <script src="js/Search_User.js"></script>
    <script src="js/Update_User.js"></script>
    <script src="js/Add_User.js"></script>

</body>

</html>