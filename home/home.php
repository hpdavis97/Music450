<?php
  require_once("../../config.php");
  session_start();
  $sql;
  $rows = array();
  $index = 0;


  function navigateToReview() {
    header('Location: ../login/login.html');
  }


  function getReviews($keyword = '', $filter = '') {
    if ($keyword === ''){
      return "SELECT username, date, rating, review_id, song_name, artist_name, release_date FROM SONG_REVIEW NATURAL JOIN ACCOUNT NATURAL JOIN SONG NATURAL JOIN ARTIST
      ";
    } else {
      if ($filter === 'songs') {
        return "SELECT username, date, rating, review_id, song_name, artist_name, release_date FROM SONG_REVIEW NATURAL JOIN ACCOUNT NATURAL JOIN SONG NATURAL JOIN ARTIST
          WHERE song_name LIKE '%$keyword%'
        ";
      } else if ($filter === 'artists') {
          return "SELECT username, date, rating, review_id, song_name, artist_name, release_date FROM SONG_REVIEW NATURAL JOIN ACCOUNT NATURAL JOIN SONG NATURAL JOIN ARTIST
            WHERE artist_name LIKE '%$keyword%'
          ";
      } else if ($filter === 'reviewers') {
        return "SELECT username, date, rating, review_id, song_name, artist_name, release_date FROM SONG_REVIEW NATURAL JOIN ACCOUNT NATURAL JOIN SONG NATURAL JOIN ARTIST
          WHERE username LIKE '%$keyword%'
        ";
      } else {
        return "SELECT username, date, rating, review_id, song_name, artist_name, release_date FROM SONG_REVIEW NATURAL JOIN ACCOUNT NATURAL JOIN SONG NATURAL JOIN ARTIST
          WHERE username LIKE '%$keyword%' OR date LIKE '%$keyword%' OR rating LIKE '%$keyword%'
          OR review_id LIKE '%$keyword%' OR song_name LIKE '%$keyword%'
          OR artist_name LIKE '%$keyword%' OR release_date LIKE '%$keyword%'
        ";
      }
    }
  }

if(isset($_SESSION['lookupUser']) && !empty($_SESSION['lookupUser'])) {
  $sql = getReviews($_SESSION['username'], 'reviewers');
  unset($_SESSION['lookupUser']);
} else {
  if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $search;
    $filter;
    if(isset($_POST['headerSearch']) && !empty($_POST['headerSearch'])) {
      $search = mysqli_real_escape_string($dbc,$_POST['headerSearch']);
    } else if (isset($_POST['homeSearch']) && !empty($_POST['homeSearch'])){
      $search = mysqli_real_escape_string($dbc,$_POST['homeSearch']);
    }
    if(isset($_POST['searchFilter']) && !empty($_POST['searchFilter'])) {
      $filter = mysqli_real_escape_string($dbc,$_POST['searchFilter']);
    }
    if (isset($search) && !empty($search) && isset($filter) && !empty($filter)) {
      $sql = getReviews($search, $filter);
    } else if (isset($search) && !empty($search)) {
      $sql = getReviews($search);
    } else if (isset($filter) && !empty($filter)) {
      $sql = getReviews('', $filter);
    } else {
      $sql = getReviews();
    }
  } else {
    $sql = getReviews();
  }
}

  $result = mysqli_query($dbc,$sql);

  while($row = mysqli_fetch_assoc($result)){
       $rows[] = $row;
  }
?>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Front Page</title>
    <link id="homeCSS" rel="stylesheet" type="text/css" href="../home/home.css">
    <script src='../header/header.js' ></script>
  </head>
  <body>
    <br>
    <br>
    <div id="mainContainer" class="flex">
      <div id='titleContainer'>
      </div>
      <div id='reviewContainer'>
          <div id='background'>
            <div id='homeSearchWrapper'>
              <form action='../home/home.php' method="post">
                <select name="searchFilter" id="searchFilter">
                  <option value="all">All</option>
                  <option value="songs">Songs</option>
                  <option value="artists">Artists</option>
                  <option value="reviewers">Reviewers</option>
                </select>
                <input id="homeSearch" name="homeSearch" type="text" placeholder="Search...">
                <div class="hidden-submit"><input id="searchSubmit" type="submit" tabindex="-1"/></div>
              </form>
            </div>
            <br>
            <br>

            <h1 id="reviewsTitle"> Reviews </h1>
            <div id='reviewsListWrapper' class="flex">
              <?php foreach($rows as $row) { ?>
                <form id="form1" action="../review/choose.php" method="post">
                  <button type="submit" name="reviewID" id="review" value="<?php echo($row['review_id']); ?>">
                  <div id='reviewLinks' class='flex'>
                      <text id='username'>
                        <?php echo($row['username']) ?>
                      </text>
                      <text id='date'>
                        <?php echo($row['date']) ?>
                      </text>
                      <text id='rating'>
                        <?php echo($row['rating']) ?>
                      </text>
                      <text id='song_name'>
                        <?php echo($row['song_name']) ?>
                      </text>
                      <text id='artist'>
                        <?php echo($row['artist_name']) ?>
                      </text>
                  </div>
                </button>
              </form>
              <?php } ?>
            </div>
          </div>
      </div>
    </div>
  </body>
</html>
