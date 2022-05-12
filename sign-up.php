<?php
// require_once("db-config.php");
// session_start();
// $_SESSION['username']="sjdad";
// if (!isset($_SESSION['username']) ) {
//     header('Location:'.$hostname.'Login.php');
// }

function load_degreeTable(){
    include("db-config.php");
     try {
        $sql = $conn->prepare("SELECT * FROM degree");

        $sql->execute();
        $result=NULL;
        $result = $sql->fetchAll(PDO::FETCH_ASSOC);
        if ($result != NULL) {
            return $result;
        } else {
            return null;
        }
    } catch (PDOException $exc) {
        $exc->getMessage();
    }
}
$res2=load_degreeTable();
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
    <link rel="stylesheet" href="assects/css/sign-up.css">
    <title>Create Account</title>
</head>

<body>

    <header>
        <div class="container-fluid">
            <div class="row">
                <div id="header" class="col  position-relative d-flex justify-content-center align-items-center">
                    <h1 class="">Create Account</h1>

                </div>
            </div>
        </div>
    </header>
    <section>
        <form class="mx-1 mx-md-4">
            <div id="form_container" class="container">
                <div class="row">
                    <div class="col p-4">
                        <h4 class="text-center">Sign Up</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col">


                        <div class="d-flex flex-row align-items-center mb-4">
                            <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                            <div class="form-outline flex-fill mb-0">
                                <input type="text" name="new_username" id="new_username" required
                                    class="form-control" />
                                <label class="form-label" for="form3Example1c"> Username</label>
                            </div>
                        </div>




                        <div class="d-flex flex-row align-items-center mb-4">
                            <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                            <div class="form-outline flex-fill mb-0">
                                <input type="password" name="new_password" id="new_password" required
                                    class="form-control" />
                                <label class="form-label" for="form3Example4c">Password</label>
                            </div>
                        </div>




                        <div class="d-flex flex-row align-items-center mb-4">
                            <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                            <div class="form-outline flex-fill mb-0">
                                <input type="text" name="new_name" id="new_name" required class="form-control" />
                                <label class="form-label" for="form3Example1c"> Full Name</label>
                            </div>
                        </div>




                        <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                            <button type="submit" class="btn btn-primary btn-lg">Register</button>
                        </div>


                    </div>
                </div>
            </div>
        </form>
    </section>








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
    $('form').submit(function(event) {
        event.preventDefault();
        const formData = new FormData(this); // Fetching Form Data
        let res = adminData(formData);
        if (res == 1) {

            alert("New user registered successfully!");
            window.location.href = "http://localhost:81/Aqib Work/index.php"

        } else {
            alert("Username Already Exist!");
            $(this).trigger("reset");
        }
    });
    </script>

</body>

</html>