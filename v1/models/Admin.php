<?php

  class Admin {

    private $conn;
    private $table = 'admins';

    public $clerk_id;
    public $passcode;

    public function __construct($db){
        $this->conn = $db;
    } 

    public function login(){

        $query = 'SELECT * FROM '.$this->table.' WHERE clerk_id = ? && passcode = ?';

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(1, $this->clerk_id,PDO::PARAM_STR);
        $stmt->bindParam(2, $this->passcode,PDO::PARAM_STR);

        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return $row;
    }

    // public function register{}
  }