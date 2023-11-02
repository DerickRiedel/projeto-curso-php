<?php
error_reporting(E_ALL);
ini_set("display_errors","On");

$action = isset($_GET['action']) ? $_GET['action'] : $action;

if(!isset($_SESSION['user']) && !isset($_SESSION['admin'])){
    header('Location: login?erro=1');
}

require 'Model/category.php';

switch($action){
    case 'insert':
        $name = $_POST['name'];
        $description = $_POST['description'];
        $has_item;
        if(!isset($_POST['has_item']))
            $has_item = 0; 
        else
            $has_item = 1; 
        $dao = new CategoryDAO();
        $category = new Category(' ',$name,$description,$has_item);
        $dao->insert($category);
        header('Location: settings');

    break;
    case 'update':
        $id = $_POST['id'];
        $name = $_POST['name'];
        $description = $_POST['description'];
        $has_item;
        
        if(!isset($_POST['has_item']))
            $has_item = 0; 
        else
            $has_item = 1; 
        
        $dao = new CategoryDAO();
        $category = new Category($id,$name,$description,$has_item);
        $dao->update($category);
        header('Location: settings');
    break;
    case 'get':
        $dao = new CategoryDAO();
        $categories = $dao->getAll();
        ob_end_clean();
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
        $dao = new CategoryDAO();
        $category = $dao->getByIdJSON($_POST['id']);
        ob_end_clean();
        print($category);
        return $category;
    break;
    default:
        header("Location: login");
    break;
}