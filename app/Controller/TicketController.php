<?php
error_reporting(E_ALL);
ini_set("display_errors","On");

$action = isset($_GET['action']) ? $_GET['action'] : $action;

if(!isset($_SESSION['user']) && !isset($_SESSION['admin'])){
    header('Location: login?erro=1');
    // print_r($_SESSION['user']);
    // print_r($_SESSION['admin']);
}

require 'Model/ticket.php';

switch($action){
    case 'insert':

        $id = rand(1000000,9999999);
        $subject = $_POST['subject'];
        $description = $_POST['description'];
        $create_date = date("Y-m-d H:i");
        $modified_date = date("Y-m-d H:i");
        $complete_date = date("Y-m-d H:i");
        $status = 'O';
        $id_user = $_SESSION['user'][0]->id;
        $id_category = $_POST['id_category'];

        $dao = new TicketDAO();
        $ticket = new Ticket($id,$subject,$description,$create_date,$modified_date,$complete_date,$status,$id_user,$id_category);
        $dao->insert($ticket);

        if(isset($_POST['id_item'])){
            for ($i=0; $i < sizeof($_POST['id_item']); $i++) { 
                $dao->insertTicketItem($_POST['id_item'][$i],$id,$_POST['item_count'][$i]);
            }
        }
        header('Location: dashboard');

    break;
    case 'update':
        $id = $_POST['id'];
        $id_category = $_POST['id_category'];
        $status = $_POST['status'];
        
        $dao = new TicketDAO();
        $ticket = new Ticket($id,'','','','','','','',$id_category);

        switch ($status){
            case 'P':
                $ticket->modified_date = date("Y-m-d H:i");
                $ticket->status = $status;
                $dao->update($ticket);
                break;
            case 'O':
                $ticket->modified_date = date("Y-m-d H:i");
                $ticket->status = $status;
                $dao->update($ticket);
                break;
            case 'C':
                $ticket->modified_date = date("Y-m-d H:i");
                $ticket->complete_date = date("Y-m-d H:i");
                $ticket->status = $status;
                $dao->close($ticket);
                break;
        }
        header('Location: ticket-update?id='.$id);
    break;
    case 'loanTicketItem':
        $dao = new TicketDAO();
        $dao->loanTicketItem(date("Y-m-d H:i"),$_POST['loaded_count'],$_POST['id_ticket_item'],$_POST['id_item']);
        header('Location: ticket-update?id='.$_POST['id_ticket']);
    break;
    case 'get':
        $dao = new TicketDAO();
        $tickets = $dao->getAll();
        ob_end_clean();
        return $tickets;
    break;
    case 'getJSON':
        $dao = new TicketDAO();
        $tickets = $dao->getJSON();
        ob_end_clean();
        print('{"data":');
        print($tickets);
        print('}');
        return $tickets;
    break;
    case 'getByIdJSON':
        $dao = new TicketDAO();
        $ticket = $dao->getByIdJSON($_POST['id']);
        ob_end_clean();
        print($ticket);
        return $ticket;
    break;
    case 'getByUserJSON':
        $dao = new TicketDAO();
        $tickets = $dao->getByUserJSON();
        ob_end_clean();
        print('{"data":');
        print($tickets);
        print('}');
        return $tickets;
    break;
    default:
        header("Location: login");
    break;
}