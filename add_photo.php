<?php

session_start();

include("connection.php");
include("functions.php");

$user_data = check_login($con);

if(isset($_SESSION['user_id']) && $user_data['acces'] === '1'){

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $image = $_POST['photo_url'];
    }
    if(!empty($image)){
        $query = "INSERT INTO photos (photo_url) VALUES ('$image')";
        mysqli_query($con, $query);
        header("Location: index.php");
        die;
    }else{
        echo "Please fill all fields";
    }

}else{
    header("Location: index.php");
}