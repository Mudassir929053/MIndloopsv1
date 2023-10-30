<?php

    if(!session_id())
    {
        session_start();
    }

    if(isset($_SESSION["userType"])){

        if($_SESSION["userType"] === "1"){
            $data = array(
                        "userType" => "Admin"
                    );
        }
        else if($_SESSION["userType"] === "2"){
            $data = array(
                "userType" => "Teacher"
            );
        }
        else if($_SESSION["userType"] === "3"){
            $data = array(
                "userType" => "Student"
            );
        }
        else if($_SESSION["userType"] === "4"){
            $data = array(
                "userType" => "Parent"
            );
        }
        else{
            $data = array(
                "userType" => "None"
            );
        }
        
    }
    else{
        $data = array(
            "userType" => "None"
        );
    }

    echo json_encode($data);

?>