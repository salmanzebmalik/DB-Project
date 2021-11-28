<?php
	session_start();
	if (isset($_SESSION['login']) == false)
	{
		header('Location:login.php');
	}

	include('conn_database.php');

	$useremail = $_GET['email'];
	$query = "SELECT * FROM `users` WHERE `email` = '$useremail'";
	$result = mysqli_query($conn, $query);
	$row = mysqli_fetch_assoc($result);
	$AccountType = $row['AccountType'];
?>

<!DOCTYPE html>
<html>
<head>
	<title>LinkUp</title>
</head>
<body>
	<h1>DashBoard</h1>
	<?php 
	echo "<a href=logout.php> <button>Log out</button> </a>";
	echo "<br><br>";
	echo "<a href=profile.php?email=$useremail> <button>Profile</button> </a>";
	echo "<br><br>";
	echo "<a href=message.php?email=$useremail> <button>Messages</button> </a>";
	echo "<br><br>";

	
	if ($AccountType == "freelancer")
	{
		echo "<a href=mygigs.php?email=$useremail> <button>My Gigs</button> </a>";
		echo "<br><br>";
		echo "<a href=gigpost.php?email=$useremail> <button>Post Gig</button> </a>";
	}
	else
	{
		echo "<a href=myrequests.php?email=$useremail> <button>My Requests</button> </a>";
		echo "<br><br>";	
		echo "<a href=requestpost.php?email=$useremail> <button>Post Requests</button> </a>";
	}
	echo "<br><br>";

	echo "<a href=dashboard.php?email=$useremail> <button>Gigs</button> </a>";
	echo "<a href=requests.php?email=$useremail> <button>Requests</button> </a>";

	$query = "SELECT * FROM `users` JOIN `requests` ON `users`.`UserID` = `requests`.`UserID`";
	$result = mysqli_query($conn, $query);
	while ($row = mysqli_fetch_assoc($result))
	{
		echo "<div>
		<h3>Posted By:</h3>
		$row[Name]
		<br>
		<h3>Title:</h3>
		$row[Title]
		<br>
		<h3>Description:</h3>
		$row[Description]
		<br>
		<h3>Min Price:</h3>
		$row[minPrice]
		<br>
		<h3>Max Price:</h3>
		$row[maxPrice]
		<br>
		<h3>Required Delivery Days:</h3>
		$row[RequiredDeliveryDays]
		<br>
		</div>
		";
	}

	?>
</body>
</html>