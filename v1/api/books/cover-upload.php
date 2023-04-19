<?php 


    if($_SERVER['REQUEST_METHOD'] === "POST"){

        include_once("../inc-api-defaults.php");

        include_once("../helper/functions.php");

        $response = array();
        $upload_dir = '../../../library/';
        $server_url = 'http://localhost:81';

        if($_FILES['avatar'])
        {
            $avatar_name = $_FILES["avatar"]["name"];
            $avatar_tmp_name = $_FILES["avatar"]["tmp_name"];
            $error = $_FILES["avatar"]["error"];

            if($error > 0){
                $response = array(
                    "status" => "error",
                    "error" => true,
                    "message" => "Error uploading the file!"
                );
            }else 
            {
                $pieces = explode(".", $avatar_name);

                $random_name = uniqueCode(5).".".$pieces[1];
                $upload_name = $upload_dir.strtolower($random_name);
                $upload_name = preg_replace('/\s+/', '-', $upload_name);

                if(move_uploaded_file($avatar_tmp_name , $upload_name)) {
                    $response = array(
                        "status" => "success",
                        "error" => false,
                        "code" => $random_name,
                        "message" => "File uploaded successfully",
                        "url" => $server_url."/".$upload_name
                      );
                }else
                {
                    $response = array(
                        "status" => "error",
                        "error" => true,
                        "message" => "Error uploading the file!"
                    );
                }
            }    

        }else{
            $response = array(
                "status" => "error",
                "error" => true,
                "message" => "No file was sent!"
            );
        }

        echo json_encode($response);
    }
    
