<?php
//updateACCOUNT.php is a page that lests the user know if data in
//ACCOUNT table has been updated successfully or not.
require_once('../config.php');
session_start();
    $accountID = $_SESSION['accountNum'];
    $username = $_GET['userName'];
    $first = $_GET['userFName'];
    $last = $_GET['userLName'];
		$email = $_GET['userEmail'];
    $dob = $_GET['yearDOB'].'-'.$_GET['monthDOB'].'-'.$_GET['dayDOB'];
    $passWord = $_GET['verifyPassword'];
//Collect all datas from user imput. Modified or not.
//Update database based on the changes the user made
    $sql = "UPDATE `ACCOUNT` SET
      `username` = '$username',
      `password` = '$passWord',
      `first_name` = '$first',
      `last_name` = '$last',
      `email` = '$email',
      `date_of_birth` = '$dob'
    where 'account_id'='$accountID' ";
    $result=mysqli_query($dbc, $sql);
//Check wether changes were made successfully
//$result is 1 if successful, -1 if not successful
    if($result >= 0){
      $successful = "Account Updated!";
    }
    else{
      $successful = "Update Error";
    }
?>
<html>
  <title>Result</title>
  <head>
    <link rel="stylesheet" type="text/css" href="login.css">
    <script src="../header/header.js"></script>
  </head>
  <body>
    <div class="flex">
      <div id="loginContainer">
        <div id="loginHeading">
          <p>
          <?php echo $successful;?> <!--This will be a string indicator wether the update was a successful or not-->
          <hr id="loginUnderline"/>
          </p>
        </div>
        <div id="loginLinks">
          <p>Return to
            <a id="signUpLink" href="../index.html">Profile Page</a> <!--replace with home/profile page-->
          </p>

        </div>
      </div>
    </div>
  </body>
  <footer>
    <script src="../footer/footer.js"></script>
  </footer>
</html>
