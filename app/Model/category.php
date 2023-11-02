<?php 

require "basicDAO.php";

class Category{
    public $id;
    public $name;
    public $description;
    public $has_item;

    public function __construct($id,$name,$description,$has_item)
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->has_item = $has_item;
    }
}

class CategoryDAO extends BasicDAO{
    function getJSON(){
        return parent::execJsonQUERY("SELECT * FROM category");
    }

    function getByIdJSON($id){
        return parent::execFilteredJsonQUERY("SELECT * FROM category WHERE id = ?",$id);
    }

    function getAll(){
        return parent::execQUERY("SELECT * FROM category");
    }

    function insert(Category $category){ 
        parent::execDML( 
            'INSERT INTO category (id, name, description,has_item) 
            VALUES 
            (DEFAULT,?,?,?)', 
            $category->name, 
            $category->description,
            $category->has_item
        );
    }

    function update(Category $category){
        parent::execDML( 
            'UPDATE category SET
            name = ?,
            description = ?,
            has_item = ?
            WHERE id = ?
            ', 
            $category->name, 
            $category->description, 
            $category->has_item,
            $category->id,
        );
    }
}
?>