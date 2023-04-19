<?php

  if($_SERVER['REQUEST_METHOD'] === "GET"){

    include_once("../inc-api-defaults.php");

    	if(isset($_GET['id'])){

    		$book->category = $_GET['id'];

    		$result = $book->getBooksByCategory();

        $count = $result->rowCount();

        $books = array();

        if($count>0){

          while($row = $result->fetch(PDO::FETCH_ASSOC)){

            extract($row);

            $single_book = array(
              'id' => (int)$id,
              'title' => $title,
              'subtitle' => $subtitle,
              'code' => strtolower($code),
              'author' => $author,
              'category' => $category_name,
              'approval_status' => (int)$approval_status,
              'formart' => $book_formart,
              'size' => $size,
              'year' => $year,
              'description' => $description,
              'img_link' => $img_link,
              'views_by_click' => $views_by_click,
              'is_free' => $is_free,
              'downloads' => (int)$downloads,
              'created_at' => $created_at,
              'updated_at' => $updated_at,
              'added_by' => (int)$added_by
            );

            array_push($books,$single_book);
          }
        }

        echo json_encode($books);  		      
	  	}   	
  }