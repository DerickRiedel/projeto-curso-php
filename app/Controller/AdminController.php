<?php
error_reporting(E_ALL);
ini_set("display_errors","On");

$action = isset($_GET['action']) ? $_GET['action'] : $action;

require 'Model/admin.php';

session_start();

switch($action){
    case 'insert':
        $id = rand(10000,99999);
        $name = $_POST['username'];
        $password = $_POST['password'];
        $email = $_POST['email'];

        $dao = new AdminDAO();
        $admin = new Admin($id,$name,$password,date("Y-m-d H:i"),$email);
        $dao->insert($admin);
    break;
    case 'login':
        // echo 'teste';
        $dao = new AdminDAO();

        $admin = $dao->login($_POST['email'],$_POST['password']);

        if($admin != null){
            session_unset();
            $_SESSION['admin'] = $admin;
            header("Location: dashboard");
        }else{
            header("Location: login?erro=2");
        }
    break;
    case 'logout':
        session_unset();
        header("Location: login");
    break;
    default:
        header("Location: login");
    break;
}