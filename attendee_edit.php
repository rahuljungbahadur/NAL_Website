<html>
	<div>
		<?php	
		echo '<form action = "attendee_edit.php?aid='.$_GET['aid'].'" method = "post">';
			if(isset($_GET['aid'])){
				//echo '<input type = "hidden" value = "'.$_GET['wid'].'" name = "wid"></input>';
				$aid = $_GET['aid'];
			}
			//echo $wid.'<br><br>' ;
			//database connection
			include('db.php');
			$atdn_detail  = "SELECT attendee.Attendee_id, attendee.first_name, ";
			$atdn_detail .= "attendee.last_name, attendee.title, attendee.city, attendee.state, ";
			$atdn_detail .= "attendee.zip_code, attendee.phone, attendee.email, attendee.IACUC_member_status as iacuc, attendee.principal_investigator as princ, attendee.experienced_db_searcher as db_search, organization.organization_name ";
			$atdn_detail .= "FROM attendee ";
			$atdn_detail .= "INNER JOIN organization ON attendee.attendee_orgID = organization.organization_id ";
			$atdn_detail .= "WHERE attendee.Attendee_id = $aid;";
			$atdn_det_result = @mysqli_query($dbc, $atdn_detail);
			echo $atdn_detail;

			echo '<table>';
			while ($atdn = mysqli_fetch_array($atdn_det_result, MYSQLI_ASSOC)){
				echo '<tr><td>Attendee ID <input name = "wid" value = "'.$atdn['Attendee_id'].'" readonly></input><br></td></tr>';
				if(isset($_POST['first_name'])){
					echo '<tr><td>First Name: <input type = "text" name = "first_name" size = "50" value = "'.$_POST['first_name'].'" required></input><br></td></tr>';
				}else {
					echo '<tr><td>Last Name: <input type = "text" name = "first_name" size = "50" value = "'.$atdn['first_name'].'" required></input><br></td></tr>';
				}
				if(isset($_POST['last_name'])){
					echo '<tr><td>Start Date <input value = "'.$_POST['last_name'].'" name = "last_name" type = "text" required></input><br></td>';
				}else {
					echo '<tr><td>Start Date <input value = "'.$atdn['last_name'].'" name = "last_name" type = "text" required></input><br></td>';
				}
				if(isset($_POST['title'])){
					echo '<td>Title <input type = "title" name = "title" value = "'.$_POST['title'].'" required></input></td></tr>';
				}else {
					echo '<td>Title <input type = "title" name = "title" value = "'.$atdn['title'].'" required></input></td></tr>';
				}
				if(isset($_POST['city'])){
					echo '<tr><td>City <input type = "text" value = "'.$_POST['city'].'" name = "city" required></input></td>';
				}else {
					echo '<tr><td>city <input type = "text" value = "'.$atdn['city'].'" size = "50" name = "loc_addr" required></input></td>';
				}
				if (isset($_POST['state'])){
					echo '<tr><td>State <input type = "text" value = "'.$_POST['state'].'" name = "state" required></input></td>';
				}else {
					echo '<tr><td>State <input type = "text" value = "'.$atdn['state'].'" name = "state" required></input></td>';
				}
				if(isset($_POST['zip'])){
					echo '<td>Zip Code <input type = "number" min = "11111" max = "99999" name = "zip" value = "'.$_POST['zip'].'" required></input></td></tr>';
				}else {
					echo '<td>Zip Code <input type = "number" min = "11111" max = "99999" name = "zip" value = "'.$atdn['zip_code'].'" required></input></td></tr>';
				}				
				if(isset($_POST['phone'])){
					echo '<td>Phone: <input type = "number" min = "1111111111" max = "9999999999" name = "phone" value = "'.$_POST['phone'].'" required></input></td></tr>';
				}else {
					echo '<td>Phone: <input type = "number" min = "1111111111" max = "9999999999" name = "phone" value = "'.$atdn['phone'].'" required></input></td></tr>';
				}
				if(isset($_POST['email'])){
					echo '<td>Email <input type = "email" name = "email" value = "'.$_POST['email'].'" required></input></td></tr>';
				}else {
					echo '<td>Email <input type = "email" name = "email" value = "'.$atdn['email'].'" required></input></td></tr>';
				}
				if(isset($_POST['iacuc'])){
					if($_POST['iacuc'] == 1) {
						echo '<tr><td>IACUC Member: <input type = "radio" name = "iacuc" value = "1" checked>Yes</input>';
						echo '<input type = "radio" name = "iacuc" value = "0">No</input></td></tr>';
					}else {
						echo '<tr><td>IACUC Member: <input type = "radio" name = "iacuc" value = "1">Yes</input>';
						echo '<input type = "radio" name = "iacuc" value = "0" checked>No</input></td></tr>';
					}					
				}else {
					if($atdn['iacuc'] == 1) {
						echo '<tr><td>IACUC Member: <input type = "radio" name = "iacuc" value = "1" checked>Yes</input>';
						echo '<input type = "radio" name = "iacuc" value = "0">No</input></td></tr>';
					}else {
						echo '<tr><td>IACUC Member: <input type = "radio" name = "iacuc" value = "1">Yes</input>';
						echo '<input type = "radio" name = "iacuc" value = "0" checked>No</input></td></tr>';
					}	
				}
				if(isset($_POST['princ'])){
					echo '<td>Principal Investigator: <input type = "radio" name = "princ" value = "'.$_POST['princ'].'"></input></td></tr>';
				}else {
					echo '<td>Principal Investigator: <input type = "radio" name = "princ" value = "'.$atdn['princ'].'"></input></td></tr>';
				}
				if(isset($_POST['db_search'])){
					echo '<td>Experienced Database searcher? <input type = "radio" name = "db_search" value = "'.$_POST['db_search'].'"></input></td></tr>';
				}else {
					echo '<td>Experienced Database searcher? <input type = "radio" name = "db_search" value = "'.$atdn['db_search'].'"></input></td></tr>';
				}
				echo '<tr><td> <select name = "atdn_type">';
				//getting the list of attendee types
				$wrks_sql = 'SELECT DISTINCT(workshop_type) as wrks_type FROM attendee';
				$wrks_result = @mysqli_query($dbc,$wrks_sql);
				while($wrks_type = mysqli_fetch_array($wrks_result, MYSQLI_ASSOC)){
					if(isset($_POST['wrks_type'])){
						if($_POST['wrks_type'] == $wrks_type['wrks_type']){
							echo '<option value = "'.$wrks_type['wrks_type'].'" selected>'.$wrks_type['wrks_type'].'</option>';
						}else {
							echo '<option value = "'.$wrks_type['wrks_type'].'">'.$wrks_type['wrks_type'].'</option>';
						}
					}else {
						if($atdn['workshop_type'] == $wrks_type['wrks_type']){
							echo '<option value = "'.$wrks_type['wrks_type'].'" selected>'.$wrks_type['wrks_type'].'</option>';
						}else {
							echo '<option value = "'.$wrks_type['wrks_type'].'">'.$wrks_type['wrks_type'].'</option>';
						}
					}
				}			
				//organization names
				//echo '</td></tr></select name = "org_id">';
				echo '<tr><td>Organization name<select name = "org_id">';
				//list of organizations
				$org_sql = "SELECT organization_id as org_id, organization_name as org_name FROM organization";
				$org_result = @mysqli_query($dbc, $org_sql);
				while($org = mysqli_fetch_array($org_result, MYSQLI_ASSOC)){
					if(isset($_POST['org_id'])){
						if($_POST['org_id'] == $org['org_id']){
							echo '<option value = "'.$org['org_id'].'" selected>'.$org['org_name'].'</option>';
						}else {
							echo '<option value = "'.$org['org_id'].'">'.$org['org_name'].'</option>';
						}
					}else {
						if($atdn['organization_name'] == $org['org_name']){
							echo '<option value = "'.$org['org_id'].'" selected>'.$org['org_name'].'</option>';
						}else {
							echo '<option value = "'.$org['org_id'].'">'.$org['org_name'].'</option>';
						}
					}
				}				
				echo '</select></td></tr>';
				echo '<tr><td><input type = "submit" value = "update"></input></td></tr>';
			}
			
			//Update query
			if(isset($_POST['topic'], $_POST['start_date'], $_POST['end_date'], $_POST['loc_addr'], $_POST['zip'])){
				if($_POST['start_date'] <= $_POST['end_date']){
					$wrks_upd = 'UPDATE attendee SET topic = "'.$_POST['topic'].'", start_date = "'.$_POST['start_date'].'", ';
					$wrks_upd .= 'end_date = "'.$_POST['end_date'].'", location_address = "'.$_POST['loc_addr'].'", ';
					$wrks_upd .= 'zip_code = "'.$_POST['zip'].'", workshop_type = "'.$_POST['wrks_type'].'", ';
					$wrks_upd .= 'organization_id = "'.$_POST['org_id'].'", overall_rating = "'.$_POST['rating'].'", ';
					$wrks_upd .= 'presentation_quality = "'.$_POST['presentation'].'", duration = "'.$_POST['duration'].'" WHERE workshop_id = '.$_POST['wid'].';';
					//echo $wrks_upd;
					if(@mysqli_query($dbc, $wrks_upd)){
						echo '<tr><td><p style = "color:green">The Workshop details were successfully updated</p></td></tr>';
					}else {
						echo '<tr></td><p style = "color:red">There was an error in updating the attendee details</p></td></tr>';
					}
				}else {
					echo '<tr><td><p style = "color:red;font-weight:bold">The Start Date should be less than or equal to the End Date</p></td></tr>';
				}
			}
		echo '</form>';
		?>
	</div>
</html>