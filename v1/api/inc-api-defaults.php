<?php
    ini_set("display_errors",1);

    header('Content-Type: application/json; charset=utf-8');
    date_default_timezone_set('Africa/Nairobi');

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    require '../../vendor/autoload.php';
    include_once("../../config/Database.php");

    $mail = new PHPMailer(TRUE);
    
    include_once("../../models/Book.php");
    include_once("../../models/Category.php");
    include_once("../../models/Client.php");
    include_once("../../models/Admin.php");
    include_once("../../models/Verify.php");

    if($_SERVER['REQUEST_METHOD'] === "POST" || "GET" || "PUT" || "\DELETE" || "OPTIONS"){

        include_once("helper/functions.php");

        $database =  new Database();
        $db = $database->connect();

        $message = "";

        $secret_key = "kwatoski";
        $image_link = "http://localhost:81/pdfbookstore/library/";

        //Payload Data
        $iss = "pdfbookstore";
        $iat = time();
        $nbf = $iat + 0;
        $exp = $iat + 15780000;
        $aud = "admin_user";  

        $payload_info = array(
            "iss"=>$iss,
            "iat"=>$iat,
            "nbf"=>$nbf,
            "exp"=>$exp,
            "aud"=>$aud,
        );

        $security = encrypt();

        //Class instantiation       
        $book = new Book($db);      
        $category = new Category($db);      
        $admin = new Admin($db);      
        $client = new Client($db,$security);   
        $verify = new Verify($db,$secret_key);   
    }
    else{

    	http_response_code(503);

    	echo json_encode(array(
    		"status" => 0,
    		"message" => "Access Denied"
    	));
    }




       
    