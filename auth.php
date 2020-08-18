<?php
session_start();

require "functions.php";

//var_dump($_POST);

$email = $_POST['email'];
$password= $_POST['password'];


$login = login($email,$password);

if (!empty($login)) {
    redirect_to('/home_page.php');
    exit;
}
redirect_to('/index.php');