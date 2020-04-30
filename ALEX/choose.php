
<!-- // Alex Bolsoy
// Music450 -->

<?php
session_start();
 ?>
<?php
/*This code assumes user input is valid and correct only for demo purposes - it does NOT validate form data.*/
	if(true) {
		// $_SESSION['review_id'] = 60001;
		// $_SESSION['account_id'] = 40001;

    // HUNTER: CHECK THIS - I couldn't test it like this
		$accountId = $_SESSION['account_id'];
		$reviewId = $_SESSION['review_id'];
		require_once('../../mysqli_config.php'); //adjust the relative path as necessary to find your config file

    // Check database to see who made the review
    $query = "SELECT * FROM SONG_REVIEW WHERE review_id = ?";
    $stmt = mysqli_prepare($dbc, $query);
    mysqli_stmt_bind_param($stmt, "s", $reviewId);
    mysqli_stmt_execute($stmt);

		$result = mysqli_stmt_get_result($stmt);
		$reviewInfo = mysqli_fetch_assoc($result);
    $userId = $reviewInfo['account_id'];

    // If current user made the review, javascript calls viewOwnReview
    // If a different user made the review, javascript calls viewReview
		if ($accountId === $userId) {
			$temp = 1;
		}
		else {
			$temp = 0;
		}
  }

?>

<script>
if (<?php echo $temp;?>) {
	window.location.href = "viewOwnReview.php";
} else {
	window.location.href = "viewReview.php";
}
</script>
