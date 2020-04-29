<?php
//editProfile.php is a page that allows users to make modifications on his/her account
//on ACCOUNT table on database. The user will neither delete nor add new data.
//User will update existing account. The only data that can't be
//modified is account_id. User is able to modify name, user name, email, date of birth
//and password.
require_once("../config.php");      //Makes connection to database
session_start();
$sql = "SELECT * FROM ACCOUNT WHERE account_id = $_SESSION[accountNum]";
$result = mysqli_query($dbc,$sql);
$row = mysqli_fetch_array($result,MYSQLI_ASSOC); //Chose row from account table with specific account_id

$account_id = $row['account_id']; //stores datas from a row in ACCOUNT table
$username = $row['username'];     //these data will be put on textfields that user can modify
$first_name = $row['first_name'];
$last_name = $row['last_name'];
$email = $row['email'];
$birth_date = $row['date_of_birth'];
list($year, $month, $day) = explode("-", $birth_date);
?>

<html>
  <title>Update_Account</title>
  <head>
    <link rel="stylesheet" type="text/css" href="editProfile.css">
    <script src="editProfile.js"></script>
  </head>
  <body>
    <script src="../header/header.js"></script>
    <div class="flex">
      <div id="signUpContainer" class="container">
        <h1>Edit Account</h1>
        <hr id="signUpUnderline"/>
        <form action="updateACCOUNT.php" method="get">
        <p id="signUp">
          <br>
          <br>
          <!--Promt user for account modifications-->
          <!--Old data retrieved from database will be on textfields-->
          <!--These data can be modified by the user-->
          <text id='birthdate'>First Name &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Last Name</text>
          <br>
          <input id="fName" type="text" value="<?php echo $first_name;?>" name="userFName" onchange="checkFName()" required>
          <input id="lName" type="text" value="<?php echo $last_name;?>" name="userLName" onchange="checkLName()" required>
          <br>
          <br>
          <text id='birthdate'>Email</text>
          <br>
          <input id="email" type="text" value="<?php echo $email;?>" name="userEmail" onkeyup="noSpace('email');" onchange="checkEmail()" required>
        </p>
        <text id='birthdate'>User Name</text>
        <p id="loginInfo">
          <input id="userName" type="text" value="<?php echo $username;?>" name="userName" onchange="checkUsername()" required>
          <br>
        </p>
          <text id="invalidEmail" hidden=true>Email is invalid.</text>
          <br>
          <br>
          <br>
          <br>
          <text id='birthdate'>Birthdate</text>
        <p id="bday">
          <input id="monthDOB" type="text" value="<?php echo $month;?>" name='monthDOB'onkeyup="noSpace('monthDOB');" onchange="checkMonth()" required>
          <input id="dayDOB" type="text" value="<?php echo $day;?>" name='dayDOB'onkeyup="noSpace('dayDOB');" onchange="checkDay()" required>
          <input id="yearDOB" type="text" value="<?php echo $year;?>" name='yearDOB'onkeyup="noSpace('yearDOB');" onchange="checkYear()" required>
        </p>
          <text id="invalidDOB" hidden=true>DOB is invalid.</text>
          <br>
          <br>
        <text id='birthdate'>Reset Password</text>
        <p
          <br><!--each password input is valid by password checker-->
          <input id="password0" type="password" placeholder="Old Password" name="oldPassword" onkeyup="passwordChecking()" required>
          <br>
          <input id="password1" type="password" placeholder="New Password" name="newPassword" onkeyup="passwordChecking()" required>
          <br>
          <input id="password2" type="password" placeholder="Verify New Password" name="verifyPassword" onkeyup="passwordChecking()" required>
        </p>
          <text id="notVerified" hidden=true>Your password cannot have spaces.</text>
          <br>
          <br>
        <p>
          <button id="createButton" type="submit" >Update Account</button>
        </p>
        </form>
        <br>
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
