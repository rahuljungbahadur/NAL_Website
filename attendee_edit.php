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
			$atdn_detail .= "attendee.zip_code, attendee.phone, attendee.email, attendee.IACUC_member_status as iacuc, attendee.principal_investigator as princ, ";
			$atdn_detail .=	"attendee.experienced_db_searcher as db_search, organization.organization_name ";
			$atdn_detail .= "FROM attendee ";
			$atdn_detail .= "INNER JOIN organization ON attendee.attendee_orgID = organization.organization_id ";
			$atdn_detail .= "WHERE attendee.Attendee_id = $aid;";
			$atdn_det_result = @mysqli_query($dbc, $atdn_detail);
			//echo $atdn_detail;

			echo '<table>';
			while ($atdn = mysqli_fetch_array($atdn_det_result, MYSQLI_ASSOC)){
				echo '<tr><td>Attendee ID <input name = "wid" value = "'.$atdn['Attendee_id'].'" readonly></input><br></td></tr>';
				if(isset($_POST['first_name'])){
					echo '<tr><td>First Name: <input type = "text" name = "first_name" size = "50" value = "'.$_POST['first_name'].'" required></input><br></td></tr>';
				}else {
					echo '<tr><td>First Name: <input type = "text" name = "first_name" size = "50" value = "'.$atdn['first_name'].'" required></input><br></td></tr>';
				}
				if(isset($_POST['last_name'])){
					echo '<tr><td>Last Name <input value = "'.$_POST['last_name'].'" name = "last_name" type = "text" required></input><br></td>';
				}else {
					echo '<tr><td>Last Name <input value = "'.$atdn['last_name'].'" name = "last_name" type = "text" required></input><br></td>';
				}
				if(isset($_POST['title'])){
					echo '<td>Title <input type = "title" name = "title" value = "'.$_POST['title'].'" required></input></td></tr>';
				}else {
					echo '<td>Title <input type = "title" name = "title" value = "'.$atdn['title'].'" required></input></td></tr>';
				}
				if(isset($_POST['city'])){
					echo '<tr><td>City <input type = "text" value = "'.$_POST['city'].'" name = "city" required></input></td>';
				}else {
					echo '<tr><td>City <input type = "text" value = "'.$atdn['city'].'" name = "city" required></input></td>';
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
					if($_POST['princ'] == 1){
						echo '<tr><td>Principal Investigator: <input type = "radio" name = "princ" value = "1" checked>Yes</input>';
						echo '<input type = "radio" name = "princ" value = "0">No</input>';
					}else {
						echo '<tr><td>Principal Investigator: <input type = "radio" name = "princ" value = "1">Yes</input>';
						echo '<input type = "radio" name = "princ" value = "0" checked>No</input>';
					}
				}else {
					if($atdn['princ'] == 1){
						echo '<tr><td>Principal Investigator: <input type = "radio" name = "princ" value = "1" checked>Yes</input>';
						echo '<input type = "radio" name = "princ" value = "0">No</input></td></tr>';
					}else {
						echo '<tr><td>Principal Investigator: <input type = "radio" name = "princ" value = "1">Yes</input>';
						echo '<input type = "radio" name = "princ" value = "0" checked>No</input></td></tr>';							
					}
				}
				if(isset($_POST['db_search'])){
					if($_POST['db_search'] == 1){
						echo '<tr><td>Experienced Database searcher? <input type = "radio" name = "db_search" value = "1" checked></input>';
						echo '<input type = "radio" name = "db_search" value = "0">No</input></td></tr>';
					}else {
						echo '<tr><td>Experienced Database searcher? <input type = "radio" name = "db_search" value = "1"></input>';
						echo '<input type = "radio" name = "db_search" value = "0" checked>No</input></td></tr>';
					}
				}else {
					if($atdn['db_search'] == 1){
						echo '<td>Experienced Database searcher? <input type = "radio" name = "db_search" value = "1" checked></input>';
						echo '<input type = "radio" name = "db_search" value = "0">No</input></td></tr>';
					}else {
						echo '<td>Experienced Database searcher? <input type = "radio" name = "db_search" value = "1"></input>';
						echo '<input type = "radio" name = "db_search" value = "0" checked>No</input></td></tr>';
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
			if(isset($_POST['first_name'], $_POST['last_name'], $_POST['title'], $_POST['city'], $_POST['state'])){
					$atdn_upd = 'UPDATE attendee SET first_name = "'.$_POST['first_name'].'", last_name = "'.$_POST['last_name'].'", ';
					$atdn_upd .= 'title = "'.$_POST['title'].'", city = "'.$_POST['city'].'", state = "'.$_POST['state'].'", ';
					$atdn_upd .= 'zip_code = "'.$_POST['zip'].'", phone = "'.$_POST['phone'].'", email = "'.$_POST['email'].'", IACUC_member_status = '.$_POST['iacuc'].', ';
					$atdn_upd .= 'principal_investigator = '.$_POST['princ'].', experienced_db_searcher = '.$_POST['db_search'].', attendee_orgID = '.$_POST['org_id'].' ';
					$atdn_upd .= 'WHERE Attendee_id = '.$aid.';';
					//echo $atdn_upd ;
					if(@mysqli_query($dbc, $atdn_upd)){
						echo '<tr><td><p style = "color:green">The Attendee details were successfully updated</p></td></tr>';
					}else {
						echo '<tr></td><p style = "color:red">There was an error in updating the Attendee details</p></td></tr>';
					}
			}
		echo '</form>';
		?>
	</div>
</html>