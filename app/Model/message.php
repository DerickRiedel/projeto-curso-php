<?php 

require "basicDAO.php";

class Message{
    public $id_ticket;
    public $id_tech;
    public $seq;
    public $description;
    public $modified_date;
    public $complete_date;
    public $status;
    public $id_user;
    public $id_category;

    public function __construct($id_ticket,$id_tech,$seq,$description)
    {
        $this->id_ticket = $id_ticket;
        $this->id_tech = $id_tech;
        $this->seq = $seq;
        $this->description = $description;
    }
}

class MessageDAO extends BasicDAO{
    function getJSON(){
        return parent::execJsonQUERY("SELECT * FROM message");
    }

    function getByTicketJSON($id_ticket){
        return parent::execFilteredJsonQUERY(
            "SELECT t.name techname, t.id id_tech, u.name username, u.id id_user, m.description, m.seq FROM message m
            LEFT JOIN tech t ON (m.fk_tech_id = t.id)
            LEFT JOIN ticket ti on (m.fk_ticket_id = ti.id)
            LEFT JOIN userlogin u on (ti.fk_userlogin_id = u.id)
            WHERE m.fk_ticket_id = ?
            ORDER BY seq DESC
            ",$id_ticket);
    }

    function insert(Message $message){ 
        parent::execDML( 
            'INSERT INTO message 
            (fk_tech_id, fk_ticket_id, seq, description)
            VALUES 
            (?,?,DEFAULT,?)', 
            $message->id_tech, 
            $message->id_ticket, 
            $message->description,
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