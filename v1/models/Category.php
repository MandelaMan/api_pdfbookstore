<?php

    class Category {

	  	private $conn;
	  	private $table_categories = 'categories';

	  	public $id;
	  	public $name;

	  	public function __construct($db){
		    $this->conn = $db;
		} 

		public function getCategories(){

			$query = 'SELECT * FROM categories';

			$stmt = $this->conn->prepare($query);

			$stmt->execute();

			return $stmt;
		} 

		public function addCategory(){

			$query = 'INSERT INTO '.$this->table_categories.'
	  		        SET 
					name=:name';

			$stmt = $this->conn->prepare($query);

	  		$this->name = htmlspecialchars(strip_tags($this->name));

			$stmt->bindParam(':name',$this->name);

			$stmt->execute();

			return $this->conn->lastInsertId();
		}
    }