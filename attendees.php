<?php
	include("db.php");
	echo '<form action = "attendees.php" method = "post">';
	echo '<h3>Enter Attendees Details</h3>';
	echo '<table>
		<tr>';
		if(isset($_POST['fst_name'])){
			echo '<td>First Name:</td><td> <input type = "text" name = "fst_name" value = "'.$_POST['fst_name'].'" required></input></td>';
		}else {
			echo '<td>First Name:</td><td> <input type = "text" name = "fst_name" required></input></td>';
		}
		if(isset($_POST['lst_name'])){
			echo '<td>Last Name:</td><td> <input type = "text" name = "lst_name" value = "'.$_POST['lst_name'].'" required></input></td>';
		}else {
			echo '<td>Last Name:</td><td> <input type = "text" name = "lst_name" required></input></td>';
		}
		echo '</tr>';
		if(isset($_POST['title'])){
			echo '<tr><td>Title:</td><td><input type = "text" name = "title" value = "'.$_POST['title'].'"></input></td></tr>';
		}else {
			echo '<tr><td>Title:</td><td><input type = "text" name = "title"></input></td></tr>';
		}
		if(isset($_POST['city'])){
			echo '<tr><td>City: </td><td><input type = "text" name = "city" value = "'.$_POST['city'].'"></input></td>';
		} else {
			echo '<tr><td>City: </td><td><input type = "text" name = "city"></input></td>';
		}		
		echo '<td>State: </td>
			<td><select name = "state">';
			//query to get the states
			$states = "SELECT DISTINCT(state) FROM attendee;";
			$state_result = @mysqli_query($dbc, $states);
			while($state = mysqli_fetch_array($state_result, MYSQLI_ASSOC)){
				if(isset($_POST['state'])){
					if($_POST['state'] == $state['state']){
						echo '<option value = "'.$state['state'].'" selected>'.$state['state'].'</option>';
					}					
				}else {
					echo '<option value = "'.$state['state'].'">'.$state['state'].'</option>';
				}
			}				
			echo '</select>
				</td></tr>';
		if(isset($_POST['zip'])){
			echo '<tr><td>Zip Code: </td><td><input type = "number" name = "zip" min = "11111" max = "99999" value = "'.$_POST['zip'].'" required></input></td></tr>';
		}else {
			echo '<tr><td>Zip Code: </td><td><input type = "number" name = "zip" min = "11111" max = "99999" required></input></td></tr>';
		}
		if(isset($_POST['phone'])){
			echo '<tr><td>Cell: </td><td><input type = "number" name = "phone" min = "1111111111" max = "9999999999" value = "'.$_POST['phone'].'"></input></td></tr>';
		}else {
			echo '<tr><td>Cell: </td><td><input type = "number" name = "phone" min = "1111111111" max = "9999999999"></input></td></tr>';
		}
		if(isset($_POST['email'])){
			echo '<tr><td>Email Address: </td><td><input type = "email" name = "email" value = "'.$_POST['email'].'" required></input></td></tr>';
		}else {
			echo '<tr><td>Email Address: </td><td><input type = "email" name = "email" required></input></td></tr>';
		}		
		if(isset($_POST['iacuc'])){
			if($_POST['iacuc'] == 1){
				echo '<tr><td>Member of IACUC?</td><td><input type = "radio" name = "iacuc" value = "1" checked>Yes</input>';
				echo '<input input type = "radio" name = "iacuc" value = "0">No</input></td></tr>';
			}else {
				echo '<tr><td>Member of IACUC?</td><td><input type = "radio" name = "iacuc" value = "1">Yes</input>';
				echo '<input input type = "radio" name = "iacuc" value = "0" checked>No</input></td></tr>';
			}
		}else {
			echo '<tr><td>Member of IACUC?</td><td><input type = "radio" name = "iacuc" value = "1">Yes</input>';
			echo '<input input type = "radio" name = "iacuc" value = "0">No</input></td></tr>';
		}
		if(isset($_POST['principal'])){
			if($_POST['principal'] == 1){
				echo '<tr><td>Principal Investigator? </td><td><input type = "radio" name = "principal" value = "1" checked>Yes</input>';
				echo '<input type = "radio" name = "principal" value = "0">No</input></td></tr>';
			}else {
				echo '<tr><td>Principal Investigator? </td><td><input type = "radio" name = "principal" value = "1">Yes</input>';
				echo '<input type = "radio" name = "principal" value = "0" checked>No</input></td></tr>';
			}
		}else {
			echo '<tr><td>Principal Investigator? </td><td><input type = "radio" name = "principal" value = "1">Yes</input>';
			echo '<input type = "radio" name = "principal" value = "0">No</input></td></tr>';
		}
		if(isset($_POST['db_search'])){
			if($_POST['db_search'] == 1){
				echo '<tr><td>Experienced Database searcher?</td><td><input type = "radio" name = "db_search" value = "1" checked>Yes</input>';
				echo '<input type = "radio" name = "db_search" value = "0">No</input></td></tr>';
			}else {
				echo '<tr><td>Experienced Database searcher?</td><td><input type = "radio" name = "db_search" value = "1">Yes</input>';
				echo '<input type = "radio" name = "db_search" value = "0" checked>No</input></td></tr>';
			}
		}else {
			echo '<tr><td>Experienced Database searcher?</td><td><input type = "radio" name = "db_search" value = "1">Yes</input>';
			echo '<input type = "radio" name = "db_search" value = "0">No</input></td></tr>';
		}		
		echo '<tr><td>Organization: </td><td><select name = "org">';
		//getting the organization names
		$org_name = "SELECT organization_id, organization_name FROM organization;";
		$org_result = @mysqli_query($dbc, $org_name);
		while($org = mysqli_fetch_array($org_result, MYSQLI_ASSOC)){
			if(isset($_POST['org'])){
				if($_POST['org'] == $org['organization_id']){
					echo '<option value = "'.$org['organization_id'].'" selected>'.$org['organization_name'].'</option>';
				}				
			}else {
				echo '<option value = "'.$org['organization_id'].'">'.$org['organization_name'].'</option>';
			}
		}
		echo '</select></td></tr>';
		echo '<tr><td><input type = "submit" value = "Add Attendee"></input></td></tr>';
		if(isset($_POST['fst_name'], $_POST['lst_name'], $_POST['title'], $_POST['city'], $_POST['zip'], $_POST['phone'], $_POST['email'])){
			$attendee_query  = 'INSERT INTO attendee (first_name, last_name, title, city, state, zip_code, phone, email, IACUC_member_status, principal_investigator, experienced_db_searcher, attendee_orgID) ';
			$attendee_query .= 'VALUES("'.$_POST['fst_name'].'", "'.$_POST['lst_name'].'", "'.$_POST['title'].'", "'.$_POST['city'].'", "'.$_POST['state'].'", '.$_POST['zip'].', '.$_POST['phone'].', "'.$_POST['email'].'", '.$_POST['iacuc'].', ';
			$attendee_query .= ''.$_POST['principal'].', '.$_POST['db_search'].', '.$_POST['org'].');';
			//echo $attendee_query;
			if(@mysqli_query($dbc, $attendee_query)){
				echo '<tr><td><p style = "color:green;">Attendee successfully added</p></td></tr>';
			}else {
				echo '<tr><td><p style = "color:red;">There was a problem in adding the attendee</p></td></tr>';
			}
		}
			
		//echo '<tr><td><';
		
//	echo '</form>';
?>