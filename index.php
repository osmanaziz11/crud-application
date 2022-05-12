<?php
require_once("db-config.php");
// session_start();
// if (!isset($_SESSION['verify_username']) ) {
//     header('Location:'.$hostname.'Login.php');
// }
function load_studentTable(){
    include("db-config.php");
     try {
        $sql = $conn->prepare("SELECT * FROM student");

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
function load_courseTable(){
    include("db-config.php");
     try {
        $sql = $conn->prepare("SELECT * FROM course");

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
function get_indexData($val){
     include("db-config.php");
     try {
        $sql = $conn->prepare("SELECT * FROM degree where degree_name = ?");
        $sql->execute([$val]);
        $result=NULL;
        $result = $sql->fetch(PDO::FETCH_ASSOC);
        if ($result != NULL) {
            return $result;
        } else {
            return null;
        }
    } catch (PDOException $exc) {
        $exc->getMessage();
    }
}
$course=load_courseTable();
$degree=load_degreeTable();
$student=load_studentTable();

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
    <link rel="stylesheet" href="assects/css/index.css">
    <title>Login</title>
</head>

<body>

    <header>
        <div class="container-fluid">
            <div class="row">
                <div id="header" class="col  position-relative d-flex justify-content-center align-items-center">
                    <h3 class="position-absolute start-0 ps-5">Students And Their Grades</h3>
                    <button type="button" class="btn position-absolute end-0 me-4 btn-warning"><a href="Login.php"
                            style="  text-decoration: none !important;
  color: black;">Login</a></button>
                </div>
            </div>
        </div>
    </header>
    <section>
        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
            <div class="container">
                <div class="row">
                    <div id="" class="col p-4">
                        <h5>Degree</h5>
                    </div>
                    <div class="col p-4">
                        <h5>Fee</h5>
                    </div>
                    <div class="col p-4">
                        <h5>Course</h5>
                    </div>
                </div>
                <div class="row">
                    <div class="col w-100">
                        <select class="form-control" name="index_degree" id="index_degree">
                            <?php 
                                if($degree != NULL){
                                    foreach($degree as $value){
                                    ?>
                            <option value="<?php echo $value['degree_name'] ?>">
                                <?php echo $value['degree_name'] ?> </option>
                            <?php 
                                    }
                                }
                                ?>
                        </select>
                    </div>
                    <div class="col w-100">
                        <select class="form-control" name="index_fees" id="index_fees">
                            <?php 
                                if($degree != NULL){
                                    foreach($degree as $value){
                                    ?>
                            <option value="<?php echo $value['fees'] ?>">
                                <?php echo $value['fees'] ?> </option>
                            <?php 
                                    }
                                }
                                ?>
                        </select>
                    </div>
                    <div class="col w-100">
                        <select class="form-control" name="index_course" id="index_course" required>
                            <?php 
                                if($course != NULL){
                                    foreach($course as $value){
                                    ?>
                            <option value="<?php echo $value['course_title'] ?>">
                                <?php echo $value['course_title'] ?> </option>
                            <?php 
                                    }
                                }
                                ?>
                        </select>
                    </div>
                </div>
                <div class="row my-4">
                    <div class="col-6 p-2 d-flex justify-content-end"><button type="submit"
                            class="btn btn-primary btn-sm" name="sbtn">Submit</button>

                    </div>
                    <div class="col-6 p-2 d-flex"> <button type="submit" class="btn btn-secondary btn-sm"><a
                                href="index.php" style="  text-decoration: none !important;
  color: snow;">Refresh</a></button>
                    </div>
                </div>
            </div>
        </form>
        <?php
        if(isset($_POST['sbtn'])){
        $resp=get_indexData($_POST['index_degree']);

        }
?>


        <div id="content" class="container">
            <div class="row">
                <div class="col">
                    <table class="table">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Student Name</th>
                                <th scope="col">Degree</th>


                            </tr>
                            <?php 
                                if($student != NULL){
                                    foreach($student as $value){
                                    ?>
                            <tr class="">
                                <td><?php echo $value['id']  ?></td>
                                <td><?php echo $value['name']  ?></td>
                                <td><?php echo $value['degree']  ?></td>


                            </tr>
                            <?php   }
                            }else
                            {
                            ?> <tr class="text-center">
                                <td>No Record Found</td>
                                <td>No Record Found</td>
                                <td>No Record Found</td>
                            </tr>
                            <?php 
                            }
                            ?>


                        </thead>

                    </table>


                </div>
            </div>
        </div>

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
    // $('form').submit(function(event) {
    //     event.preventDefault();
    //     const formData = new FormData(this); // Fetching Form Data
    //     $.ajax({
    //         url: 'data.php',
    //         type: 'post',
    //         data: formData,
    //         async: false,
    //         contentType: false,
    //         processData: false,
    //         success: function(data) {
    //             console.log(data)
    //         }
    //     })
    // });
    </script>

</body>

</html>