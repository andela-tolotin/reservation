
<?php


//
$userSession = $_SESSION['userSession'];
$addconnect = $_POST['addconnect'];
$activityCat = $_POST['activity_cat'];
$activityName = $_POST['activity_name'];
$activityAddress = $_POST['activity_address'];
$activityDescription = $_POST['activity_description'];
$date = $_POST['date'];
$dateTime = $_POST['datetime'];
$activityMessage = $_POST['activity_message'];
$username = $_POST['username'];


if (isset($addconnect, $activityCat, $activityName, $activityAddress, $activityDescription, 
$date, $dateTime, $activityMessage,  $username) ) {
	$sql = "INSERT INTO user_invites (user_id, activity_cat, activity_name, activity_address, activity_description, date, datetime, activity_message, username) VALUES ('$userSession','$activityCat','$activityName','".$activityAddress."',
		'$activityDescription','$date','$dateTime','$activityMessage','$username')";


if (!mysqli_query($conn,$sql))
  {
  die('Error: ' . mysqli_error($conn));
  }

echo "<p></br>Thank you!</p>
";

mysqli_close($conn);

}

?>