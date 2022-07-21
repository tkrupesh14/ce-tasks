
<?php
include './header.inc.php';
include './sidebar.inc.php';
if (isset($_GET['id']) && $_GET['id'] > 0) {
    $id = $_GET['id'];
    $sql = "SELECT tasks.*,departments.name, team_members.firstname, team_members.lastname  FROM tasks, departments, team_members where departments.id=tasks.department_id AND team_members.id = tasks.team_members_id AND tasks.id = $id";
    $run = mysqli_query($connection, $sql);
    $row = mysqli_fetch_assoc($run);
    $duedate = strtotime($row['due_date']);
    $assignedOn  = strtotime($row['added_on']);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $row['title'] ?> - <?= $pageTitle?></title>
</head>
<body>
    



<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">
        <!-- Topbar -->
        <?php
        include './topbar.inc.php';
        ?>
        <h1 class="text-primary text-center"><?= $row['title'] ?></h1>
        <p class="font-weight-bold text-center">Assigned On: <?= date('d/m/Y', $assignedOn) ?></p>
        <hr>
        <p class="font-weight-bold text-center">Assigned To: <?= $row['firstname'] ?> <?= $row['lastname'] ?></p>
        <hr>
        <p class="font-weight-bold text-center">Due Date: <?= date('d/m/Y', $duedate) ?></p>
        <hr>
        <p class="font-weight-bold text-center">Description: <br>

        <div class="card o-hidden border-0 shadow-lg m-4">
            <div class="card-body p-0">
        <div class="row">
            <div class="col-lg-12">
                <div class="p-5">
                    <div class="text-center m-2 user"><?= $row['description'] ?>
                    </div>
                </div>
            </div>
        </div>
        </div>
        </div>
        </p>

    </div>
    <?php


    include './footer.inc.php';
    ?>

</body>
</html>