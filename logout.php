<?php
include './functions.inc.php';

session_start();
unset($_SESSION['IS_LOGIN']);
redirect('login.php');
session_destroy();
?>