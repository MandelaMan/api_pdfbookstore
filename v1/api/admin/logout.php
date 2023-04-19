<?php

    if($_SERVER['REQUEST_METHOD'] === "GET"){

    	include_once("../inc-api-defaults.php");
        
        if(isset($_GET['logout'])){
            session_destroy();
        }    	
    }