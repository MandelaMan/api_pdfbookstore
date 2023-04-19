<?php

    if($_SERVER['REQUEST_METHOD'] === "PUT"){

    	include_once("../inc-api-defaults.php");

    	if(!is_null($verify->verifyClerk())){

    		$data = json_decode(file_get_contents("php://input"));

    		// how to handle the file upload is pending

            $book->id = $data->id;
            
            $book->title = $data->title;
            $book->author =  $data->author;
            $book->size = $data->size;
            $book->year = $data->year;
            $book->description = $data->description;
            $book->img_link = $data->img_link;
            $book->category = $data->category;
            $book->is_free = $data->is_free;
            $book->views_by_click = 0;
            $book->downloads = 0;
            $book->added_by = $verify->verifyClerk();;
            $book->updated_at = date('Y-m-d H:i:s');

            $result = $book->updateBook();

    		echo json_encode(array(
		    	'status' => 1,
		    	'data' => "Title was updated successfully"
			)); 
    	}    	
    }