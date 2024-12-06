<?php
session_start();
include_once 'crud.php';


if(isset($_POST['user']) && isset($_POST['pass'])) {
    $username = $_POST['user'];
    $password = $_POST['pass'];
    $err = "";

    $crud = new Crud();
    $crud->login($username, $password, $err);
}
?>