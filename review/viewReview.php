<?php
session_start();
 ?>
<?php
// $_SESSION['review_id'] = 60007;
/*This code assumes user input is valid and correct only for demo purposes - it does NOT validate form data.*/
	if(true) { // !empty($_GET['review_id'])) { //must have at least a last name not = NULL
		// $song = 30001; //$_GET['songName'];
		$reviewID = $_SESSION['review_id']; // $_GET['songName'];
		require_once('../../mysqli_config.php'); //adjust the relative path as necessary to find your config file
		//Retrieve largest cust_id
		// CHECK IF THE SONG EXISTS AND CHECK IF THE USER HAS ALREADY REVIEWED THIS SONG
		// capitalization of the song name

    // Calculation - average rating of an album

    // keep track of current user id and current review id

		$query = "SELECT * FROM SONG_REVIEW WHERE review_id = ?";
    $stmt = mysqli_prepare($dbc, $query);
    mysqli_stmt_bind_param($stmt, "s", $reviewID);
    mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);
		$reviewInfo = mysqli_fetch_assoc($result);

    $reviewRating = $reviewInfo['rating'];
    $reviewComments = $reviewInfo['comments'];
    $songId = $reviewInfo['song_id'];
    $userId = $reviewInfo['account_id'];

    echo $songId;

    $query2 = "SELECT * FROM SONG WHERE song_id = ?";
    $stmt2 = mysqli_prepare($dbc, $query2);
    mysqli_stmt_bind_param($stmt2, "s", $songId);
    mysqli_stmt_execute($stmt2);
		$result2 = mysqli_stmt_get_result($stmt2);
		$songInfo = mysqli_fetch_assoc($result2);
    $songName = $songInfo['song_name'];
    $artistId = $songInfo['artist_id'];

    echo $songName;
    echo $reviewComments;
    echo $artistId;

    $query3 = "SELECT * FROM ARTIST WHERE artist_id = ?";
    $stmt3 = mysqli_prepare($dbc, $query3);
    mysqli_stmt_bind_param($stmt3, "s", $artistId);
    mysqli_stmt_execute($stmt3);
		$result3 = mysqli_stmt_get_result($stmt3);
		$artistInfo = mysqli_fetch_assoc($result3);
    $artistName = $artistInfo['artist_name'];

    echo $reviewRating;

    echo $artistName;
    echo $userId;

    $query4 = "SELECT * FROM ACCOUNT WHERE account_id = ?";
    $stmt4 = mysqli_prepare($dbc, $query4);
    mysqli_stmt_bind_param($stmt4, "s", $userId);
    mysqli_stmt_execute($stmt4);
		$result4 = mysqli_stmt_get_result($stmt4);
		$reviewerInfo = mysqli_fetch_assoc($result4);
    $reviewerUserName = $reviewerInfo['username'];

    echo $reviewerUserName;

    $query5 = "SELECT ROUND(AVG(rating), 2) AS AvgRating FROM SONG_REVIEW WHERE
    song_id = ?";
    $stmt5 = mysqli_prepare($dbc, $query5);
    mysqli_stmt_bind_param($stmt5, "s", $songId);
    mysqli_stmt_execute($stmt5);
		$result5 = mysqli_stmt_get_result($stmt5);
		$averageInfo = mysqli_fetch_assoc($result5);
    $averageValue = $averageInfo['AvgRating'];

    echo $averageValue;

}

?>
<!DOCTYPE html>
<html lang="en">
<title>View</title>
<head>
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

h3 {
  color: #FAE117;
  text-align: center;
  font-size: 20px;
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
  text-align: center;
}

#songName {
  width: 150px;
  align-self: center;
}

#songRating {
  width: 150px;
  align-self: center;
}

#averageRating {
  width: 150px;
  align-self: center;
}

#songComments {
  width: 150px;
  align-self: center;
}

#songReviewer {
  width: 150px;
  align-self: center;
}

#createButton {
  width: 120px;
  height: 50px;
  background-color: #FAE117;
  color: #333333;
  border: 5px solid #FAE117;
  border-radius: 10px;
}

#deleteButton {
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

}
</style>
<script>
	function newReview() {
	  window.location.href = "http://satoshi.cis.uncw.edu/~ab2700/Proj450/createReview.html";
	}

</script>
<body>
  <script src="../header/header.js"></script>
  <div class="flex">
    <div id="signUpContainer" class="container">
      <h1>View A Review</h1>
      <hr id="signUpUnderline"/>
      <!-- <form action="viewReview.php" method="get"> -->
      <p id="signUp">
        <br>
        <br>
        <!-- <?php
        // echo "<h2>Song Name: </h2>";
        // echo $songInfo['song_name'];
        // ?> -->
        <input id="songName" type="text" placeholder="Song Name" name="songName" value="Song Name" readonly>
        <br>
        <?php
        echo "<h3>".$songName." by ".$artistName."</h3>";
        ?>
        <br>
        <input id="songRating" type="text" placeholder="Song Rating (0-10)" name="songRating" value="Rating" required readonly>
        <br>
        <?php
        echo "<h3>".$reviewRating."/10</h3>";
        ?>
        <br>
        <input id="songComments" type="text" placeholder="Comments" name="songComments" value="Comments" required readonly>
        <br>
        <?php
        echo "<h3>".$reviewComments."</h3>";
        ?>
        <br>
        <input id="songReviewer" type="text" placeholder="Reviewer" name="songReviewer" value="Reviewer" required readonly>
        <br>
        <?php
        echo "<h3>".$reviewerUserName."</h3>";
        ?>
        <br>
        <input id="averageRating" type="text" placeholder="Average" name="avgReview" value="Average Rating" required readonly>
        <br>
        <?php
        echo "<h3>".$averageValue."</h3>";
        ?>
        <br>
      </p>
        <text id="invalidRating" hidden=true>This is your review. Press button to delete review. </text>
        <br>
        <br>
      <p id="button">
        <button id="createButton" onClick="newReview()">Create Review</button>
      </p>
      <br>
      <!-- <br>
      <br>
      <br>
      <br> -->
      <!-- </form> -->
    </div>
  </div>
</body>
<footer>
  <script src="../footer/footer.js"></script>
</footer>
</html>
