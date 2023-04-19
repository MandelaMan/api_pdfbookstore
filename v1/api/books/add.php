<?php

    if($_SERVER['REQUEST_METHOD'] === "POST"){

    	include_once("../inc-api-defaults.php");

      include_once("../helper/functions.php");

    	if(!is_null($verify->verifyClerk())){

  		    $data = json_decode(file_get_contents("php://input"));

            $book->code = strtolower($data->img_link);
            $book->title = trim($data->title);
            $book->subtitle = trim($data->subtitle);
            $book->author =  trim($data->author);
            $book->pages = trim($data->pages);
            $book->size = 359;
            $book->book_formart = $data->format;
            $book->year = trim($data->year);
            $book->description = trim($data->description);
            $book->img_link = $data->img_link;
            $book->category = $data->category;
            $book->is_free = 0;
            $book->views_by_click = 0;
            $book->downloads = 0;
            $book->added_by = $verify->verifyClerk();

            $result = $book->addBook();

    		echo json_encode(array(
  		    	'status' => true,
                'code' =>  $book->code,
  		    	'data' => (int)$result
  			)); 
    	}    	
    }