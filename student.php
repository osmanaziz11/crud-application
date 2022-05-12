<?php
include("db-config.php");
session_start();
$_SESSION['username']="sjdad";
if (!isset($_SESSION['username']) ) {
    header('Location:'.$hostname.'Login.php');
}
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
$res1=load_studentTable();
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    </script> <!-- Custom Css  -->
    <link rel="stylesheet" href="assects/css/degree.css">
    <title>Admin | Home</title>
</head>

<body>
    <!-- Modal HTML Markup -->
    <!-- Add New Course  -->
    <div id="add_student" class="modal fade">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header justify-content-center">
                    <h3 class="modal-title text-center">Add Student</h3>
                </div>
                <div class="modal-body">
                    <form class="modal-content animate" method="" style="user-select: auto;">
                        <div class="container" style="background-color: rgb(241, 241, 241); user-select: auto;">

                            <div class="form-group">
                                <label for="exampleInputEmail1">ID</label>
                                <input type="number" name="student_id" class="form-control" id="student_id"
                                    aria-describedby="emailHelp" required readonly="readonly">

                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Student Name</label>
                                <input type="text" name="student_name" class="form-control" id="student_name"
                                    aria-describedby="emailHelp" required>

                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Degree</label>
                                <select class="form-control" name="student_degree" id="student_degree" required>
                                    <?php 
                                if($res2 != NULL){
                                    foreach($res2 as $value){
                                    ?>
                                    <option value="<?php echo $value['degree_name'] ?>">
                                        <?php echo $value['degree_name'] ?> </option>
                                    <?php 
                                    }
                                }
                                ?>
                                </select>

                            </div>
                            <p class="valid d-none my-3 p-2" style=" height: 44px;color:black;
  border: 1px solid rgb(74, 182, 110);
  background-color: #72c77d;">Student Added successfully</p>
                            <p class="invalid d-none my-3 p-2" style=" height: 44px;
  border: 1px solid rgb(243, 137, 137);color:black;
  background-color: #f8d7da;">Student Added failed</p>

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
    <div id="update_student" class="modal fade">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header justify-content-center">
                    <h3 class="modal-title text-center">Update Student</h3>
                </div>
                <div class="modal-body">
                    <form class="modal-content animate" method="post" style="user-select: auto;">
                        <div class="container" style="background-color: rgb(241, 241, 241); user-select: auto;">

                            <div class="form-group">
                                <label for="exampleInputEmail1">ID</label>
                                <input type="number" name="update_student_id" class="form-control"
                                    id="update_student_id" aria-describedby="emailHelp" readonly="readonly">

                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Student Name</label>
                                <input type="text" name="update_student_name" class="form-control"
                                    id="update_student_name" aria-describedby="emailHelp" required>

                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Degree</label>
                                <select class="form-control" name="update_student_degree" id="update_student_degree"
                                    required>
                                    <?php 
                                if($res2 != NULL){
                                    foreach($res2 as $value){
                                    ?>
                                    <option value="<?php echo $value['degree_name'] ?>">
                                        <?php echo $value['degree_name'] ?> </option>
                                    <?php 
                                    }
                                }
                                ?>
                                </select>

                            </div>
                            <p class="valid d-none my-3 p-2" style=" height: 44px;color:black;
  border: 1px solid rgb(74, 182, 110);
  background-color: #72c77d;">Student updated successfully</p>
                            <p class="invalid d-none my-3 p-2" style=" height: 44px;
  border: 1px solid rgb(243, 137, 137);color:black;
  background-color: #f8d7da;">Student updated failed</p>
                            <button class="btn btn-success my-4"
                                style="margin-left: 45%; width: 20%; user-select: auto;" name="done"
                                type="submit">Add</button>
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
                    <h3 class="position-absolute start-0 ps-5">Student</h3>
                    <button type="button" class="btn position-absolute end-0 me-4 btn-warning"><a href="logout.php"
                            style="
    text-decoration: none;
    color: black;">Logout</a></button>
                    <button type="button" class="btn btn-primary " data-toggle="modal" data-target="#add_student"
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
                                <th>ID</th>
                                <th>Name</th>
                                <th>Degree</th>
                                <th colspan="2"> Actions </th>
                            </tr>

                            <?php 
                                if($res1 != NULL){
                                    foreach($res1 as $value){
                                    ?>
                            <tr class="text-center">
                                <td><?php echo $value['id']  ?></td>
                                <td><?php echo $value['name']  ?></td>
                                <td><?php echo $value['degree']  ?></td>
                                <td><button class="btn btn-danger delete-btn"
                                        data-del-id="<?php echo $value['id'] ?>">Delete</button></td>
                                <td> <button type="button" data-edit-id="<?php echo $value['id'] ?>"
                                        class="btn btn-primary edit-btn" data-toggle="modal"
                                        data-target="#update_student">
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
        const formData = new FormData(this); // Fetching Form Data
        let res = adminData(formData);
        if (res == 1) {
            $('.valid').removeClass('d-none');
            setTimeout(() => {
                $('.valid').addClass('d-none');
                window.location.href = "http://localhost:81/students-record/student.php"
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
                'student-edit-id': id
            },
            success: function(data) {
                console.log(data)
                const obj = JSON.parse(data);
                $(' #update_student_id').val(obj.id)
                $(' #update_student_name').val(obj.name)
                $(' #update_student_degree').val(obj.degree)

            }
        })
    });
    $('.delete-btn').click(function() {
        var id = $(this).data('del-id');
        $.ajax({
            url: 'data.php',
            type: 'post',
            data: {
                'student-del-id': id
            },
            success: function(data) {
                if (data == 1) {
                    window.location.href = "http://localhost:81/students-record/student.php"
                } else {
                    alert('Delete Operation Failed')
                }
            }
        })
    });
    </script>
</body>

</html>