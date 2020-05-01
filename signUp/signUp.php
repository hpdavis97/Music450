<?php
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
	require_once('../../config.php'); //adjust the relative path as necessary to find your config file
	if(!empty($_POST['fName']) && !empty($_POST['lName']) && !empty($_POST['email']) && !empty($_POST['monthDOB']) && !empty($_POST['yearDOB']) && !empty($_POST['dayDOB']) && !empty($_POST['userName'])
	&& !empty($_POST['password1']) && !empty($_POST['password2'])){
		$last = $_POST['lName'];
		$first = $_POST['fName'];
		$email = $_POST['email'];
		$username = $_POST['userName'];
		$DOB = $_POST['yearDOB'].'-'.$_POST['monthDOB'].'-'.$_POST['dayDOB'];
		$password1 = $_POST['password1'];
		$password2 = $_POST['password2'];

		//Retrieve largest cust_id
		$query = "SELECT MAX(account_id) FROM ACCOUNT";
		//No prepared statements because nothing is input from user for this query
		$result=mysqli_query($dbc, $query);
		$row=mysqli_fetch_array($result); //enumerated array this time instad of assosciative
		$newID = $row[0] + 1;
		$query2 = "INSERT INTO ACCOUNT(account_id, username, password, first_name, last_name, email, date_of_birth) VALUES (?,?,?,?,?,?,?)";
		$stmt2 = mysqli_prepare($dbc, $query2);

		//second argument one for each ? either i(integer), d(double), b(blob), s(string or anything else)
		mysqli_stmt_bind_param($stmt2, "sssssss", $newID, $username, $password1, $first, $last, $email, $DOB);

		if(!mysqli_stmt_execute($stmt2)) { //it did not run successfully
			$error = "We were unable to add the customer at this time.";
		} else {
			$error = "User successfully added.";
		}
		mysqli_close($dbc);
	}
	else {
		$error = "There was an error with your information.";
		mysqli_close($dbc);
	}
?>
<script>
	alert("<?php echo($error) ?>");
	window.location.href = "../login/login.html";
</script>
