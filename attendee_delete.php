<?php
echo '<form action = "attendee_delete.php?aid='.$_GET['aid'].'"method = "post">';
include("db.php");
	if(isset($_GET['aid'])){
		$aid = $_GET['aid'];
	}else {
		echo '<p style = "color:red">Please access this page from the correct link</p>';
	}
	echo '<h3>Delete this attendee</h3>';
	$atnd  = "SELECT first_name, last_name, title, city, state, zip_code, organization.organization_name as org_name FROM attendee ";
	$atnd .= "INNER JOIN organization ON attendee_orgID = organization.organization_id WHERE Attendee_id=$aid";
	//echo $atnd;
	$atnd_result = @mysqli_query($dbc, $atnd);
	echo '<table>';
	while($at = mysqli_fetch_array($atnd_result, MYSQLI_ASSOC)){
		echo '<tr><td>Name: </td><td>'.$at['first_name'].'&nbsp;'.$at['last_name'].'</td></tr>';
		echo '<tr><td>Title: </td><td>'.$at['title'].'</td></tr>';
		echo '<tr><td>City: </td><td>'.$at['city'].'</td></tr>';
		echo '<tr><td>State: </td><td>'.$at['state'].'</td><td>'.$at['zip_code'].'</td></tr>';
		echo '<tr><td>Organization:</td><td>'.$at['org_name'].'</td></tr>';
	}
	echo '<input type = "hidden" name = "delete"></input>';
	
	if(isset($_POST['delete'])){
		$del = "DELETE FROM attendee WHERE Attendee_id = $aid";
		//echo $del;
		if(@mysqli_query($dbc, $del)){
			echo '<p style = "color:green">The attendee has been deleted successfully</p>';
		}else{
			echo '<p style = "color:red">The attendee could not be deleted</p>';
		}
	}
	echo '<tr><td><input type = "submit" value = "Delete"></input><td>';
	echo '<td><a href="view_attendees.php?start=0&page=5&sort=Attendee_id">
   <input type="button" value="Go Back" /></td></tr>';
	echo '</table>';
	//echo '<h3>Attendee Details : '.$wname.'</h3>';
?>