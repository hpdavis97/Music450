
<!-- // Alex Bolsoy
// Music450 -->

<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
 ?>
<?php
/*This code assumes user input is valid and correct only for demo purposes - it does NOT validate form data.*/
	if(!empty($_GET['songName'])) { //must have at least a last name not = NULL
		$song = $_GET['songName'];
		$song = trim($song);
		$artist = $_GET['artistName'];
		$artist = trim($artist);
		$album = $_GET['albumName'];
		$album = trim($album);
		require_once('../../config.php'); //adjust the relative path as necessary to find your config file

    // Get song id
		$query = "SELECT MAX(song_id) FROM SONG";
		//No prepared statements because nothing is input from user for this query
		$result=mysqli_query($dbc, $query);
		$row=mysqli_fetch_array($result); //enumerated array this time instad of assosciative
		$newSongId = $row[0] + 1;

    // looks for song in database
    $query10 = "SELECT song_id FROM SONG WHERE song_name = ?";
		$stmt10 = mysqli_prepare($dbc, $query10);
		mysqli_stmt_bind_param($stmt10, "s", $song);
		mysqli_stmt_execute($stmt10);
		$result10 = mysqli_stmt_get_result($stmt10);
		$songInfo = mysqli_fetch_assoc($result10);
		$oldSongId = $songInfo['song_id'];
		//mysqli_fetch_all($result3, MYSQLI_ASSOC);
    $songAlreadyExists = 0;

    // checks if the song is already in the database
    if ($oldSongId !== NULL) {
      $songAlreadyExists = 1;
    }

    // Get artist id from database
    $query3 = "SELECT artist_id FROM ARTIST WHERE artist_name = ?";
		$stmt3 = mysqli_prepare($dbc, $query3);
		mysqli_stmt_bind_param($stmt3, "s", $artist);
		mysqli_stmt_execute($stmt3);
		$result3 = mysqli_stmt_get_result($stmt3);
		$artistInfo = mysqli_fetch_assoc($result3);
		$artistId = $artistInfo['artist_id'];
		//mysqli_fetch_all($result3, MYSQLI_ASSOC);

    // Checks to see if artist is in the database already
    if ($artistId !== NULL) {
      $artistId = $artistId;
    } else {
      $query4 = "SELECT MAX(artist_id) FROM ARTIST";
  		//No prepared statements because nothing is input from user for this query
  		$result4=mysqli_query($dbc, $query4);
  		$row4=mysqli_fetch_array($result4); //enumerated array this time instad of assosciative
  		$artistId = $row4[0] + 1;
      // Put artist in the database
      $query5 = "INSERT INTO ARTIST(artist_id, artist_name) VALUES (?,?)";
  		$stmt5 = mysqli_prepare($dbc, $query5);
      mysqli_stmt_bind_param($stmt5, "ss", $artistId, $artist);
      mysqli_stmt_execute($stmt5);
    }

    // Get album id from database
    $query6 = "SELECT album_id FROM ALBUM WHERE album_name = ?";
		$stmt6 = mysqli_prepare($dbc, $query6);
		mysqli_stmt_bind_param($stmt6, "s", $album);
		mysqli_stmt_execute($stmt6);
		$result6 = mysqli_stmt_get_result($stmt6);
		$albumInfo = mysqli_fetch_assoc($result6);
		$albumId = $albumInfo['album_id'];
		//mysqli_fetch_all($result3, MYSQLI_ASSOC);

    // Checks to see if album is in the database already
    if ($albumId !== NULL) {
      $albumId = $albumId;
    } else {
      $query7 = "SELECT MAX(album_id) FROM ALBUM";
  		//No prepared statements because nothing is input from user for this query
  		$result7=mysqli_query($dbc, $query7);
  		$row7=mysqli_fetch_array($result7); //enumerated array this time instad of assosciative
  		$albumId = $row7[0] + 1;
      // Put album in the database
      $query8 = "INSERT INTO ALBUM(album_id, artist_id, album_name) VALUES (?,?,?)";
  		$stmt8 = mysqli_prepare($dbc, $query8);
      mysqli_stmt_bind_param($stmt8, "sss", $albumId, $artistId, $album);
      mysqli_stmt_execute($stmt8);
    }

    if ($songAlreadyExists) {
      // do nothing
      mysqli_close($dbc);
      echo $songAlreadyExists;
      $error = 1;
      echo $error;
    }
      else {
        // Add song to the database
		$query9 = "INSERT INTO SONG(song_id, artist_id, album_id, song_name) VALUES (?,?,?,?)";
		$stmt9 = mysqli_prepare($dbc, $query9);

		//second argument one for each ? either i(integer), d(double), b(blob), s(string or anything else)
		mysqli_stmt_bind_param($stmt9, "ssss", $newSongId, $artistId, $albumId, $song);
		$error = 0;

		if(!mysqli_stmt_execute($stmt9)) { //it did not run successfully
			$error = 1;
			mysqli_close($dbc);
		}
		mysqli_close($dbc);
	}
}
	else {
		echo "<h2>You have reached this page in error.</h2>";
		mysqli_close($dbc);
		exit;
	}


?>
<script>
	if (<?php echo $error;?>) {
		alert("Song was already in the database.");
		window.location.href = "../home/home.php";
	} else {
    alert("Song successfully added.");
	  window.location.href = "../review/createReview.html";
	}
</script>
