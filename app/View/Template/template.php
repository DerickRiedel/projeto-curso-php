<?php

class Template{


    public function ticket_list(string $action = null){
        include 'ticket/list.php';
    }
    public function ticket(string $action = null){
        switch($action){
            case 'create':
                include 'ticket/create.php'; 
            break;
            case 'update':
                include 'ticket/update.php'; 
            break;
        }
    }
    public function category_list(string $action = null){
        include 'category/list.php';
    }
    public function category(string $action = null){
        switch($action){
            case 'create':
                include 'category/create.php'; 
            break;
            case 'update':
                include 'category/update.php'; 
            break;
        }
    }
    public function item(string $action = null){
        switch($action){
            case 'create':
                include 'item/create.php'; 
            break;
            case 'update':
                include 'item/update.php'; 
            break;
        }
    }
    public function item_list(string $action = null){
        include 'item/list.php';
    }
    public function item_ticket_list(string $action = null){
        include 'item/ticket_list.php';
    }
    public function item_insert_list(string $action = null){
        include 'item/list_insert.php';
    }
    public function message_list(string $action = null){
        include 'message/list.php';
    }
    public function header(string $action = null){
        include 'header.php';
    }
}
