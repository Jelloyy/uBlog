<?php
session_start();

include("head.php");
include("connection.php");
include("functions.php");

if($_SERVER['REQUEST_METHOD'] == "POST")
{
    //something was posted
    $user_name = $_POST['user_name'];
    $password = $_POST['password'];

    if(!empty($user_name) && !empty($password) && !is_numeric($user_name))
    {

        //read from database
        $query = "select * from users where user_name = '$user_name' limit 1";
        $result = mysqli_query($con, $query);

        if($result)
        {
            if($result && mysqli_num_rows($result) > 0)
            {

                $user_data = mysqli_fetch_assoc($result);
                
                if($user_data['password'] === $password)
                {

                    $_SESSION['user_id'] = $user_data['user_id'];
                    header("Location: index.php");
                    die;
                }
            }
        }
        
        echo "wrong username or password!";
    }else
    {
        echo "wrong username or password!";
    }
}

?>



<body>
    <div class="register-pg-body">
        <section class="register">
            <a href="index.php"><i class="fa-solid fa-circle-arrow-left"></i></a><p class="title">Sign in</p>
            <form class="register-form" action="login.php" method="POST">
                <label for="uname">username</label>
                <input type="text" placeholder="enter username" name="user_name" required>

                <label for="pass">password</label>
                <input type="password" placeholder="enter password" name="password" required>

                <input class="register-btn" type="submit" value="Sign in">
            </form>
        </section>
    </div>
    <?php include("footer.php"); ?>
</body>
</html>