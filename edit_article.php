<?php
include("head.php");
include("connection.php");
include("functions.php");

session_start();

$user_data = check_login($con);
$articleId = $_GET['article'];
$article_data = check_article_info($con, $articleId);
?>
<body>
<?php
if(isset($_SESSION['user_id']) && $user_data['acces'] === '1'){
    ?>
        <div class="register-pg-body">
            <section class="register">
            <a href="index.php"><i class="fa-solid fa-circle-arrow-left"></i></a>
                <form class="register-form" action="edit.php?id=<?php echo $articleId;?>" method="POST">
                    <label>Article image source:</label>
                    <input type="text" placeholder="image directory" name="article_image" value="<?php echo $article_data['image']; ?>"/>
                    <label>Article title:</label>
                    <input type="text" placeholder="insert title here" name="article_title" value="<?php echo $article_data['title']; ?>"/>
                    <label>Article description:</label>
                    <textarea name="article_description" type="text" >
                    <?php echo $article_data['description']; ?>
                    </textarea>
                    <label>Article content:</label>
                    <textarea cols="50" rows="10" type="text" placeholder="insert content of article" name="article_content">
                    <?php echo $article_data['content']; ?>
                    </textarea>

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