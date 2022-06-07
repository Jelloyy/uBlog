<?php
session_start();

include("head.php");
include("connection.php");
include("functions.php");


$user_data = check_login($con); //variable to get user data
$page_data = check_page_info($con, 1);  //variable to get page data (title etc.)

$find = findLatestArticle($con);    //to find latest article on blog
$find2 = findLatestPhoto($con);     //to find latest photo


?>
<body> 
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
                <a class="log-out" href="logout.php">log out</a>
            </p>

        <?php
        }?>

            <span class="hide">X</span>
        </div>
    </section>
    <div class="main-wrapper">
        
        <?php if(isset($_SESSION['user_id']) && $user_data['acces'] === '1'){?>
        
        <div class="admin_panel">
            <div class="open_panel">
                <i class="fa-solid fa-screwdriver-wrench"></i>
            </div>
            <div class="panel">
                <a href="admin_panel.php"><i class="fa-solid fa-circle-info"></i>
                <br />
                Change page info</a>
                <a href="admin_blog.php"><i class="fa-solid fa-newspaper"></i><br />
                Add new article</a>
                <a href="admin_photos.php"><i class="fa-solid fa-camera"></i><br />
                Add new photo</a>
            </div>
        </div>

        <?php
        }?>

        <div class="wrapper">
            <div class="welcome-bg">
                <!-- BACKGROUND IMAGE -->
            </div>
            <!-- HEADER MENU -->
            <header class="header-menu">
                <a class="posts-btn" href="#">posts</a>
                <a class="about-btn" href="#">about me</a>
                <a class="login">
                    <?php 
                    if(isset($_SESSION['user_id'])){
                        echo $user_data['user_name'];
                    }else{
                          echo 'login';
                    }?>
                </a>
            </header>
            <div class="welcome-pg">
                <div class="credits">
                    <h1 class="name">
                        <?php echo $page_data['name']; ?>
                    </h1>
                    <h1 class="surename">
                        <?php echo $page_data['surename']; ?>
                    </h1>
                    <h2 class="by">by uBlog</h2>
                </div>
                <div class="about">
                    <img src="css/images/man-2933984_1920.jpg" class="avatar">
                    <p>"
                        <?php echo $page_data['about']; ?>
                    "</p>
                </div>
            </div>
        </div>
        <div class="blog-pg">
            <p class="blog-pg-title">
                <span>latest</span> news</p>

            <!-- PRINT ALL ARTICLES -->
            <?php
            if($find!=NULL){
            for($i=$find['id']; $i>=1; $i--){
                $article_data = articles_data($con, $i);
                if(!$article_data){
                    continue;
                }
            ?>


            <article class="blog-article">     

            <?php if(isset($_SESSION['user_id']) && $user_data['acces'] === '1'){?>

                <a href="delete.php?article=<?php echo $article_data['id'];?>"><i class="fa-solid fa-circle-minus"></i></a>
                <a href="edit_article.php?article=<?php echo $article_data['id'];?>"><i class="fa-solid fa-pen-to-square"></i></a>
            
            <?php
            }?>     
                <img src="<?php echo $article_data['image'];?>" class="blog-image">
                <div class="responsive-wrapper">
                    <p class="blog-dnt">
                        <?php echo $article_data['date']; ?>
                    </p>
                    <p class="article-title">
                        <?php echo $article_data['title'];?>
                    </p>
                    <p class="article-description">
                        <?php echo $article_data['description'];?>
                    </p>
                    <a href="article.php?article=<?php echo $article_data['id']; ?>" class="article-read-more">read more</a>
                </div>
                <div class="stats">
                    <i class="fa-solid fa-eye"></i>
                    <?php $views = $article_data['views'];
                    echo $views; ?>
                    <i class="fa-solid fa-comment"></i>
                    <?php $comments = countComemnts($con, $article_data['id']);
                    echo $comments; ?>
                </div>
            </article>
            <?php
            }
            }?>

        </div>
        <p class="title">about me:</p>
        <div class="about-section">
            <div class="about-img">
                <!-- IMAGE HERE -->
            </div>
            <div class="about-me">
                <p>
                    <?php echo $page_data['about_section']; ?>
                </p>
            </div>
        </div>
        <div class="photos-section">
            <p class="title3">photos:</p>
            <!-- PRINT ALL PHOTOS -->
            <?php
            if($find2!=NULL){
            for($i=$find2['id']; $i>=1; $i--){
                $photos_data = photos_data($con, $i);
                if(!$photos_data){
                    continue;
                }

                if(isset($_SESSION['user_id']) && $user_data['acces'] === '1'){?>
                <a href="delete_photo.php?photo=<?php echo $photos_data['id'];?>"><i class="fa-solid fa-circle-minus photo"></i></a>
            <?php
            }?>     
            <img src="<?php echo $photos_data['photo_url']; ?>" class="photos">
            <?php 
            }
            } ?>
        </div>
        <?php include("footer.php"); ?>
        
    </div>
    <script src="scripts/jquery-3.2.1.min.js"></script>
    <script src="scripts/modal.js" type="text/javascript"></script>
    <script src="scripts/animations.js" type="text/javascript"></script>
</body>
</html>