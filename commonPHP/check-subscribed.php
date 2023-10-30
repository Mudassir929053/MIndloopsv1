<?php

        if(!session_id())
    {
        session_start();
    }

    if(isset($_SESSION['userType'])){
        if($_SESSION['subscribed'] == False){
            $data = array(
                "isSubscribed" => false
            );
            echo json_encode($data);
        }
        else{
            $data = array(
                "isSubscribed" => true
            );
            echo json_encode($data);
        }
    }
    else{
        $data = array(
            "isSubscribed" => false
        );
        echo json_encode($data);
    }


?>