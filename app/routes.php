<?php
    
$uri = parse_url($_SERVER['REQUEST_URI'])['path'];


$routes = 
[
    '/' => 'View/Public/index.php',
    '/login' => 'View/Public/login.php',
    '/signup' => 'View/Public/signup.php',
    '/dashboard' => 'View/Public/dashboard.php',
    '/ticket-update' => 'View/Public/ticket.php',
    
    '/admin' => 'View/Admin/index.php',
    '/admin/login' => 'View/Admin/login.php',
    '/admin/ticket-update' => 'View/Public/ticket.php',
    '/admin/dashboard' => 'View/Admin/dashboard.php',
    '/admin/settings' => 'View/Admin/settings.php',
    
    '/user' => 'Controller/UserController.php',
    '/admin/user' => 'Controller/UserController.php',
    '/ticket' => 'Controller/TicketController.php',
    '/admin/ticket' => 'Controller/TicketController.php',
    '/category' => 'Controller/CategoryController.php',
    '/admin/category' => 'Controller/CategoryController.php',
    '/message' => 'Controller/MessageController.php',
    '/admin/message' => 'Controller/MessageController.php', 
    '/item' => 'Controller/ItemController.php',
    '/admin/item' => 'Controller/ItemController.php',
    
    '/admin/admin' => 'Controller/AdminController.php',


    '/admin/template/user/user' => 'View/Template/user/user.php',
    '/admin/template/user/profile' => 'View/Template/user/profile.php',
    '/template/user/profile' => 'View/Template/user/profile.php',
    '/template/ticket/create' => 'View/Template/ticket/create.php',
    '/template/ticket/list' => 'View/Template/ticket/list.php',
    '/admin/template/ticket/list' => 'View/Template/ticket/list.php',
    '/template/message/list' => 'View/Template/message/list.php',
    '/admin/template/message/list' => 'View/Template/message/list.php',
    '/admin/template/category/list' => 'View/Template/category/list.php',
    '/admin/template/item/list' => 'View/Template/item/list.php',
    '/admin/template/user/update' => 'View/Template/user/update.php',

];

if(array_key_exists($uri,$routes)){
    require $routes[$uri];
}else{
    header('http/1.0 404 Not Found');
}