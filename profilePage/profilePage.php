<?php
session_start();
//profilePage.php is a page that allows users to view his/her options
//This page allows users to navigate through the website.
//The options are: look up a song, look up a review, make a review, update account, and delete review
require_once("../../config.php");      //Makes connection to database
$account_id = $_SESSION['account_id']; //get account from current session
$username = $_SESSION['username']; //get username from session
?>

<html>
  <title>Profile_Page</title>
  <head>
    <link rel="stylesheet" type="text/css" href="../profilePage/profilePage.css">
    <script src="../editProfile/editProfile.js"></script>
  </head>
  <body>
    <script src="../header/header.js"></script>
    <div class="flex">
      <div id="profileContainer" class="container">
        <h1>Logged in as <?php echo $username;?></h1>
        <hr id="signUpUnderline"/>
        <h2>Manage Your Account</h2>
        <br>
        <br>
        <br><!--This area is where user can click buttons to easily navigate through different modules -->
        <button class="btn" onclick="window.location.href = '../review/createReview.html';"><i class="fa fa-edit"></i> Make Review</button>
        <button class="btn" onclick="window.location.href = '../profilePage/lookupReviews.php';"><i class="fa fa-trash"></i> Your Reviews</button>
        <button class="btn" onclick="window.location.href = '../editProfile/editProfile.php';"><i class="fa fa-drivers-license-o"></i> Update Account</button>
        <br><!--replace link with the right file path-->
        <br>
        <br>
        <br>
      </div>
    </div>
  </body>
  <footer>
    <script src="../footer/footer.js"></script>
  </footer>
</html>
