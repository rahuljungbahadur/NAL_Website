<?php
echo '<form action = "workshop_delete.php?wid='.$_GET['wid'].'&w_name='.$_GET['w_name'].'"method = "post">';
include("db.php");
	if(isset($_GET['wid'])){
		$wid = $_GET['wid'];
		$wname = $_GET['w_name'];
	}else {
		echo '<p style = "color:red">Please access this page from the correct link</p>';
	}
	echo '<h3>Workshop Topic : '.$wname.'</h3>';
	$wrks  = "SELECT start_date, end_date, location_address, zip_code, workshop_type, organization.organization_name as org_name ";
	$wrks .= "FROM workshop INNER JOIN organization ON workshop.organization_id = organization.organization_id WHERE workshop_id = $wid;";
	//echo $wrks;
	echo '<table>';
	$wrks_result = @mysqli_query($dbc, $wrks);
	while($wrks_det = mysqli_fetch_array($wrks_result, MYSQLI_ASSOC)){
		echo '<tr><td>Start Date: '.$wrks_det['start_date'].'</td><td>End Date: '.$wrks_det['end_date'].'</td></tr>';
		echo '<tr><td>Location: </td><td>'.$wrks_det['location_address'].'</td></tr>';
		echo '<tr><td>Zip Code:</td><td>'.$wrks_det['zip_code'].'</td></tr>';
		echo '<tr><td>Workshop type: </td><td>'.$wrks_det['workshop_type'].'</td></tr>';
		echo '<tr><td>Organization Name: </td><td>'.$wrks_det['org_name'].'</td></tr>';
	}
	echo '<input type = "hidden" name = "delete"></input>';
	
	if(isset($_POST['delete'])){
		$del = "DELETE FROM workshop WHERE workshop_id = $wid";
		//echo $del;
		if(@mysqli_query($dbc, $del)){
			echo '<tr><td><p style = "color:green">The workshop has been deleted successfully</p></td></tr>';
		}else{
			echo '<tr><td><p style = "color:red">The workshop could not be deleted</p></td></tr>';
		}
	}
	echo '<tr><td><input type = "submit" value = "Delete"></input><td>';
	echo '<td><a href="view_workshops.php?start=0&page=5&sort=workshop_id">
   <input type="button" value="Go Back" /></td></tr>';
	echo '</table>';
echo '</form>';

?>