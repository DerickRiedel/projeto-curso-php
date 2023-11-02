<?php
error_reporting(E_ALL);
ini_set("display_errors","On");

$action = isset($_GET['action']) ? $_GET['action'] : $action;

if(!isset($_SESSION['user']) && !isset($_SESSION['admin'])){
    header('Location: login?erro=1');
}

require 'Model/item.php';

switch($action){
    case 'insert':
        $id = rand(100000,999999);
        $name = $_POST['item_name'];
        $description = $_POST['item_description'];
        $value = $_POST['item_value'];
        $count = $_POST['item_count'];
        $create_date = date("Y-m-d H:i");

        $dao = new ItemDAO();
        $item = new Item($id,$name,$description,$value,$create_date,$count);
        $dao->insert($item);
        header("Location: settings");
    break;
    case 'update':
        $id = $_POST['id_item'];
        $name = $_POST['item_name'];
        $description = $_POST['item_description'];
        $value = $_POST['item_value'];
        $count = $_POST['item_count'];
        
        $dao = new ItemDAO();

        $item = new Item($id,$name,$description,$value,'',$count);

        $dao->update($item);
        header('Location: settings');
    break;
    case 'get':
        $dao = new ItemDAO();
        $items = $dao->getAll();
        ob_end_clean();
        return $items;
    break;
    case 'getJSON':
        $dao = new ItemDAO();
        $items = $dao->getJSON();
        ob_end_clean();
        print('{"data":');
        print($items);
        print('}');
        return $items;
    break;
    case 'getByIdJSON':
        $dao = new ItemDAO();
        $item = $dao->getByIdJSON($_POST['id']);
        ob_end_clean();
        print($item);
        return $item;
    break;
    case 'getByTicketJSON':
        $dao = new ItemDAO();
        $items = $dao->getByTicketJSON($_POST['id_ticket']);
        ob_end_clean();
        print('{"data":');
        print($items);
        print('}');
        return $items;
    break;
    default:
        header("Location: login");
    break;
}