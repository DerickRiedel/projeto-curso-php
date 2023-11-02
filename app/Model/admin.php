<?php 

require "basicDAO.php";

class Admin{
    public $id;
    public $name;
    public $password;
    public $create_date;
    public $email;

    public function __construct($id,$name,$password,$create_date,$email)
    {
        $this->id = $id;
        $this->name = $name;
        $this->password = $password;
        $this->create_date = $create_date;
        $this->email = $email;
    }
}

class AdminDAO extends BasicDAO{
    function getAll(){
        return parent::execQUERY("SELECT * FROM tech");
    }

    function login($email, $password){
        return parent::execFilteredQUERY("SELECT * FROM tech WHERE email = ? and password = ?",
        $email,$password);
    }

    function insert(Admin $user){ 
        parent::execDML( 
            'INSERT INTO tech 
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