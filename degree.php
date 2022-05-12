<?php
include("db-config.php");
session_start();
if (!isset($_SESSION['verify_username']) ) {
    header('Location:'.$hostname.'Login.php');
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
$res1=load_courseTable();
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="assects/css/degree.css">
    <title>Admin | Home</title>
</head>

<body>
    <!-- Modal HTML Markup -->
    <!-- Add New Course  -->
    <div id="add_degree" class="modal fade">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header justify-content-center">
                    <h3 class="modal-title text-center">Add Program</h3>
                </div>
                <div class="modal-body">
                    <form class="modal-content animate" method="" style="user-select: auto;">
                        <div class="container" style="background-color: rgb(241, 241, 241); user-select: auto;">

                            <div class="form-group">
                                <label for="exampleInputEmail1">ID</label>
                                <input type="number" name="degree_id" class="form-control" id="degree_id"
                                    aria-describedby="emailHelp" disabled>

                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Degree Name</label>
                                <input type="text" name="degree_name" class="form-control" id="degree_name"
                                    aria-describedby="emailHelp" required>

                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Fees</label>
                                <input type="number" name="degree_fees" class="form-control" id="degree_fees"
                                    aria-describedby="emailHelp" required>

                            </div>

                            <div class="mb-4" style="user-select: auto;">
                                <label class="form-label" style="user-select: auto;">Available Courses</label>
                                <br style="user-select: auto;">
                                <select class="form-control" name="degree_courses" id="degree_courses" required>
                                    <?php 
                                if($res1 != NULL){
                                    foreach($res1 as $value){
                                    ?>
                                    <option value="<?php echo $value['course_title'] ?>">
                                        <?php echo $value['course_title'] ?> </option>
                                    <?php 
                                    }
                                }
                                ?>
                                </select>
                            </div>
                            <p class="valid d-none my-3 p-2" style=" height: 44px;color:black;
  border: 1px solid rgb(74, 182, 110);
  background-color: #72c77d;">Degree added successfully</p>
                            <p class="invalid d-none my-3 p-2" style=" height: 44px;
  border: 1px solid rgb(243, 137, 137);color:black;
  background-color: #f8d7da;">Degree added failed</p>
                            <span style="color: red; user-select: auto;">You need to select at least one Course.</span>
                            <button class="btn btn-success my-4"
                                style="margin-left: 45%; width: 20%; user-select: auto;" name="done"
                                type="submit">Add</button>
                        </div>
                    </form>

                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <!-- --------------------  -->

    <!-- Update  -->
    <div id="update_degree" class="modal fade">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header justify-content-center">
                    <h3 class="modal-title text-center">Update Degree</h3>
                </div>
                <div class="modal-body">
                    <form class="modal-content animate" method="" style="user-select: auto;">
                        <div class="container" style="background-color: rgb(241, 241, 241); user-select: auto;">

                            <div class="form-group">
                                <label for="exampleInputEmail1">ID</label>
                                <input type="number" name="update_degree_id" class="form-control" id="update_degree_id"
                                    aria-describedby="emailHelp" readonly="readonly">

                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Degree Name</label>
                                <input type="text" name="update_degree_name" class="form-control"
                                    id="update_degree_name" aria-describedby="emailHelp" required>

                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Fees</label>
                                <input type="number" name="update_fees" class="form-control" id="update_fees"
                                    aria-describedby="emailHelp" required>

                            </div>

                            <div class="mb-4" style="user-select: auto;">
                                <label class="form-label" style="user-select: auto;">Available Courses</label>
                                <br style="user-select: auto;">
                                <select class="form-control" name="update_degree_course" id="update_degree_course"
                                    required>

                                    <?php 
                                if($res1 != NULL){
                                    foreach(load_courseTable() as $value){
                                    ?>
                                    <option value="<?php echo $value['course_title'] ?>">
                                        <?php echo $value['course_title'] ?></option>
                                    <?php 
                                    }
                                }
                                ?>
                                </select>
                            </div>
                            <p class="valid d-none my-3 p-2" style=" height: 44px;color:black;
  border: 1px solid rgb(74, 182, 110);
  background-color: #72c77d;">Degree updated successfully</p>
                            <p class="invalid d-none my-3 p-2" style=" height: 44px;
  border: 1px solid rgb(243, 137, 137);color:black;
  background-color: #f8d7da;">Degree updated failed</p>

                            <span style="color: red; user-select: auto;">You need to select at least one Course.</span>

                            <button class="btn btn-success my-4"
                                style="margin-left: 45%; width: 20%; user-select: auto;" name="done"
                                type="submit">Update</button>
                        </div>
                    </form>

                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <!-- ------------  -->

    <header>
        <div class="container-fluid">
            <div class="row">
                <div id="header" class="col  position-relative d-flex  align-items-center">
                    <h3 class="position-absolute start-0 ps-5">Degree</h3>
                    <button type="button" class="btn position-absolute end-0 me-4 btn-warning"><a href="logout.php"
                            style="
    text-decoration: none;
    color: black;">Logout</a></button>
                    <button type="button" class="btn btn-primary " data-toggle="modal" data-target="#add_degree"
                        style="position: absolute;left: 50%;">
                        Add New
                    </button>
                    <button type="button" class="btn  position-absolute  btn-warning home-btn" style="
    right: 100px;text-decoration:none; color:black;
"><a href="Home.php" style="
    text-decoration: none;
    color: black;
">Home</a></button>

                </div>
            </div>
        </div>
    </header>
    <section>
        <div id="content" class="container mt-5">
            <div class="row">
                <div class="col">
                    <table class="table table-striped table-hover table-bordered">
                        <tbody>
                            <tr class="text-danger text-center">
                                <th>Degree Id</th>
                                <th>Degree Name</th>
                                <th>Fee</th>
                                <th>Courses</th>
                                <th colspan="2"> Actions </th>
                            </tr>
                            <?php 
                                if($res2 != NULL){
                                    foreach($res2 as $value){
                                    ?>
                            <tr class="text-center">
                                <td><?php echo $value['id']  ?></td>
                                <td><?php echo $value['degree_name']  ?></td>
                                <td><?php echo $value['fees']  ?></td>
                                <td><?php echo $value['course_name']  ?></td>
                                <td><button class="btn btn-danger delete-btn"
                                        data-del-id="<?php echo $value['id'] ?>">Delete</button></td>
                                <td> <button type="button" data-edit-id="<?php echo $value['id'] ?>"
                                        class="btn btn-primary edit-btn" data-toggle="modal"
                                        data-target="#update_degree">
                                        Edit
                                    </button></td>
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



                        </tbody>
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
    // Event Trigger: When Add Course Form Submit 
    $('form').submit(function(event) {
        event.preventDefault();
        console.log("object")
        const formData = new FormData(this); // Fetching Form Data

        let res = adminData(formData);
        if (res == 1) {
            $('.valid').removeClass('d-none');
            setTimeout(() => {
                $('.valid').addClass('d-none');
                window.location.href = "http://localhost:81/Aqib Work/degree.php"
                $(this).trigger("reset");
            }, 2000)

        } else {
            $('.invalid').removeClass('d-none');
            setTimeout(() => {
                $('.invalid').addClass('d-none');
            }, 2000)
        }
    });

    $('.edit-btn').click(function() {
        var id = $(this).data('edit-id');
        console.log(id)
        $.ajax({
            url: 'data.php',
            type: 'post',
            data: {
                'degree-edit-id': id
            },
            success: function(data) {
                console.log(data)
                const obj = JSON.parse(data);
                $(' #update_degree_id').val(obj.id)
                $(' #update_degree_name').val(obj.degree_name)
                $(' #update_fees').val(obj.fees)
                $(' #update_degree_course').val(obj.course_name)
            }
        })
    });
    $('.delete-btn').click(function() {
        var id = $(this).data('del-id');
        $.ajax({
            url: 'data.php',
            type: 'post',
            data: {
                'degree-del-id': id
            },
            success: function(data) {
                if (data == 1) {
                    window.location.href = "http://localhost:81/Aqib Work/degree.php"
                } else {
                    alert('Delete Operation Failed')
                }
            }
        })
    });
    </script>

</body>

</html>