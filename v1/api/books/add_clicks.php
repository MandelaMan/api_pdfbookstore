<?php

    if($_SERVER['REQUEST_METHOD'] === "GET"){

    	include_once("../inc-api-defaults.php");

    	if(isset($_GET['book'])){

    		$book->id = $_GET['book'];

    		$result = $book->addClicks();

    		if($result){
    			echo json_encode($result);
    		}
	  	}   	
    }