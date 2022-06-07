<?php
include("head.php");
include("connection.php");
include("functions.php");
session_start();

$user_data = check_login($con);
$page_data = check_page_info($con, 1);
?>
<body>
<?php
if(isset($_SESSION['user_id']) && $user_data['acces'] === '1'){
    ?>
        <div class="register-pg-body">
            <section class="register">
            <a href="index.php"><i class="fa-solid fa-circle-arrow-left"></i></a>
                <form class="register-form" action="change.php" method="POST">
                    <label>Your name:</label>
                    <input type="text" placeholder="enter name here" name="name" value="<?php echo $page_data['name']?>"/>
                    <label>Your surename:</label>
                    <input type="text" placeholder="enter your surename here" name="surename" value="<?php echo $page_data['surename']?>"/>
                    <label>motto</label>
                    <input type="text" placeholder="motto" name="about" value="<?php echo $page_data['about']?>"/>

                    <label>About me section:</label>
                    <textarea name="about_section" placeholder="about you">
                        <?php echo $page_data['about_section']; ?>
                    </textarea>

                    <input type="submit" value="Save" /> 
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