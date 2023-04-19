<?php

    if($_SERVER['REQUEST_METHOD'] === "DELETE"){

    	include_once("../inc-api-defaults.php");

    	if(!is_null($verify->verifyClerk())){

    		$data = json_decode(file_get_contents("php://input"));

            $book->id = $data->id;

            $result = $book->deleteBook();

    		echo json_encode(array(
		    	'status' => 1,
		    	'data' => "Title was deleted successfully"
			)); 
    	}    	
    }