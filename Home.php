<?php
include("db-config.php");
session_start();
if (!isset($_SESSION['verify_username']) ) {
    header('Location:'.$hostname.'Login.php');
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
    <link rel="stylesheet" href="assects/css/home.css">
    <title>Admin | Home</title>
</head>

<body>

    <header>
        <div class="container-fluid">
            <div class="row">
                <div id="header" class="col  position-relative d-flex justify-content-center align-items-center">
                    <h3 class="position-absolute start-0 ps-5"><?php echo $_SESSION['verify_name'] ?></h3>
                    <button type="button" class="btn position-absolute end-0 me-4 btn-warning"><a
                            href="logout.php">Logout</a></button>
                </div>
            </div>
        </div>
    </header>
    <section>
        <div id="content" class="container mt-5">
            <div class="row">
                <div class="col-4 d-flex shadow rounded flex-column">
                    <i class="fas fa-scroll"></i>
                    <button type="button" class="btn btn-primary"><a href="course.php">Course</a></button>
                </div>
                <div class="col-4 d-flex shadow rounded flex-column">
                    <i class="fas fa-user-graduate"></i>
                    <button type="button" class="btn btn-primary"><a href="student.php">Students</a></button>
                </div>
                <div class="col-4 d-flex shadow rounded flex-column">
                    <i class="fas fa-graduation-cap"></i>
                    <button type="button" class="btn btn-primary"><a href="degree.php">Degree</a></button>
                </div>
            </div>
        </div>
    </section>








    <script src="assects/Js/jquery.js"></script>
    <!-- Funtion Script  -->
    <script>
    // let adminData = (rawData) => {
    //     let ajaxRes = $.ajax({
    //         url: 'PHP/fetch-data.php',
    //         type: 'post',
    //         data: rawData,
    //         async: false,
    //         contentType: false,
    //         processData: false,
    //     }).responseText;
    //     return ajaxRes;
    // }
    </script>
    <!-- Custom Script  -->
    <script>
    // // Event Trigger: When Login Form Submit 
    // $('.form').submit(function(event) {
    //     event.preventDefault();
    //     const formData = new FormData(this); // Fetching Form Data
    //     let res = adminData(formData);
    //     if (res == 1) {
    //         $('.right').addClass('valid-error');
    //         setTimeout(() => {
    //             window.location.href = 'http://localhost:81/Apparel/Admin/Dashboard';
    //         }, 1000)
    //     } else {
    //         $('.right').addClass('invalid-error');
    //         setTimeout(() => {
    //             $('.right').removeClass('invalid-error');
    //         }, 2000)
    //     }
    // });
    </script>

</body>

</html>