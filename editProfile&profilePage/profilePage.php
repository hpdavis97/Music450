<?php
//profilePage.php is a page that allows users to view his/her options
//This page allows users to navigate through the website.
//The options are: look up a song, look up a review, make a review, update account, and delete review
require_once("../config.php");      //Makes connection to database
session_start();
$sql = "SELECT * FROM ACCOUNT WHERE account_id = $_SESSION[accountNum]";
$result = mysqli_query($dbc,$sql);
$row = mysqli_fetch_array($result,MYSQLI_ASSOC); //Chose row from account table with specific account_id

$account_id = $row['account_id']; //stores datas from a row in ACCOUNT table
$username = $row['username'];     //user name will be displayed
?>

<html>
  <title>Profile_Page</title>
  <head>
    <link rel="stylesheet" type="text/css" href="profilePage.css">
    <script src="editProfile.js"></script>
  </head>
  <body>
    <script src="../~ad9369/header/header.js"></script>
    <div class="flex">
      <div id="signUpContainer" class="container">
        <h1>Profile Page</h1>
        <hr id="signUpUnderline"/>
        <h2>Logged in as <?php echo $username;?></h2>
        <br><!--This area is where user can click buttons to easily navigate through different modules -->
        <button class="btn" onclick="window.location.href = 'https://www.google.com/';"><i class="fa fa-music"></i> Lookup Song</button>
        <button class="btn" onclick="window.location.href = 'https://www.google.com/';"><i class="fa fa-comments"></i> Lookup Review</button>
        <button class="btn" onclick="window.location.href = 'https://www.google.com/';"><i class="fa fa-edit"></i> Make Review</button>
        <button class="btn" onclick="window.location.href = 'https://www.google.com/';"><i class="fa fa-trash"></i> Delete Review</button>
        <button class="btn" onclick="window.location.href = '../~ad9369/editProfile.php';"><i class="fa fa-drivers-license-o"></i> Update Account</button>
        <br><!--replace link with the right file path-->
        <br>
        <br>
        <br>
      </div>
    </div>
  </body>
  <footer>
    <script src="../~ad9369/footer/footer.js"></script>
  </footer>
</html>
