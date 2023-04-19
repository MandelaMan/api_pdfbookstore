<?php

    if($_SERVER['REQUEST_METHOD'] === "GET"){

    	include_once("../inc-api-defaults.php");

    	$result = $category->getCategories();

  		$count = $result->rowCount();

  		if($count>0){
  			$categories = array();

  			while($row = $result->fetch(PDO::FETCH_ASSOC)){

  				extract($row);

  				$single_category = array(
  					'id' => $id,
  					'name' => $name,
  				);

  				array_push($categories,$single_category);
  			}
  		}

  		echo json_encode($categories);    	
    }