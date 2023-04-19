<?php
   
    if($_SERVER['REQUEST_METHOD'] === "POST"){

    	include_once("../inc-api-defaults.php");

    	$data = json_decode(file_get_contents("php://input"));

    	echo "Umefika kwa kuregister";
    }