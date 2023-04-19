<?php

    if($_SERVER['REQUEST_METHOD'] === "GET"){

    	include_once("../inc-api-defaults.php");

    	if(!is_null($verify->verifyClient())){

    		$data = json_decode(file_get_contents("php://input"));

            $book->id = $data->id;

            $result = $book->downloadBook();

    		echo json_encode(array(
		    	'status' => 1,
		    	'data' => "Title was updated successfully"
			)); 
    	}    	
    }