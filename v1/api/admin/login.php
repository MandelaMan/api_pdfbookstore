<?php

    if($_SERVER['REQUEST_METHOD'] === "POST"){

    	include_once("../inc-api-defaults.php");

    	$data = json_decode(file_get_contents("php://input"));

    	if(!empty($data->clerk_id) && !empty($data->passcode)){

    		$admin->clerk_id = strtoupper($data->clerk_id);
    		$admin->passcode = $data->passcode;

    		$result = $admin->login();

    		if(!$result){
                echo json_encode(array(
                    'error'=> true
                ));
    		}
    		else{
    			extract($result); 

                $payload_info["clerk"] = $id;
                $payload_info["is_super_admin"] = $is_super_admin;
                $payload_info["name"] = $first_name;

                $jwt = \Firebase\JWT\JWT::encode($payload_info, $secret_key);

                $data = array( 
                    'error'=> false,                              
                    'token' => $jwt,
                );

                echo json_encode($data,JSON_UNESCAPED_UNICODE); 
    		}
    	}
    }