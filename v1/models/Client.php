<?php

  class Client {

  	private $conn;
  	private $table = 'customers';


    public $f_name;
    public $l_name;
    public $nickname;
    public $yob;
  	public $email;
  	public $password;
    public $account_status;

    private $salt;
    private $hash_password;
    private $encryption;

  	public function __construct($db,$security){
  	    $this->conn = $db;
        $this->encryption = $security;
  	} 

    public function register(){

        try{

            $query = 'INSERT INTO '.$this->table.'
                      SET 
                      f_name=:f_name,
                      l_name=:l_name,
                      nickname=:nickname,
                      yob=:yob,
                      email=:email,
                      salt=:salt,
                      passcode=:passcode';

            $stmt = $this->conn->prepare($query);

            $this->f_name = htmlspecialchars(strip_tags("N/A"));
            $this->l_name = htmlspecialchars(strip_tags("N/A"));
            $this->nickname = htmlspecialchars(strip_tags($this->alias));
            $this->yob = htmlspecialchars(strip_tags(0));
            $this->email = htmlspecialchars(strip_tags($this->email));
            $this->salt = htmlspecialchars(strip_tags($this->encryption['salt']));
            $this->hash_password = crypt($this->password, $this->encryption['bcrypt_salt']);

            $stmt->bindParam(':f_name',$this->f_name);
            $stmt->bindParam(':l_name',$this->l_name);
            $stmt->bindParam(':nickname',$this->nickname);
            $stmt->bindParam(':yob',$this->yob);
            $stmt->bindParam(':email',$this->email);      
            $stmt->bindParam(':salt',$this->salt);
            $stmt->bindParam(':passcode',$this->hash_password);

            $stmt->execute();

            return $this->conn->lastInsertId();

        } catch (Exception $e) {

          http_response_code(500);

          return $e->getMessage();
        }       
    }

  	public function login(){

      $query = 'SELECT * FROM '.$this->table.' WHERE email = ?';

      $stmt = $this->conn->prepare($query);

      $stmt->bindParam(1, $this->email,PDO::PARAM_STR);

      $stmt->execute();

      $row = $stmt->fetch(PDO::FETCH_ASSOC);

      extract($row);
 
      $hash_password = crypt($this->password, $this->encryption['Blowfish_Pre'] . $salt . $this->encryption['Blowfish_End']);

      if($hash_password === $passcode){
        return $row;
      }
    }

    public function updatePayment(){

      $query = 'UPDATE '.$this->table.'
              SET
            `account_status` = `account_status` + 1
            WHERE email =:email';

      $stmt = $this->conn->prepare($query);

      $this->email = htmlspecialchars(strip_tags($this->email));

      $stmt->bindParam(':email',$this->email);

      $stmt->execute();

      $query = 'SELECT * FROM '.$this->table.' WHERE email = ?';

      $stmt = $this->conn->prepare($query);

      $stmt->bindParam(1, $this->email,PDO::PARAM_STR);

      $stmt->execute();

      $row = $stmt->fetch(PDO::FETCH_ASSOC);

      extract($row);

      return $row;

    }
}