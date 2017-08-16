<?php
echo '<form action = "wrks_atnd_remove.php?a_id='.$_GET['a_id'].'&w_id='.$_GET['w_id'].'&w_name='.$_GET['w_name'].'" method = "post">';
include("db.php");
	if(isset($_GET['a_id'], $_GET['w_id'])){
		$aid = $_GET['a_id'];
		$wid = $_GET['w_id'];
		$wname = $_GET['w_name'];
	}else {
		echo '<p style = "color:red">Please access this page from the correct link</p>';
	}
	echo '<h3>Workshop Name:<br> '.$wname.'</h3>';
	if(!isset($_POST['remove'])){
		$ws_at  = "SELECT workshop_has_attendee.Attendee_Attendee_id, attendee.first_name,attendee.last_name, attendee.title, attendee.city, attendee.state, attendee.zip_code, ";
		$ws_at .= "attendee.phone, attendee.email, attendee.IACUC_member_status, attendee.principal_investigator, attendee.experienced_db_searcher, organization.organization_name ";
		$ws_at .= "FROM workshop_has_attendee INNER JOIN attendee ON workshop_has_attendee.Attendee_Attendee_id = attendee.Attendee_id ";
		$ws_at .= "INNER JOIN organization ON attendee.attendee_orgID = organization.organization_id WHERE workshop_has_attendee.Workshop_workshop_id = $wid AND workshop_has_attendee.Attendee_Attendee_id = $aid;";
		//echo $ws_at;
		$ws_at_result = @mysqli_query($dbc, $ws_at);		
		echo '<table>';
		while ($wsat = mysqli_fetch_array($ws_at_result, MYSQLI_ASSOC)){
			echo '<tr><td>Name:</td><td>'.$wsat['first_name'].'&nbsp;'.$wsat['last_name'].'</td></tr>';
			echo '<tr><td>Title:</td><td>'.$wsat['title'].'</td></tr>';
			echo '<tr><td>City: </td><td>'.$wsat['city'].'</td><td>Zip: </td><td>'.$wsat['zip_code'].'</td></tr>';
			echo '<tr><td>Phone: </td><td>'.$wsat['phone'].'</td><td>Email: </td><td>'.$wsat['email'].'</td></tr>';
		}	
		echo '</table>';
	}
	echo '<input type = "hidden" name = "remove"></input>';
	if(isset($_POST['remove'])){
		$remove = "DELETE FROM `workshop_has_attendee` WHERE Attendee_Attendee_id = $aid";
		//echo $remove;
		if(@mysqli_query($dbc, $remove)){
			echo '<p style = "color:green">The Attendee was <b>SUCCESSFULLY REMOVED</b> from the workshop</p>';
		}else {
			echo '<p style = "color:red">The Attendee was <b>NOT</b> removed from the workshop</p>';
		}
	}
	echo '<input type = "submit" value = "Remove Attendee from Workshop"></input>';
	echo '<a href="wrks_atnd.php?wid='.$wid.'&w_name='.$wname.'">
   <input type="button" value="Go Back" />
</a>';
echo '</form>';

?>