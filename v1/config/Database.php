<?php

class Database
{
	private $host = 'localhost';
	private $username = "arkreale_Guru";
	private $password = "Guru@2030";
	private $database = "arkrealestates_estore";

	private $conn;

	public function connect()
	{
		$this->conn = null;

		try {
			$this->conn = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->database, $this->username, $this->password);

			$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch (PDOException $e) {
			echo json_encode(array(
				'status' => 0,
				'error' => $e->getMessage(),
				'message' => "Error occured trying to establish connection"
			));
		}

		return $this->conn;
	}
}
