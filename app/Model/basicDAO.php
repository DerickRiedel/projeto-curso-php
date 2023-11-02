<?php

require "Connection/connection.php";

class BasicDAO{
    protected function execDML(string $sql, ...$params){
        global $dsn, $username, $pass;
        $pdo = new PDO($dsn, $username, $pass, 
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

        try{
            $stm = $pdo->prepare($sql);
            $stm->execute($params);
        }finally{
            $pdo = null;
        }
    }
    protected function execQUERY(string $sql){ 
        global $dsn, $username, $pass; 
        $pdo = new PDO($dsn, $username, $pass, 
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]); 

        $stm = $pdo->prepare($sql);
        $stm->execute();
        $obj = $stm->fetchAll(PDO::FETCH_OBJ);
        $pdo = null;
        return $obj;
    }
    protected function execJsonQUERY(string $sql){ 
        global $dsn, $username, $pass; 
        $pdo = new PDO($dsn, $username, $pass, 
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]); 

        $stm = $pdo->prepare($sql);
        $stm->execute();
        $obj = $stm->fetchAll(PDO::FETCH_ASSOC);
        $json = json_encode($obj);
        $pdo = null;
        return $json;
    }
    protected function execFilteredJsonQUERY(string $sql, ...$params){ 
        global $dsn, $username, $pass; 
        $pdo = new PDO($dsn, $username, $pass, 
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]); 

        $stm = $pdo->prepare($sql);
        $stm->execute($params);
        $obj = $stm->fetchAll(PDO::FETCH_ASSOC);
        $json = json_encode($obj);
        $pdo = null;
        return $json;
    }
    protected function execFilteredQUERY(string $sql, ...$params){
        global $dsn, $username, $pass;
        $pdo = new PDO($dsn, $username, $pass, 
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

        $stm = $pdo->prepare($sql);
        $stm->execute($params);
        $obj = $stm->fetchAll(PDO::FETCH_OBJ);
        $pdo = null;
        return $obj;
    }
}