<?php    
    
    function uniqueCode($length){

    	$random_string = '';
    	
	    for($i = 0; $i < $length; $i++) {
	        $number = random_int(0, 36);
	        $character = base_convert($number, 10, 36);
	        $random_string .= $character;
	    }
	 
	    return $random_string;
    }

    function encrypt(){

    	$security = array();
    	$security['Blowfish_Pre'] = array();
    	$security['salt'] = array();
    	$security['Blowfish_End'] = array();
    	$security['bcrypt_salt'] = array();

    	$password = "";
	    $length = 8;
		$characters = array_merge(range('A','Z'), range('a','z'), range('0','9'));
		$max = count($characters) - 1;

		for ($i = 0; $i < $length; $i++) {
			$rand = mt_rand(0, $max);
			$password .= $characters[$rand];
		}

	    $Blowfish_Pre = '$2a$05$zzzsew';
	    $Blowfish_End = '$';
			   
	    $Allowed_Chars ='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789./@;#$%';
	    $Chars_Len = 63;

	    $Salt_Length = 21;
		$salt = "";

		for($i=0; $i<$Salt_Length; $i++){
			$salt .= $Allowed_Chars[mt_rand(0,$Chars_Len)];
		}
			
	    $bcrypt_salt = $Blowfish_Pre . $salt . $Blowfish_End;

	    $security['Blowfish_Pre'] = $Blowfish_Pre;
    	$security['salt'] = $salt;
    	$security['Blowfish_End'] = $Blowfish_End;
    	$security['bcrypt_salt'] = $bcrypt_salt;

	    return $security;
    }
   
    function webService($email){
		
		$company = explode("@",$email);
        $url = "";
		

		if($email === "jnmalelu@executive-healthcare.com" || $email ==="kkdhanjal@executive-healthcare.com" || $company[1] === "micglobalrisks.com"){
			$url = 'http://192.168.1.35:18002/MICGLOBAL/WS/MIC%20Global%20Risks/Codeunit/hrdatahandler';
		}
		else{
			$url = 'http://192.168.1.39:12077/Executive_Healthcare_Solutions/WS/Executive%20Healthcare%20Solutions/Codeunit/hrdatahandler';	
		}    

		//echo $url;

        return $url;
    }