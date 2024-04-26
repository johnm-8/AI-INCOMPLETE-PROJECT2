<?php

include("connections.php");

function check_login($con){

    if(isset($_SESSION['user_id'])){
        $id = $_SESSION['user_id'];
        $query = "SELECT * FROM students WHERE user_id = '$id' limit 1";

        // // Debugging: Print MySQLi connection object
        // var_dump($con);

        // // Debugging: Print query
        // echo "Query: $query";

        $result = mysqli_query($con, $query);

        if(!$result){
            echo "Error: " . mysqli_error($con);
            die;
        }

        if($result && mysqli_num_rows($result) > 0){
            $user_data = mysqli_fetch_assoc($result);
            return $user_data;
        }
    }
    //redirect to login
    header("Location: login.php");
    die;
}

function random_num($length){
    $text = "";
    if($length < 5){
        $length = 5;
    }

    $len = rand(4, $length);

    for($i = 0; $i < $len; $i++){
        $text .= rand(0, 9);
    }
    return $text;
}
?>