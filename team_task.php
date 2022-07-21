<?php
include './header.inc.php';
include './sidebar.inc.php';
if(!isset($_SESSION['TEAM_IS_LOGIN'])){
    redirect('team_login.php');
}
$u = $_SESSION['u'];
$uid = $_SESSION['uid'];
$sql = "SELECT * FROM team_members where username = '$u' ";
$run = mysqli_query($connection, $sql);
$nm = mysqli_fetch_assoc($run);


$sql = "SELECT tasks.*,departments.name, team_members.firstname, team_members.lastname  FROM tasks, departments, team_members where departments.id =tasks.department_id AND team_members.id = tasks.team_members_id AND tasks.team_members_id = $uid";
$run = mysqli_query($connection, $sql);

if (isset($_GET['type']) && $_GET['type'] !== '' && isset($_GET['id']) && $_GET['id'] > 0) {
    $type = $_GET['type'];
    $id = $_GET['id'];
 
    if ($type == 'active' || $type == 'deactive') {
        $status = 1;
        if ($type == 'deactive') {
            $status = 0;
        }
        $que = mysqli_query($connection, "UPDATE tasks SET status = '$status' WHERE id = $id");
        redirect('team_task.php');
    }
}


?>
<head>
    <title>tasks - <?= $pageTitle?></title>
        
    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
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
                <h1 class="h3 mb-0 text-gray-800">Welcome, <?= $nm['firstname'] ?></h1>
                <a href="#"id = "button" onclick="printData();" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
            </div>

            <!-- DataTales Example -->
           
            <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Tasks</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>ID #</th>
                                            <th>Title</th>
                                            <th>Department </th>
                                            <th>Team Member </th>
                                            <th>Due Date</th>
                                            <th>Status</th>
                                           
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                        <th>ID #</th>
                                            <th>Title</th>
                                            <th>Department </th>
                                            <th>Team Member </th>
                                            <th>Due Date</th>
                                            <th>Status</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php
                                            if(mysqli_num_rows($run)>0){
                                                $no = 0;
                                                while ($row = mysqli_fetch_assoc($run)){

                                                    ?>
                                                        <tr>
                                                            <td ><?= $no+=1?></td>
                                                        <td><a href="./task-details.php?id=<?= $row['id']?>" > <?= $row['title'] ?> </a></td>
                                                            <td><?= $row['name'] ?></td>
                                                            <td><?= $row['firstname'] ?> <?= $row['lastname'] ?></td>
                                                            <td><?=    date('d-M-Y', strtotime($row['due_date'])); ?></td>
                                                            
                                                            <td>
                                                                <?php
                                                                if($row['status'] == '1'){
                                                                    ?>
                                                                    <a href="?id=<?= $row['id'] ?>&type=deactive">
                                                                            <div class="badge badge-pill badge-success">Complete</div>
                                                                            </a>
                                                                            <?php
                                                                }else{
                                                                    
                                                                    
                                                                    ?>
                                                                    <a href="?id=<?= $row['id'] ?>&type=active">
                                                                    <div class="badge badge-pill badge-warning">Pending</div>
                                                                    </a>

                                                                    <?php
                                                                }
                                                                ?>
                                                        </td>
                                                            

                                                    <?php
                                                }
                                            }else{

                                                ?>

                                                    <tr>
                                                    <td colspan="10" class="text-center">No Data Found</td>
                                                    </tr>
                                                <?php
                                            }
                                        ?>
                                    
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
        </div>
    </div>


    
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>

    <script>
        function printData()
{
let dataTable = document.getElementById('dataTable');
window.print(dataTable);
}
// $('#button').on('click',function(){
// printData();
// })

        
    </script>
    <?php
    include './footer.inc.php';
    ?>