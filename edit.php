<?php

include("connection.php");
include("functions.php");

session_start();

$user_data = check_login($con);

if(isset($_SESSION['user_id']) && $user_data['acces'] === '1'){


    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $image = $_POST['article_image'];
        $title = $_POST['article_title'];
        $description = $_POST['article_description'];
        $content = $_POST['article_content'];
        $id = $_GET['id'];
    }
    if(!empty($title) && !empty($description) && !empty($content) && !empty($image)){
        $query = "UPDATE articles SET image='$image', title='$title', description='$description', content='$content' WHERE id='$id'";
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