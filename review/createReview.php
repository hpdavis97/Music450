
<!-- // Alex Bolsoy
// Music450 -->

<?php
session_start();
 ?>
<?php
/*This code assumes user input is valid and correct only for demo purposes - it does NOT validate form data.*/
	if(!empty($_GET['songRating'])) {
		$song = $_GET['songName'];
		$song = trim($song);
		$rating = $_GET['songRating'];
		$rating = trim($rating);
		$comments = $_GET['songComments'];
		$comments = trim($comments);

    // $_SESSION['account_id'] = 40001;

    // HUNTER: CHECK THIS - I couldn't test it like this
		$user = $_SESSION['account_id'];

		require_once('../../config.php'); //adjust the relative path as necessary to find your config file

    // Get review id
    $query = "SELECT MAX(review_id) FROM SONG_REVIEW";
		$result=mysqli_query($dbc, $query);
		$row=mysqli_fetch_array($result); //enumerated array this time instad of assosciative
		$newID = $row[0] + 1;

    // Get song id from database
		$query3 = "SELECT song_id FROM SONG WHERE song_name = ?";
		$stmt3 = mysqli_prepare($dbc, $query3);
		mysqli_stmt_bind_param($stmt3, "s", $song);
		mysqli_stmt_execute($stmt3);
		$result3 = mysqli_stmt_get_result($stmt3);
		$songInfo = mysqli_fetch_assoc($result3);
		$songId = $songInfo['song_id'];

    // Add review to database
		$query2 = "INSERT INTO SONG_REVIEW(review_id, account_id, song_id, rating, comments) VALUES (?,?,?,?,?)";
		$stmt2 = mysqli_prepare($dbc, $query2);

		mysqli_stmt_bind_param($stmt2, "sssss", $newID, $user, $songId, $rating, $comments);
		$error = 0;

		if(!mysqli_stmt_execute($stmt2)) { //it did not run successfully
			$error = 1;
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
	<link rel="stylesheet" type="text/css" href="../review/createReview.css">
	<script src="../review/createReview.js"></script>
  <script src='../header/header.js' ></script>
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

#addSongButton {
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

/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content/Box */
.modal-content {
  background-color: #333333;
  margin: 15% auto; /* 15% from the top and centered */
  padding: 20px;
  border: 1px solid #FAE117;
  width: 80%; /* Could be more or less, depending on screen size */
}

/* The Close Button */
.close {
  color: #aaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: black;
  text-decoration: none;
  cursor: pointer;
}
</style>
<script>
	function createAnotherReview() {
	  window.location.href = "../review/createReview.html";
	}

	function goHome() {
	  window.location.href = "../home/home.php";
	}

  function addSong() {
    window.location.href = "../review/addSong.html";
  }
</script>
<body>
    <!-- The Modal -->
  <div id="myModal" class="modal">

    <!-- Modal content -->
    <div class="modal-content">
      <span class="close">&times;</span>
      <text id='errorMsg'></text></p>
      <p id="button">
        <button id="goHomeButton" onClick="goHome()">Go Home</button>
      </p>
      <p id="button">
        <button id="addSongButton" onClick="addSong()">Add Song</button>
      </p>
    </div>

  </div>
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
<script>
// Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
if (<?php echo $error;?>) {
  modal.style.display = "block";
  // Get error message
  document.getElementById("errorMsg").innerHTML = "Song is not in the database.";
}
</script>
