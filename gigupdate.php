<?php 
	session_start();
	if (isset($_SESSION['login']) == false)
	{
		header('Location:login.php');
	}

	include('conn_database.php');

	$useremail = $_GET['email'];
	$Title = $_GET['Title'];
	$Description = $_GET['Description'];
	$minPrice = $_GET['minPrice'];
	$maxPrice = $_GET['maxPrice'];
	$ExpectedDeliveryDays = $_GET['ExpectedDeliveryDays'];

	$query = "SELECT `UserID` FROM `users` WHERE `users`.`email` = '$useremail'";
	$result = mysqli_query($conn, $query);
	$row = mysqli_fetch_assoc($result);

	$query1 = "INSERT INTO `gigs` (`UserID`, `Title`, `Description`, `minPrice`, `maxPrice`, `ExpectedDeliveryDays`) VALUES ('$row[UserID]', '$Title', '$Description', '$minPrice', '$maxPrice', '$ExpectedDeliveryDays')";

	if (mysqli_query($conn, $query1))
	{
		header("Location:dashboard.php?email=$useremail");
	} 
	else
	{
		header("Location:dashboard.php?email=$useremail");
	}

	mysqli_close($conn);
?>