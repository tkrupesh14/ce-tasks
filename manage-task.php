<?php
include './header.inc.php';
include './sidebar.inc.php';
$id = "";
$msg = "";
$title = "";
$description = "";
$department_id = "";
$team_members_id = "";
$due_date = "";
$status = "";

$sql = "SELECT * FROM departments";
$run = mysqli_query($connection, $sql);

$sql = "select * from team_members";
$run1 = mysqli_query($connection, $sql);

if (isset($_GET['type']) && $_GET['type'] !== '' && isset($_GET['id']) && $_GET['id'] > 0) {
    $type = $_GET['type'];
  $id = $_GET['id'];
  $row = mysqli_fetch_assoc( mysqli_query($connection, "SELECT * FROM tasks WHERE id = $id "));
  $title = $row['title'];
  $description = $row['description'];

  $due_date = $row['due_date'];
  $status = $row['status'];
 
}

if(isset($_POST['submitBtn'])){
    $title = $_POST['title'];
    $description =  $_POST['description'];
    $department_id =  $_POST['department_id'];
    $team_members_id =  $_POST['team_members_id'];
    $due_date =  $_POST['due_date'];
    $status = $_POST['status'];
    if($id == ''){

    $sql = "SELECT * FROM tasks WHERE title = '$title' ";
  }else{
    $sql = "SELECT * FROM tasks WHERE title = '$title' AND id != $id";
    
  }
  if(mysqli_num_rows(mysqli_query($connection, $sql))>0){
    $msg = "Task Alredy Exists.";
  }else{
    if($id == ''){
      
      $sql =" INSERT INTO tasks (title,description,department_id, team_members_id, due_date, status) 
      values('$title', '$description', $department_id, $team_members_id, '$due_date', $status )"; 
    }else{
        $que = mysqli_query($connection, "UPDATE tasks
        set  title = '$title',
        description = '$description',
        department_id = $department_id,
        team_members_id = $team_members_id,
        due_date = '$due_date',
        status = $status
        where id=$id");
        redirect('tasks.php');
    
      }

      $run = mysqli_query($connection, $sql);
      redirect('tasks.php');
    }
}
?>

<head>
    <title>Manage Task - <?= $pageTitle?></title>
    <style>
      #container {
                width: 1000px;
                margin: 20px auto;
            }
            .ck-editor__editable[role="textbox"] {
                /* editing area */
                min-height: 200px;
            }
            .ck-content .image {
                /* block images */
                max-width: 80%;
                margin: 20px auto;
            }
    </style>
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
                Task</h1>
                <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
            </div>

            <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="p-5">
                           
                            <form class="user" method="POST">
                                <div class="row">
                                <div class="form-group col-12">
                                    <input type="text" class="form-control "
                                        id="exampleInputEmail" aria-describedby="emailHelp"
                                        placeholder="Enter Task Title..." name="title" value="<?= $title?>">
                                </div>
                                <div class="form-group col-12">
                                    <textarea name="description" class="form-control" id="editor" cols="30" rows="10" placeholder="Enter Task Description..."><?= $description?></textarea>
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
                                <div class="form-group col-md-6">
                                    <select name="team_members_id" id="" class="form-control">
                                       <option value="">Select Team Member...</option>
                                       <?php
                                            while($row1 = mysqli_fetch_assoc($run1)){
                                                ?>
                                                <option value="<?= $row1['id'] ?>"><?= $row1['firstname'] ?> <?= $row1['lastname'] ?></option>

                                                <?php
                                            }
                                       ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <input type="date" class="form-control "
                                        id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Select Due Date" name="due_date"  value="<?= $due_date?>">
                                </div>
                                <div class="form-group col-md-6">
                                    <select name="status" id="" class="form-control">
                                        
                                        <option value="1">Complete</option>
                                        <option value="0">Pending</option>
                                    </select>
                                </div>
                                
                                <input type="submit" name="submitBtn" id="" value="<?php
                    if(isset($_GET['type']) == 'update'){
                        echo "Update";
                    }else{
                        echo "Add";
                    }
                ?> Task" class="btn btn-primary btn-user btn-block">
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

    <script src="https://cdn.ckeditor.com/ckeditor5/34.2.0/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
        .create( document.querySelector( '#editor' ) )
        .catch( error => {
            console.error( error );
        } );
    </script>
    <?php
    include './footer.inc.php';
    ?>