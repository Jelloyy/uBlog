<?php
session_start();

require("head.php");
include("connection.php");
include("functions.php");


	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		//something was posted
		$user_name = $_POST['user_name'];
		$password = $_POST['password'];
        $passwordConfirm = $_POST['password_confirm'];
		$email = $_POST['email'];

		if(!empty($user_name) && !empty($password) && !empty($passwordConfirm) && !is_numeric($user_name))
		{   
            if($password!==$passwordConfirm){?>
                <div class="error">
                    <p>Passwords doesn't match...</p>
                </div>
            <?php
            }else{
                if(findUser($con, $user_name, $email)>'0'){?>
                    <div class="error">
                        <p>Username or e-mail already taken...</p>
                    </div>
                <?php
                }else{
                    //save to database
                    $user_id = random_num(20);
                    $query = "insert into users (user_id,user_name,email,password,acces) values ('$user_id','$user_name','$email','$password',0)";

                    mysqli_query($con, $query);

                    header("Location: login.php");
                    die;
                }
            }
        }else
		{?>
			<div class="error">
                    <p>Please fill all the required fields...</p>
            </div>
        <?php
		}
	}
?>


<body>
    <div class="register-pg-body">
        <section class="register">
            <a href="index.php"><i class="fa-solid fa-circle-arrow-left"></i></a><p class="title">Sign up</p>
            <form class="register-form" action="signup.php" method="POST">
                <label for="uname">username</label>
                <input type="text" placeholder="enter username" name="user_name" required>

                <label for="uname">e-mail</label>
                <input type="text" placeholder="enter e-mail" name="email" required>

                <label for="pass">password</label>
                <input type="password" placeholder="enter password" name="password" required>

                <label for="pass">confirm password</label>
                <input type="password" placeholder="confirm password" name="password_confirm" required>

                <input class="register-btn" type="submit" value="Sign up">
            </form>
        </section>
    </div>
    <?php
    include_once("footer.php");
    ?>

</body>
</html>