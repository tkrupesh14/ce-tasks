<?php
include './functions.inc.php';

session_start();
unset($_SESSION['TEAM_IS_LOGIN']);
redirect('team_login.php');
session_destroy();
?>