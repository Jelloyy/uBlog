<?php
include("connection.php");
function check_login($con)
{

	if(isset($_SESSION['user_id']))
	{

		$id = $_SESSION['user_id'];
		$query = "select * from users where user_id = '$id' limit 1";

		$result = mysqli_query($con,$query);
		if($result && mysqli_num_rows($result) > 0)
		{

			$user_data = mysqli_fetch_assoc($result);
			return $user_data;
			header("Location: index.php");
			die;
		}
	}

}

function findUser($con, $nickname, $email){
	$query = "SELECT * FROM users WHERE user_name = '$nickname' AND email = '$email'";
	$result = mysqli_query($con, $query);
	return mysqli_num_rows($result);
}

function check_page_info($con, $id){
	$query = "select * from page where id = '$id'";

	$result = mysqli_query($con, $query);

	$page_data = mysqli_fetch_assoc($result);
	return $page_data;
}
function check_article_info($con, $id){
	$query = "select * from articles where id = '$id'";

	$result = mysqli_query($con, $query);

	$page_data = mysqli_fetch_assoc($result);
	return $page_data;
}

function random_num($length)
{

	$text = "";
	if($length < 5)
	{
		$length = 5;
	}

	$len = rand(4,$length);

	for ($i=0; $i < $len; $i++) { 

		$text .= rand(0,9);
	}

	return $text;
}


function articles_data($con, $id){
	$query = "SELECT * FROM articles WHERE id = '$id'";
	$result = mysqli_query($con, $query);
	$article_data = mysqli_fetch_assoc($result);

	return $article_data;
}

function photos_data($con, $id){
	$query = "SELECT * FROM photos WHERE id = '$id'";
	$result = mysqli_query($con, $query);
	$photos_data = mysqli_fetch_assoc($result);

	return $photos_data;
}

function comments_data($con, $article_id, $comment_id){
	$query = "SELECT * FROM comments WHERE article_id = '$article_id' AND id = '$comment_id'";
	$result = mysqli_query($con, $query);
	$data = mysqli_fetch_assoc($result);

	return $data;
}

function findLatestArticle($con){
	$query = 'SELECT * FROM articles ORDER BY id DESC LIMIT 1';
	$result = mysqli_query($con, $query);
	$data = mysqli_fetch_assoc($result);
	return $data;
}

function findLatestPhoto($con){
	$query = 'SELECT * FROM photos ORDER BY id DESC LIMIT 1';
	$result = mysqli_query($con, $query);
	$data = mysqli_fetch_assoc($result);
	return $data;
}

function latestComment($con){
	$query = "SELECT * FROM comments ORDER BY id DESC LIMIT 1";
	$result = mysqli_query($con, $query);
	$data = mysqli_fetch_assoc($result);
	return $data;
}

function countComemnts($con, $id){
	$query = "SELECT * FROM comments WHERE article_id='$id'";
	$result = mysqli_query($con, $query);
	$articles_amount = mysqli_num_rows($result);	
	return $articles_amount;
}

function showAllComments($con, $id){
	$query = "SELECT * FROM comments WHERE article_id='$id'";
	$result = mysqli_query($con, $query);
	$comments = mysqli_fetch_assoc($result);
	
	return $show;
}

function readArticle($con, $id){
	$query = "SELECT * FROM articles WHERE id = '$id'";
	$result = mysqli_query($con, $query);
	$data = mysqli_fetch_assoc($result);
	return $data;
}

function updateViews($con, $views, $id){
	$query = "UPDATE articles SET views='$views' WHERE id='$id'";
	mysqli_query($con, $query);
}