<?php
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);
  session_start();
  require_once('../../config.php');

  $temp = 0;
  $_SESSION['review_id'] = $_POST['reviewID'];
  $reviewId = $_SESSION['review_id'];

  $query = "SELECT * FROM SONG_REVIEW WHERE review_id = ?";
  $stmt = mysqli_prepare($dbc, $query);
  mysqli_stmt_bind_param($stmt, "s", $reviewId);
  mysqli_stmt_execute($stmt);

	$result = mysqli_stmt_get_result($stmt);
	$reviewInfo = mysqli_fetch_assoc($result);
  $userId = $reviewInfo['account_id'];
  //
  if(isset($_SESSION['account_id']) && !empty($_SESSION['account_id'])) {
	  $accountId = (int)$_SESSION['account_id'];
    if ($accountId === $userId) {
  		header("Location: ../review/viewOwnReview.php");
  	} else {
      header("Location: ../review/viewReview.php");
    }
  } else {
    header("Location: ../review/viewReview.php");
  }
?>
