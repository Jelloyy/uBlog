<?php
include("connection.php");
include("functions.php");

session_start();

if(isset($_SESSION['user_id'])){

    $article_id = $_GET['id'];
    $nickname = $_GET['nickname'];
    $content = $_POST['comment'];
    $date = date("Y-m-d H:i:s");

    if(isset($_SESSION['user_id']) && !empty($article_id) && !empty($nickname) && !empty($content)){
        $query = "INSERT INTO comments (article_id, nickname, content, date) VALUES ('$article_id', '$nickname', '$content', '$date')";
        mysqli_query($con, $query);
        header("Location: article.php?article=".$article_id);
        die;
    }else{
        echo 'Cannot do this action';
    }
}else{
    header("Location: index.php");
}