<?php
session_start();
 ?>
<?php
/*This code assumes user input is valid and correct only for demo purposes - it does NOT validate form data.*/
	if(true) {
		// session_start();
		$_SESSION['review_id'] = 60008;
		$_SESSION['account_id'] = 40001;
		$accountId = $_SESSION['account_id'];
		$reviewId = $_SESSION['review_id'];
		require_once('../../mysqli_config.php'); //adjust the relative path as necessary to find your config file

    $query = "SELECT * FROM SONG_REVIEW WHERE review_id = ?";
    $stmt = mysqli_prepare($dbc, $query);
    mysqli_stmt_bind_param($stmt, "s", $reviewId);
    mysqli_stmt_execute($stmt);

		$result = mysqli_stmt_get_result($stmt);
		$reviewInfo = mysqli_fetch_assoc($result);
    $userId = $reviewInfo['account_id'];

		if ($accountId === $userId) {
			$temp = 1;
		}
		else {
			$temp = 0;
		}
  }

  // I CAN GET IT TO DELETE FROM HERE, BUT NOT BY PRESSING THE DELETE BUTTON

?>

<script>
if (<?php echo $temp;?>) {
	window.location.href = "viewOwnReview.php";
} else {
	window.location.href = "viewReview.php";
}
</script>
