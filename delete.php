<?php
include("connection.php");
include("functions.php");

session_start();

$user_data = check_login($con);

if(isset($_SESSION['user_id']) && $user_data['acces'] === '1'){

    $article_id = $_GET['article'];

    $query = "DELETE FROM articles WHERE id = '$article_id'";
    $result = mysqli_query($con, $query);
    header("Location: index.php");
    die;
}else{
    header("Location: index.php");
}
?>
