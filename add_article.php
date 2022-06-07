<?php

session_start();

include("connection.php");
include("functions.php");

$user_data = check_login($con);

if(isset($_SESSION['user_id']) && $user_data['acces'] === '1'){
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $image = $_POST['article_image'];
        $title = $_POST['article_title'];
        $description = $_POST['article_description'];
        $date_n_time = date("Y-m-d H-i-s");
        $content = $_POST['article_content'];
    }
    if(!empty($title) && !empty($description)){
        $query = "INSERT INTO articles (date, image, title, description, content) VALUES ('$date_n_time', '$image', '$title', '$description', '$content')";
        mysqli_query($con, $query);
        header("Location: index.php");
        die;
    }else{
        echo "Please fill all fields";
    }
}else{
    header("Location: index.php");
}

?>