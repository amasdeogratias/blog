<?php
error_reporting(0);
require '../config/constants.php';

if (!isset($_SESSION['user_is_admin'])) {
    header("Location: ". ROOT_URL . 'admin/dashboard.php');
    exit();
}