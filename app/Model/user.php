<?php 

require "basicDAO.php";

class User{
    public $id;
    public $name;
    public $password;
    public $create_date;
    public $email;
    public $sector;

    public function __construct($id,$name,$password,$create_date,$email,$sector)
    {
        $this->id = $id;
        $this->name = $name;
        $this->password = $password;
        $this->create_date = $create_date;
        $this->email = $email;
        $this->sector = $sector;
    }
}

class UserDAO extends BasicDAO{
    function getAll(){
        return parent::execQUERY("SELECT * FROM userlogin");
    }

    function getByIdJSON($id){
        return parent::execFilteredJsonQUERY("SELECT * FROM userlogin WHERE id = ?",$id);
    }

    function login($email, $password){
        return parent::execFilteredQUERY("SELECT * FROM userlogin WHERE email = ? and password = ?",
        $email,$password);
    }

    function insert(User $user){ 
        parent::execDML( 
            'INSERT INTO userlogin 
            (id, name, password, create_date, email) 
            VALUES 
            (?,?,?,?,?)', 
            $user->id, 
            $user->name, 
            $user->password, 
            $user->create_date, 
            $user->email 
        );
    }
}
?>