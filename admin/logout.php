<?php 

session_start();
var_dump($_SESSION);
session_destroy();
header('location:login.php');