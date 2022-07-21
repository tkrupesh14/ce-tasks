<?php
include './header.inc.php';
include './sidebar.inc.php';

$msg = "";

$sql = "SELECT * FROM departments";
$run = mysqli_query($connection, $sql);
$name = "";
$status = "";
$id = "";
if (isset($_GET['type']) && $_GET['type'] !== '' && isset($_GET['id']) && $_GET['id'] > 0) {
  $type = $_GET['type'];
  $id = $_GET['id'];
 $row = mysqli_fetch_assoc( mysqli_query($connection, "SELECT * FROM departments WHERE id = '$id' "));
 $name = $row['name'];
 $status = $row['status'];

  }

if(isset($_POST['submitBtn'])){
    $name = $_POST['name'];
    $status = $_POST['status'];
  if($id == ''){

    $sql = "SELECT * FROM departments WHERE name = '$name' ";
  }else{
    $sql = "SELECT * FROM departments WHERE name = '$name' AND id != $id";
    
  }
  if(mysqli_num_rows(mysqli_query($connection, $sql))>0){
    $msg = "Department Alredy Exists.";
  }else{
    if($id == ''){
      
      $sql =" INSERT INTO departments (name, status) values('$name', $status) "; 
    }else{
        $que = mysqli_query($connection, "UPDATE departments SET name = '$name' , status = '$status' WHERE id = $id");
        redirect('departments.php');
    
      }

      $run = mysqli_query($connection, $sql);
      redirect('departments.php');
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
                Department</h1>
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
                                        placeholder="Enter Department Name..." name="name" value="<?= $name?>">
                                </div>
                                <div class="form-group col-md-6">
                                    <select name="status" id="" class="form-control" value="<?= $status?>">
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    
                                </div>
                                
                                <input type="submit" name="submitBtn" id="" value="<?php
                    if(isset($_GET['type']) == 'update'){
                        echo "Update";
                    }else{
                        echo "Add";
                    }
                ?> Department" class="btn btn-primary btn-user btn-block">
                                <hr>
                                <!-- <a href="index.html" class="btn btn-google btn-user btn-block">
                                    <i class="fab fa-google fa-fw"></i> Login with Google
                                </a>
                                <a href="index.html" class="btn btn-facebook btn-user btn-block">
                                    <i class="fab fa-facebook-f fa-fw"></i> Login with Facebook
                                </a> -->
                                </div>
                            </form>
                            <!-- <div class="text-center font-weight-bold text-danger"><?= $msg?></div> -->
                            
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