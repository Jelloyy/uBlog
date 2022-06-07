<?php

session_start();

include("connection.php");
include("functions.php");

$user_data = check_login($con);

if(isset($_SESSION['user_id']) && $user_data['acces'] === '1'){


    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $name = $_POST['name'];
        $surename = $_POST['surename'];
        $about = $_POST['about'];
        $aboutme = $_POST['about_section'];
    }

    if(!empty($name) && !empty($surename) && !empty($about) && !empty($aboutme)){
        $query1 = "UPDATE page SET name = '$name', surename='$surename', about='$about' WHERE id=1";
        $query2 = "UPDATE page SET about_section = '$aboutme' WHERE id=2";

        mysqli_query($con, $query1);
        mysqli_query($con, $query2);
        header("Location: index.php");
        die;
    }else{
        echo "Please fill all fields";
    }
}else{
    header("Location: index.php");
}
?>