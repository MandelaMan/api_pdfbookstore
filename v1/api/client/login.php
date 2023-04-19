<?php

    if($_SERVER['REQUEST_METHOD'] === "POST"){

    	include_once("../inc-api-defaults.php");

    	$data = json_decode(file_get_contents("php://input"));

    	if(!empty($data->email) && !empty($data->password)){

    		$client->email = $data->email;
    		$client->password = $data->password;

    		$result = $client->login();

            extract($result);    

            $payload_info["account_status"] = (int)$account_status;
            $payload_info["access_times"] = $account_access_times;
            $payload_info["email"] = $email;
            $payload_info["nickname"] = $nickname;

            $jwt = \Firebase\JWT\JWT::encode($payload_info, $secret_key);

            $data = array( 
                'error'=> false,                              
                'token' => $jwt,
            );

            echo json_encode($data,JSON_UNESCAPED_UNICODE); 
    	}
    }