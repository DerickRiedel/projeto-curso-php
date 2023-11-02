<?php 

require "basicDAO.php";

class Ticket{
    public $id;
    public $subject;
    public $description;
    public $create_date;
    public $modified_date;
    public $complete_date;
    public $status;
    public $id_user;
    public $id_category;

    public function __construct($id,$subject,$description,$create_date,$modified_date,$complete_date,$status,$id_user,$id_category)
    {
        $this->id = $id;
        $this->subject = $subject;
        $this->description = $description;
        $this->create_date = $create_date;
        $this->modified_date = $modified_date;
        $this->complete_date = $complete_date;
        $this->status = $status;
        $this->id_user = $id_user;
        $this->id_category = $id_category;
    }
}

class TicketDAO extends BasicDAO{
    function getJSON(){
        return parent::execJsonQUERY("SELECT * FROM ticket");
    }

    function getByUserJSON(){
        return parent::execFilteredJsonQUERY("SELECT * FROM ticket WHERE fk_userlogin_id = ?",$_SESSION['user'][0]->id);
    }
    
    function getByIdJSON($id){
        return parent::execFilteredJsonQUERY("SELECT * FROM ticket WHERE id = ?",$id);
    }

    function getAll(){
        return parent::execQUERY("SELECT * FROM ticket");
    }

    function insert(Ticket $ticket){ 
        parent::execDML( 
            'INSERT INTO ticket 
            (id, subject, description, create_date, modified_date, complete_date, status, fk_userlogin_id, fk_category_id) 
            VALUES 
            (?,?,?,?,?,?,?,?,?)', 
            $ticket->id, 
            $ticket->subject, 
            $ticket->description, 
            $ticket->create_date, 
            $ticket->modified_date, 
            $ticket->complete_date, 
            $ticket->status, 
            $ticket->id_user, 
            $ticket->id_category 
        );
    }

    function insertTicketItem($id_item,$id_ticket,$count){ 
        parent::execDML( 
            'INSERT INTO ticket_item (fk_ticket_id, fk_item_id, id, count,pending, loaded) 
            VALUES 
            (?,?,DEFAULT,?,?,?)', 
            $id_ticket, 
            $id_item, 
            $count,  
            $count,  
            0
        );
    }

    function update(Ticket $ticket){
        parent::execDML( 
            'UPDATE ticket SET
            modified_date = ?,
            status = ?,
            fk_category_id = ?
            WHERE id = ?
            ', 
            $ticket->modified_date, 
            $ticket->status, 
            $ticket->id_category,
            $ticket->id
        );
    }

    function loanTicketItem($loan_date, $loaded, $id, $id_item){
        parent::execDML( 
            'UPDATE TICKET_ITEM 
                SET LOADED = CASE 
                    WHEN (
                        SELECT COUNT FROM ITEM WHERE ID = TICKET_ITEM.FK_ITEM_ID
                    ) >= ? THEN LOADED + ? 
                    ELSE LOADED END,
                
                PENDING = CASE 
                    WHEN (
                        SELECT COUNT FROM ITEM WHERE ID = TICKET_ITEM.FK_ITEM_ID
                    ) >= ? THEN PENDING - ? 
                    ELSE PENDING END,
                
                LOAN_DATE = ?
            
            WHERE
                ID = ?;
            ', 
            $loaded, 
            $loaded, 
            $loaded, 
            $loaded, 
            $loan_date, 
            $id
        );
        parent::execDML(
            'UPDATE ITEM SET COUNT = CASE WHEN 
                COUNT >= ? THEN COUNT - ? ELSE COUNT END
            WHERE
                ID = ?;',$loaded,$loaded,$id_item);
    }

    function close(Ticket $ticket){
        parent::execDML( 
            'UPDATE ticket SET
            modified_date = ?,
            complete_date = ?,
            status = ?
            WHERE id = ?
            ', 
            $ticket->modified_date, 
            $ticket->complete_date, 
            $ticket->status, 
            $ticket->id
        );
    }
}
?>