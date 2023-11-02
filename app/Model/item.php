<?php 

require "basicDAO.php";

class Item{
    public $id;
    public $name;
    public $description;
    public $value;
    public $create_date;
    public $count;

    public function __construct($id,$name,$description,$value,$create_date,$count)
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->value = $value;
        $this->create_date = $create_date;
        $this->count = $count;
    }
}

class ItemDAO extends BasicDAO{
    function getJSON(){
        return parent::execJsonQUERY("SELECT * FROM item");
    }

    function getByIdJSON($id){
        return parent::execFilteredJsonQUERY("SELECT * FROM item WHERE id = ?",$id);
    }

    function getByTicketJSON($id){
        return parent::execFilteredJsonQUERY(
        "SELECT 
            ti.fk_ticket_id, fk_item_id, ti.id seq,
            i.name, i.description, 
            ti.count request_count , ti.loaded loaded_count, i.count
            FROM ticket_item ti
        join item i on (ti.fk_item_id = i.id) WHERE ti.fk_ticket_id = ?
        ORDER BY ti.id DESC",$id);
    }

    function getAll(){
        return parent::execQUERY("SELECT * FROM item");
    }

    function insert(Item $item){ 
        parent::execDML( 
            'INSERT INTO item (id, name, description, value, create_date, count) 
            VALUES 
            (?,?,?,?,?,?)', 
            $item->id, 
            $item->name, 
            $item->description, 
            $item->value, 
            $item->create_date, 
            $item->count, 
        );
    }

    function update(Item $item){
        parent::execDML( 
            'UPDATE item SET
            name = ?,
            description = ?,
            value = ?,
            count = ?
            WHERE id = ?
            ', 
            $item->name, 
            $item->description, 
            $item->value, 
            $item->count, 
            $item->id
        );
    }
}
?>