<?php

    if($_SERVER['REQUEST_METHOD'] === "GET"){

    	include_once("../inc-api-defaults.php");

    	if(isset($_GET['code'])){

    		$book->code = $_GET['code'];

    		$result = $book->getBook();

    		extract($result);

    		$single_book = array(
		        'id' => (int)$id,
				'title' => $title,
                'subtitle' => $subtitle,
                'code' => strtolower($code),
				'author' => $author,
				'category' => $category,
				'category_id' => (int)$category,
				'category_name' => $category_name,
                'approval_status' => (int)$approval_status,
                'formart' => $book_formart,
                'pages' => $pages,
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
           
	  		print_r(json_encode($single_book));     
	  	}   	
    }