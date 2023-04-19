<?php

    class Access{

    	private $conn;
    	private $nav_url;

    	public $username;  	
    	public $email;  	
	  	public $password;
	  	public $salt;

	  	public function __construct($nav_url){
	    	$this->nav_url = $nav_url;
	  	}

	  	public function checkUser(){

	  		try {

			   $codeunit = new NTLMSoapClient($this->nav_url);

			    $functionparams = array(
			    	'username' => $this->email,
			    );

			    $result = $codeunit->checkUser($functionparams);

			    return $result->return_value;
			}

			catch (Exception $e) {

				echo '<hr><b>ERROR: SoapException:</b> ['.$e.']<hr>'; 

			    echo '<pre>'.htmlentities(print_r($codeunit->__getLastRequest(),1)).'</pre>';

				return false;
			}

			stream_wrapper_restore('http');
            
	  	}

	  	public function updatePassowrd(){

	  		try {

			    $codeunit = new NTLMSoapClient($this->nav_url);

			    $functionparams = array(
			    	'userId' => $this->email,
			    	'newPassword' => $this->password,
			    	'salt' => $this->salt
			    );

			    $result = $codeunit->updateUserPassword($functionparams);

			    return $result->return_value;
			}

			catch (Exception $e) {

				echo '<hr><b>ERROR: SoapException:</b> ['.$e.']<hr>'; 

			    echo '<pre>'.htmlentities(print_r($codeunit->__getLastRequest(),1)).'</pre>';

				return false;
			}

			stream_wrapper_restore('http');
    	}

    	public function verifyUser(){    		

			$headers = getallheaders();  

		    try {

		    	$token = $headers['Authorization'];

		        $secret_key = "kimiko";

		        $token = \Firebase\JWT\JWT::decode($token,$secret_key,array('HS256'));	    

		        if(!empty($token)){

		        	$token_username = $token->data->username;

                    return $token_username;
		        }
		     	
		    } catch (Exception $e) {

		    	http_response_code(500);

		    	echo json_encode(array(
		    		'status' => 0,
		    		'message' => $e->getMessage()
		    	));
		     	
		    }   		   		
    	}

    	public function passwordEncryption(){

    		$encryption = array();

    		$Blowfish_Pre = '$2a$05$zzzsew';
		    $Blowfish_End = '$';
				   
		    $Allowed_Chars ='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789./@;#$%';
		    $Chars_Len = 63;

		    $Salt_Length = 21;
			$salt = "";

			for($i=0; $i<$Salt_Length; $i++){
				$salt .= $Allowed_Chars[mt_rand(0,$Chars_Len)];
			}
			
		    return $encryption =  array(
		    	     'bycrypt' => $Blowfish_Pre . $salt . $Blowfish_End,
		    	     'blowfish_pre' => $Blowfish_Pre,
		    	     'salt' => $salt,
		    	     'blowfish_end' => $Blowfish_End
		           );
    	}

    }