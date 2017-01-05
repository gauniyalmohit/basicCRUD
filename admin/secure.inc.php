<?php
session_start();
if (!isset($_SESSION['user_name'])) {
    header('location:../login.php');
} else if ($_SESSION['role_name'] != 'admin') {
    header('location:../login.php');
}
?>