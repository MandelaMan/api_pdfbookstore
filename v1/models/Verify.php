<?php

    class Verify{

    	private $conn;
    	private $secret;
        private $clerk;
        private $tbl_admin = 'admins';
        private $tbl_client = 'customers';

    	public function __construct($db,$key){
	        $this->conn = $db;
	        $this->secret = $key;
	    }

	  	public function verifyClerk(){    		

			// $headers = getallheaders();  

			$token = null;
            $headers = apache_request_headers();

            $token = $_SERVER["REDIRECT_HTTP_AUTHORIZATION"];

		    try {

		    	if(isset($token)){

		    		$token = \Firebase\JWT\JWT::decode($token,$this->secret,array('HS256'));

		    		$query = 'SELECT EXISTS(SELECT * FROM '.$this->tbl_admin.' WHERE clerk_id = ?)';

			        $stmt = $this->conn->prepare($query);

			        $stmt->bindParam(1, $token->clerk,PDO::PARAM_STR);

			        $result = $stmt->execute();

			        if($result){
			        	return $token->clerk;
			        }
			        else{
			        	return null;
			        }	
		    	}
		    	else{
		    		echo "Could not extract the token";
		    	}
		    				     	
		    } catch (Exception $e) {

		    	http_response_code(500);

		    	echo json_encode(array(
		    		'status' => 0,
		    		'message' => $e->getMessage()
		    	));
		    }   		   		
    	}

	  	public function verifyClient(){    		

			// $headers = getallheaders();  

			$token = null;
            $headers = apache_request_headers();

            $token = $_SERVER["REDIRECT_HTTP_AUTHORIZATION"];

		    try {

		    	if(isset($token)){

		    		$token = \Firebase\JWT\JWT::decode($token,$this->secret,array('HS256'));

		    		$query = 'SELECT EXISTS(SELECT * FROM '.$this->tbl_admin.' WHERE clerk_id = ?)';

			        $stmt = $this->conn->prepare($query);

			        $stmt->bindParam(1, $token->clerk,PDO::PARAM_STR);

			        $result = $stmt->execute();

			        if($result){
			        	return $token->clerk;
			        }
			        else{
			        	return null;
			        }	
		    	}
		    	else{
		    		echo "Could not extract the token";
		    	}
		    				     	
		    } catch (Exception $e) {

		    	http_response_code(500);

		    	echo json_encode(array(
		    		'status' => 0,
		    		'message' => $e->getMessage()
		    	));
		    } 		   		
    	}

    }