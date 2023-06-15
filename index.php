<?php

include "connect/COMMON.php";
// include "ajax/Head.php";

?>



<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Screw.TR | Log in</title>

    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />

    <script src='js/jquery.js'></script>

    <!-- Script BS-->
    <script type="text/javascript" src="js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="js/jquery.slim.min.js"></script>
    <script type="text/javascript" src='js/jquery.min.js'></script>
    <script type="text/javascript" src="js/popper.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/sweetalert2@11.js"></script>
    <script type="text/javascript" src="js/bootstrap4-toggle.min.js"></script>
    <script type="text/javascript" src="js/dataTables.bootstrap4.min.js"></script>
    <script type="text/javascript" src="js/jquery.dataTables.min.js"></script>



    <!-- Font Awesome ver. 5.15.4 -->
    <link rel="stylesheet" href="assets/fontawesome-free-5.15.4-web/css/all.min.css">
    <link href="css/bootstrap/bootstrap4-toggle.min.css" rel="stylesheet" />
    <link href="css/bootstrap/bootstrap.min.css" rel="stylesheet" />
    <link href="css/bootstrap/dataTables.bootstrap4.min.css" rel="stylesheet" />



    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />
    <link href="css/Tab.css" rel="stylesheet" />
</head>




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
    align-items: center
}

.container {
    display: flex;
    height: 100vh;
    justify-content: center;
    align-items: center
}

.wrapper {
    width: 350px;
    height: 350px;
    position: relative;
    border-radius: 10px
}

/* box form */
.outer-card {
    width: 100%;
    height: 100%;
    background-color: #fff;
    border-radius: 20px;
    mix-blend-mode: hard-light;
    box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
}

input,
input::-webkit-input-placeholder {
    font-size: 16px;
    line-height: 3;
    caret-color: #1C364F;
}


/* size button */
.input-buttons {
    width: 100%;
    margin-top: 10px
}

/* log in button */
.input-buttons {
    width: 100%;
    height: 35px;
    border-radius: 5px;
    color: #fff;
    border: none;
    background-color: #1C364F;
    border-radius: 10px;
    cursor: pointer;
    text-decoration: none;
    display: flex;
    justify-content: center;
    align-items: center
}

/* log in button action hover */
.input-buttons:hover {
    width: 100%;
    height: 35px;
    border-radius: 5px;
    color: #1C364F;
    border: none;
    background-color: #fff;
    border-radius: 10px;
    border: 1px solid #1C364F;
    cursor: pointer;
    text-decoration: none;
    display: flex;
    justify-content: center;
    align-items: center
}
</style>


<body>
    <div class="container">
        <div class="wrapper">
            <div class="outer-card p-5 pt-5">
                <h2 style="text-align: center; margin-bottom:1rem">LOG IN</h2>
                <form>
                    <div class="form-group">
                        <label for="username">Employee ID</label>
                        <input type="text" class="form-control" id="Username" placeholder="e.g. 50XXXXXXXX (10 digit)"
                            name="username">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="PW" placeholder="Password as login computer"
                            name="password">
                    </div>
                </form>
                <button class="input-buttons" type="button" onclick="login()"> Log In</button>
            </div>
        </div>
    </div>

    <!-------- JS File -------->
    <script src='js/Login.js'></script>
    <!-- <script src='js/jquery.min.js'></script>
    <script src='js/jquery.js'></script> -->
</body>