<?php
require_once("db-config.php");
session_start();
if (isset($_SESSION['verify_username']) ) {
    header('Location:'.$hostname.'home.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Boostrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <!-- Font Awsome  -->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@300&display=swap" rel="stylesheet">
    <!-- Custom Css  -->
    <link rel="stylesheet" href="assects/css/Login.css">
    <title>Login</title>
</head>

<body>

    <div id="main_container" class="container rounded shadow">
        <div class="row">
            <div class="col pt-5 pb-2 px-3">
                <form class="Login_form  rounded">
                    <h3 class=" p-3 text-center">Welcome To Login</h3>
                    <div class="errorBox d-none rounded mt-3 d-flex justify-content-center align-items-center">
                        Incorrect User name or password
                    </div>
                    <div class="valid_errorBox d-none rounded mt-3 d-flex justify-content-center align-items-center">
                        Correct username and passord
                    </div>
                    <div class="form-group my-4">
                        <label for="exampleInputEmail1">Username</label>
                        <input type="text" name='username' class="form-control mt-2" id="exampleInputEmail1"
                            aria-describedby="emailHelp" placeholder="">
                    </div>

                    <div class="form-group my-4">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" name='password' class="form-control mt-2" id="exampleInputPassword1"
                            placeholder="">
                    </div>

                    <button type="submit" name='LoginBtn' value="Login"
                        class="btn btn-primary text-center w-100">Login</button>
                    <h6 class="text-center p-3"> <a href="sign-up.php">Sign up here!</a></h6>
                </form>
            </div>
        </div>
    </div>








    <script src="assects/Js/jquery.js"></script>
    <!-- Funtion Script  -->
    <script>
    let adminData = (rawData) => {
        let ajaxRes = $.ajax({
            url: 'data.php',
            type: 'post',
            data: rawData,
            async: false,
            contentType: false,
            processData: false,
        }).responseText;
        return ajaxRes;
    }
    </script>
    <!-- Custom Script  -->
    <script>
    // Event Trigger: When Login Form Submit 
    $('.Login_form').submit(function(event) {
        event.preventDefault();
        const formData = new FormData(this); // Fetching Form Data
        let res = adminData(formData);
        if (res == 1) {
            $('.valid_errorBox').removeClass('d-none');
            setTimeout(() => {
                window.location.href = 'http://localhost:81/Aqib Work/home.php';
            }, 1000)
        } else {
            $('.errorBox').removeClass('d-none');
            setTimeout(() => {
                $('.errorBox').addClass('d-none');
            }, 2000)
        }
    });
    </script>

</body>

</html>