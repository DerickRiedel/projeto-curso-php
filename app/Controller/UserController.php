<?php
error_reporting(E_ALL);
ini_set("display_errors","On");

$action = isset($_GET['action']) ? $_GET['action'] : $action;

require 'Model/user.php';

switch($action){
    case 'insert':
        $id = rand(10000,99999);
        $name = $_POST['username'];
        $password = $_POST['password'];
        $email = $_POST['email'];

        $dao = new UserDAO();
        $user = new User($id,$name,$password,date("Y-m-d H:i"),$email,'');
        $dao->insert($user);
        header("Location: login");
    break;
    case 'update':
        $id = $_POST['username'];
        $name = $_POST['username'];
        $password = $_POST['password'];
        $email = $_POST['email'];
        $sector = $_POST['sector'];

        $dao = new UserDAO();
        $user = new User($id,$name,$password,date("Y-m-d H:i"),$email,$sector);
        // $dao->update($user);
        header("Location: login");
    break;
    case 'login':
        $dao = new UserDAO();

        $user = $dao->login($_POST['email'],$_POST['password']);

        if($user != null){
            session_unset();
            $_SESSION['user'] = $user;
            header("Location: dashboard");
        }else{
            header("Location: login?erro=2");
        }
    break;
    case 'getByIdJSON':
        $dao = new UserDAO();

        $user = $dao->getByIdJSON($_POST['id_user']);
        ob_end_clean();
        print($user);
        return $user;
    break;
    case 'logout':
        session_unset();
        header("Location: login");
    break;
    default:
        header("Location: login");
    break;
}