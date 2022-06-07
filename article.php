<?php
include("connection.php");
include("functions.php");
include("head.php");

session_start();

$article_id = $_GET['article'];
$user_data = check_login($con);
if(isset($_SESSION['user_id'])){
    $nickname = $user_data['user_name'];
}
$rows = countComemnts($con, $article_id);
$latestComment = latestComment($con);
$article = readArticle($con, $article_id);
$views = $article['views'];
$views += 1;

updateViews($con, $views, $article_id);

?>
<body class="article-pg">
    <section class="modal-wrap">
        <div class="modal">

        <?php if(!isset($_SESSION['user_id'])){ ?>

            <p class="title2">Login</p>
            <p class="register-info">
                <a class="sign-in" href="login.php">Sign in here</a>
            </p>
            <p class="register-info">Dont have already account?<br />
                <a class="sign-up" href="signup.php">Sign up here</a>
            </p>

        <?php 
        }else if(isset($_SESSION['user_id'])){?>
            <p class="title2">
                <?php echo $user_data['user_name'] ?>
            </p>
            <p class="register-info">
                login: <?php echo $user_data['user_name'] ?>
            </p>
            <p class="register-info">
                email: <?php echo $user_data['email'] ?>
            </p>
            <p class="register-info">
                <a href="logout.php">log out</a>
            </p>
        <?php
        }?>

            <span class="hide">X</span>
        </div>
    </section>
    <header class="header-menu">
        <a class="posts-btn" href="index.php">home</a>
        <a class="comments-btn" href="#">comments</a>
        <a class="login">

        <?php 
        if(isset($_SESSION['user_id'])){
            echo $user_data['user_name'];
        }else{
           echo 'login';
        }?>
        
        </a>

     </header>
    <article class="news">
        <img src="<?php echo $article['image'];?>">
        <h1><?php echo $article['title']; ?></h1>
        <h2><?php echo $article['description']; ?></h2>
        <h3><?php echo $article['content']; ?></h3>
        <?php if(isset($_SESSION['user_id'])){?>
            <form class="add-comment" action="add_comment.php?id=<?php echo $article_id;?>&nickname=<?php echo $nickname; ?>" method="post">
                <label class="add-comment-label">Add comment:</label><br />
                <textarea col="10" rows="5" type="text" name="comment"></textarea><br />
                <input class="add-comment-btn" type="submit" value="Add" />
            </form>
            <?php 
        }

            if($rows!=NULL){
                for($i=$latestComment['id']; $i>0; $i--){
                    $comments = comments_data($con, $article_id, $i);
                    if(!$comments){
                        continue;
                    }else{
                    ?>
                    <div class="comments">
                        <p>
                            <?php echo $comments['date']; ?>
                        </p>
                        <h3 class="comments-nick">
                            <?php echo $comments['nickname']; ?>
                        </h3>
                        <p class="comment">
                            <?php echo $comments['content']; ?>
                        </p>
                    </div>

                <?php
                    }
                }
            }?>
    </article>
    <?php include_once("footer.php");?>
    <script src="scripts/jquery-3.2.1.min.js"></script>
    <script src="scripts/modal.js" type="text/javascript"></script>
    <script src="scripts/animations.js" type="text/javascript"></script>
</body>