<?php
require 'constants.php';
//connect to the database
$connect = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if(mysqli_errno($connect)){
    die(mysqli_error($connect));
}
