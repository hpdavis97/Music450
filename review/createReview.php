<?php
session_start();
 ?>
<?php
/*This code assumes user input is valid and correct only for demo purposes - it does NOT validate form data.*/
	if(!empty($_GET['songRating'])) { //must have at least a last name not = NULL
		// $song = 30001; //$_GET['songName'];
		$song = $_GET['songName'];
		$song = trim($song);
		$rating = $_GET['songRating'];
		$rating = trim($rating);
		$comments = $_GET['songComments'];
		$comments = trim($comments);
		$user = '40001';//$_SESSION['account_id'];
		require_once('../../mysqli_config.php'); //adjust the relative path as necessary to find your config file
		//Retrieve largest cust_id
		// CHECK IF THE SONG EXISTS AND CHECK IF THE USER HAS ALREADY REVIEWED THIS SONG
		// capitalization of the song name
		$query = "SELECT MAX(review_id) FROM SONG_REVIEW";
		//No prepared statements because nothing is input from user for this query
		$result=mysqli_query($dbc, $query);
		$row=mysqli_fetch_array($result); //enumerated array this time instad of assosciative
		$newID = $row[0] + 1;

		$query3 = "SELECT song_id FROM SONG WHERE song_name = ?";
		$stmt3 = mysqli_prepare($dbc, $query3);
		mysqli_stmt_bind_param($stmt3, "s", $song);
		mysqli_stmt_execute($stmt3);
		$result3 = mysqli_stmt_get_result($stmt3);
		$songInfo = mysqli_fetch_assoc($result3);
		$songId = $songInfo['song_id'];
		//mysqli_fetch_all($result3, MYSQLI_ASSOC);

		$query2 = "INSERT INTO SONG_REVIEW(review_id, account_id, song_id, rating, comments) VALUES (?,?,?,?,?)";
		$stmt2 = mysqli_prepare($dbc, $query2);

		//second argument one for each ? either i(integer), d(double), b(blob), s(string or anything else)
		mysqli_stmt_bind_param($stmt2, "sssss", $newID, $user, $songId, $rating, $comments);
		$error = 0;

		if(!mysqli_stmt_execute($stmt2)) { //it did not run successfully
			$error = 1;
			// echo "<h2>ERROR: We were unable to add the review at this time. </h2>";
			// echo "<h2>Either the song is not in the database, or you spelled the song wrong. </h2>";
			// echo "<a href='createReview.html'>Click here to return home.</a>";
			// echo " Song Name:		";
      // echo $song;
			mysqli_close($dbc);
			// exit;
		}
		mysqli_close($dbc);
	}
	else {
		echo "<h2>You have reached this page in error.</h2>";
		mysqli_close($dbc);
		exit;
	}

?>
<!DOCTYPE html>
<html lang="en">
<title>Confirmation</title>
<head>
	<link rel="stylesheet" type="text/css" href="./createReview.css">
	<script src="./createReview.js"></script>
	<meta charset ="utf-8">
</head>
<style>
#button {
  text-align: center;
}
body {
  background-color: #F4F4EE;
  text-align: center;
}

h1 {
  color: #FAE117;
  text-align: center;
  font-size: 40px;
  padding-bottom: 50px;
}

text {
  color: #e04f4a;
}

#signUpContainer {
  background-color: #121212;
  width: 900px;
  height: 950px;
  padding-top: 100px;
  margin-bottom: 4%;
  margin-top: 4%;
  border-radius: 20px;
  box-shadow: 10px 10px 10px #333333;
}

input {
  color: black;
  background-color: #F4F4EE;
  border: 1px solid black;
  border-radius: 10px;
  height: 30px;
  width: 175px;
  padding: 5px;
  box-shadow: 1px 1px 3px #333333;
}
#createAnotherButton {
  width: 120px;
  height: 50px;
  background-color: #FAE117;
  color: #333333;
  border: 5px solid #FAE117;
  border-radius: 10px;
}

#goHomeButton {
  width: 120px;
  height: 50px;
  background-color: #FAE117;
  color: #333333;
  border: 5px solid #FAE117;
  border-radius: 10px;
}

.flex {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
}
</style>
<script>
	if (<?php echo $error;?>) {
		alert("Song is not in the database, or you misspelled the song.");
		window.location.href = "index.html";
	}
	function createAnotherReview() {
	  window.location.href = "http://satoshi.cis.uncw.edu/~ab2700/Proj450/createReview.html";
	}

	function goHome() {
	  window.location.href = "http://satoshi.cis.uncw.edu/~ab2700/Proj450/index.html";
	}
</script>
<body>
	<div class="flex">
	<div id="signUpContainer" class="container">
	<h1>Review was successfully added!</h2>

	<p id="button">
		<button id="createAnotherButton" onClick="createAnotherReview()">Create Review</button>
	</p>
	<p id="button">
		<button id="goHomeButton" onClick="goHome()">Go Home</button>
	</p>
</div>
</div>
</body>
</html>