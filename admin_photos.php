<?php
include("head.php");
include("connection.php");
include("functions.php");
session_start();

$user_data = check_login($con);
?>
<body>
<?php
if(isset($_SESSION['user_id']) && $user_data['acces'] === '1'){
    ?>
        <div class="register-pg-body">
            <section class="register">
            <a href="index.php"><i class="fa-solid fa-circle-arrow-left"></i></a>
            <form class="register-form" action="add_photo.php" method="POST">
                <label>Photo directory (local or url)</label><br />
                <input type="text" name="photo_url" placeholder="directory" /><br />

                <input type="submit" value="Add" />
            </form>
            </section>
        </div>
<?php    
}else{
    echo 'you dont have acces to be here';
    header("Location: index.php");
}
include_once("footer.php");?>
</body>