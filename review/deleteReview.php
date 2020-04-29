<?php
session_start();
 ?>
<?php
/*This code assumes user input is valid and correct only for demo purposes - it does NOT validate form data.*/
	if(true) {
		$reviewId = $_SESSION['review_id']; // $_GET['review_id'];
		require_once('../../mysqli_config.php'); //adjust the relative path as necessary to find your config file

    $query = "DELETE FROM SONG_REVIEW WHERE SONG_REVIEW.review_id = ?";
    $stmt = mysqli_prepare($dbc, $query);
    mysqli_stmt_bind_param($stmt, "s", $reviewId);
    mysqli_stmt_execute($stmt);
  }

  // I CAN GET IT TO DELETE FROM HERE, BUT NOT BY PRESSING THE DELETE BUTTON

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset ="utf-8">
</head>
<body>
	<script>
    alert('Review successfully deleted.')
    window.location.href = "index.html";
  </script>
</body>
</html>
