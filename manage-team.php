<?php
include './header.inc.php';
include './sidebar.inc.php';
$id = "";
$msg = "";
$firstname = "";
$lastname = "";
$username = "";
$department_id = "";
$phone = "";
$email = "";
$password = "";
$gender = "";
$status = "";

$sql = "SELECT * FROM departments";
$run = mysqli_query($connection, $sql);
if (isset($_GET['type']) && $_GET['type'] !== '' && isset($_GET['id']) && $_GET['id'] > 0) {
  $type = $_GET['type'];
  $id = $_GET['id'];
 $row = mysqli_fetch_assoc( mysqli_query($connection, "SELECT * FROM team_members WHERE id = '$id' "));
 $firstname = $row['firstname'];
 $lastname = $row['lastname'];
 $username = $row['username'];
 $phone = $row['phone'];
 $email = $row['email'];

  }

if(isset($_POST['submitBtn'])){
    $firstname = $_POST['firstname'];
 $lastname = $_POST['lastname'];
 $username = $_POST['username'];
 $department_id = $_POST['department_id'];
 $phone = $_POST['phone'];
 $email = $_POST['email'];
 $password = $_POST['password'];
 $gender = $_POST['gender'];
 $status = $_POST['status'];
  if($id == ''){

    $sql = "SELECT * FROM team_members WHERE firstname = '$firstname', lastname = '$lastname, username = '$username', phone = '$phone', email = '$email' ";
  }else{
    $sql = "SELECT * FROM team_members WHERE firstname = '$firstname', lastname = '$lastname, username = '$username', phone = '$phone', email = '$email' AND id != $id";
    
  }
  if(mysqli_num_rows(mysqli_query($connection, $sql))>0){
    $msg = "Team Member Alredy Exists.";
  }else{
    if($id == ''){
      
      $sql =" INSERT INTO team_members (firstname,lastname,username, department_id, phone, email,password,gender, status) values('$firstname','$lastname', '$username', $department_id, '$phone', '$email', '$password', '$gender' , $status) "; 
    }else{
        $que = mysqli_query($connection, "UPDATE team_members SET firstname = '$firstname', lastname = '$lastname, username = '$username',department_id = $department_id,  phone = '$phone', email = '$email', password = '$password', gender = '$gender', status ='$status  WHERE id = $id");
        redirect('team.php');
    
      }

      $run = mysqli_query($connection, $sql);
      redirect('team.php');
    }
}
?>

<head>
    <title>Manage Departments - <?= $pageTitle?></title>
</head>

<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        <!-- Topbar -->
        <?php
        include './topbar.inc.php';
        ?>
        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">
                <?php
                    if(isset($_GET['type']) == 'update'){
                        echo "Update";
                    }else{
                        echo "Add";
                    }
                ?>
                Team Member</h1>
                <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
            </div>

            <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="p-5">
                            <div class="text-center">
                            </div>
                            <form class="user" method="POST">
                                <div class="row">
                                <div class="form-group col-md-6">
                                    <input type="text" class="form-control "
                                        id="exampleInputEmail" aria-describedby="emailHelp"
                                        placeholder="Enter First Name..." name="firstname" value="<?= $firstname?>">
                                </div>
                                <div class="form-group col-md-6">
                                    <input type="text" class="form-control "
                                        id="exampleInputEmail" aria-describedby="emailHelp"
                                        placeholder="Enter Last Name..." name="lastname" value="<?= $lastname?>">
                                </div>
                                <div class="form-group col-md-6">
                                    <input type="text" class="form-control "
                                        id="exampleInputEmail" aria-describedby="emailHelp"
                                        placeholder="Enter Username..." name="username" value="<?= $username?>">
                                </div>
                                <div class="form-group col-md-6">
                                    <select name="department_id" id="" class="form-control">
                                       <option value="">Select Department...</option>
                                       <?php
                                            while($row = mysqli_fetch_assoc($run)){
                                                ?>
                                                <option value="<?= $row['id'] ?>"><?= $row['name'] ?></option>

                                                <?php
                                            }
                                       ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <input type="number" class="form-control "
                                        id="exampleInputEmail" aria-describedby="emailHelp"
                                        placeholder="Enter Contact Number..." name="phone" value="<?= $phone?>">
                                </div>
                                <div class="form-group col-md-4">
                                    <input type="email" class="form-control "
                                        id="exampleInputEmail" aria-describedby="emailHelp"
                                        placeholder="Enter Email..." name="email" value="<?= $email?>">
                                </div>
                                <div class="form-group col-md-4">
                                    <input type="text" class="form-control "
                                        id="exampleInputEmail" aria-describedby="emailHelp"
                                        placeholder="Enter Password..." name="password">
                                </div>
                                <div class="form-group col-md-6">
                                    <select name="gender" id="" class="form-control" value="<?= $status?>">
                                        <option value="M">Male</option>
                                        <option value="F">Female</option>
                                        <option value="O">Other</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <select name="status" id="" class="form-control" value="<?= $status?>">
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                </div>
                                
                                <input type="submit" name="submitBtn" id="" value="<?php
                    if(isset($_GET['type']) == 'update'){
                        echo "Update";
                    }else{
                        echo "Add";
                    }
                ?> Team Member" class="btn btn-primary btn-user btn-block">
                                <hr>
                                <!-- <a href="index.html" class="btn btn-google btn-user btn-block">
                                    <i class="fab fa-google fa-fw"></i> Login with Google
                                </a>
                                <a href="index.html" class="btn btn-facebook btn-user btn-block">
                                    <i class="fab fa-facebook-f fa-fw"></i> Login with Facebook
                                </a> -->
                                </div>
                            </form>
                            <div class="text-center font-weight-bold text-danger"><?= $msg?></div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
    <?php
    include './footer.inc.php';
    ?>