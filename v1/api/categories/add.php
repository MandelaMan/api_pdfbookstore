<?php

    if($_SERVER['REQUEST_METHOD'] === "POST"){

    	include_once("../inc-api-defaults.php");

    	if(!is_null($verify->verifyClerk())){

    		$data = json_decode(file_get_contents("php://input"));

    		$categories = explode(',', preg_replace('/\s*,\s*/', ',', $data->categories));

    		foreach ($categories as $item) {

    			$category->name = $item;

    			$category->addCategory();
			};

    		echo json_encode(array(
		    	'status' => 1,
		    	'data' => "Insert successful"
			)); 
    	}    	
    }