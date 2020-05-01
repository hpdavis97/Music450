<?php
   require_once("../../config.php");
   session_start();

if($_SERVER['REQUEST_METHOD'] === 'POST') {
  // username and password sent from form
  $myusername = mysqli_real_escape_string($dbc,$_POST['userName']);
  $mypassword = mysqli_real_escape_string($dbc,$_POST['password']);

  $sql = "SELECT account_id FROM ACCOUNT WHERE username = '$myusername' and password = '$mypassword'";
  $result = mysqli_query($dbc,$sql);
  $row = mysqli_fetch_array($result,MYSQLI_ASSOC);

  $count = mysqli_num_rows($result);
  echo($count);

  // If result matched $myusername and $mypassword, table row must be 1 row
  if($count == 1) {
     $_SESSION['account_id'] = $row['account_id'];
     $_SESSION['username'] = $myusername;
  } else {
     $error = "Your Username or Password is invalid";
   }
 }
?>
<script>
  sessionStorage.setItem('username', "<?php if($myusername){echo $myusername;} ?>");
  window.location.href = "../home/home.php";
</script>
