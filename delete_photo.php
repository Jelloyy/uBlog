<?php
include("connection.php");
include("functions.php");

session_start();

$user_data = check_login($con);

if(isset($_SESSION['user_id']) && $user_data['acces'] === '1'){

    $photo_id = $_GET['photo'];

    $query = "DELETE FROM photos WHERE id = '$photo_id'";
    $result = mysqli_query($con, $query);
    header("Location: index.php");
    die;
    }else{
    header("Location: index.php");
}
?>
