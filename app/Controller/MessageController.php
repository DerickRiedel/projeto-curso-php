<?php
error_reporting(E_ALL);
ini_set("display_errors","On");

$action = isset($_GET['action']) ? $_GET['action'] : $action;

if(!isset($_SESSION['user']) && !isset($_SESSION['admin'])){
    header('Location: login?erro=1');
}

require 'Model/message.php';

switch($action){
    case 'insert':
        $id_ticket = $_POST['id_ticket'];
        $description = $_POST['description'];

        $dao = new MessageDAO();
        if(isset($_SESSION['user'])){
            $message = new Message($id_ticket ,null, '',$description);
            $dao->insert($message);
        }else if(isset($_SESSION['admin'])){
            $message = new Message($id_ticket ,$_SESSION['admin'][0]->id, '',$description);
            $dao->insert($message);
        }

    break;
    case 'get':
        $dao = new CategoryDAO();
        $categories = $dao->getAll();
        ob_end_clean();
        // print_r($categories);
        return $categories;
    break;
    case 'getJSON':
        $dao = new CategoryDAO();
        $categories = $dao->getJSON();
        ob_end_clean();
        print('{"data":');
        print($categories);
        print('}');
        return $categories;
    break;
    case 'getByIdJSON':
        $dao = new MessageDAO();
        $messages = $dao->getByTicketJSON($_POST['id']);
        ob_end_clean();
        print('{"data":');
        print($messages);
        print('}');
        return $messages;
    break;
    default:
        header("Location: login");
    break;
}