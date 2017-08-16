<html>
	<div>
		<?php	
		echo '<form action = "workshop_edit.php?wid='.$_GET['wid'].'" method = "post">';
			if(isset($_GET['wid'])){
				//echo '<input type = "hidden" value = "'.$_GET['wid'].'" name = "wid"></input>';
				$wid = $_GET['wid'];
			}
			//echo $wid.'<br><br>' ;
			//database connection
			include('db.php');
			$wrks_detail  = "SELECT workshop.workshop_id, workshop.topic, ";
			$wrks_detail .= "workshop.start_date, workshop.end_date, workshop.location_address, ";
			$wrks_detail .= "workshop.zip_code, workshop.workshop_type, organization.organization_name, ";
			$wrks_detail .= "workshop.overall_rating, workshop.presentation_quality, workshop.duration FROM workshop ";
			$wrks_detail .= "INNER JOIN organization ON workshop.organization_id = organization.organization_id ";
			$wrks_detail .= "WHERE workshop.workshop_id = $wid;";
			$wrks_det_result = @mysqli_query($dbc, $wrks_detail);
			//echo $wrks_detail;

			echo '<table>';
			while ($wrks = mysqli_fetch_array($wrks_det_result, MYSQLI_ASSOC)){
				echo '<tr><td>Workshop ID <input name = "wid" value = "'.$wrks['workshop_id'].'" readonly></input><br></td></tr>';
				if(isset($_POST['topic'])){
					echo '<tr><td>Topic <input type = "text" name = "topic" size = "50" value = "'.$_POST['topic'].'" required></input><br></td></tr>';
				}else {
					echo '<tr><td>Topic <input type = "text" name = "topic" size = "50" value = "'.$wrks['topic'].'" required></input><br></td></tr>';
				}
				if(isset($_POST['start_date'])){
					echo '<tr><td>Start Date <input value = "'.$_POST['start_date'].'" name = "start_date" type = "date" required></input><br></td>';
				}else {
					echo '<tr><td>Start Date <input value = "'.$wrks['start_date'].'" name = "start_date" type = "date" required></input><br></td>';
				}
				if(isset($_POST['end_date'])){
					echo '<td>End Date <input type = "date" name = "end_date" value = "'.$_POST['end_date'].'" required></input></td></tr>';
				}else {
					echo '<td>End Date <input type = "date" name = "end_date" value = "'.$wrks['end_date'].'" required></input></td></tr>';
				}
				if(isset($_POST['loc_addr'])){
					echo '<tr><td>Location Address <input type = "text" value = "'.$_POST['loc_addr'].'" size = "50" name = "loc_addr" required></input></td>';
				}else {
					echo '<tr><td>Location Address <input type = "text" value = "'.$wrks['location_address'].'" size = "50" name = "loc_addr" required></input></td>';
				}
				if(isset($_POST['zip'])){
					echo '<td>Zip Code <input type = "number" min = "11111" max = "99999" name = "zip" value = "'.$_POST['zip'].'" required></input></td></tr>';
				}else {
					echo '<td>Zip Code <input type = "number" min = "11111" max = "99999" name = "zip" value = "'.$wrks['zip_code'].'" required></input></td></tr>';
				}				
				echo '<tr><td>Workshop Type <select name = "wrks_type">';
				//getting the list of workshop types
				$wrks_sql = 'SELECT DISTINCT(workshop_type) as wrks_type FROM workshop';
				$wrks_result = @mysqli_query($dbc,$wrks_sql);
				while($wrks_type = mysqli_fetch_array($wrks_result, MYSQLI_ASSOC)){
					if(isset($_POST['wrks_type'])){
						if($_POST['wrks_type'] == $wrks_type['wrks_type']){
							echo '<option value = "'.$wrks_type['wrks_type'].'" selected>'.$wrks_type['wrks_type'].'</option>';
						}else {
							echo '<option value = "'.$wrks_type['wrks_type'].'">'.$wrks_type['wrks_type'].'</option>';
						}
					}else {
						if($wrks['workshop_type'] == $wrks_type['wrks_type']){
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
						if($wrks['organization_name'] == $org['org_name']){
							echo '<option value = "'.$org['org_id'].'" selected>'.$org['org_name'].'</option>';
						}else {
							echo '<option value = "'.$org['org_id'].'">'.$org['org_name'].'</option>';
						}
					}
				}				
				echo '</select></td></tr>';
				if(isset($_POST['rating'])){
					echo '<tr><td>Overall Rating <input type = "number" min = "1" max = "10" value = "'.$_POST['rating'].'" name = "rating"></input></td></tr>';
				}else {
					echo '<tr><td>Overall Rating <input type = "number" min = "1" max = "10" value = "'.$wrks['overall_rating'].'" name = "rating"></input></td></tr>';
				}
				if(isset($_POST['presentation'])){
					echo '<tr><td>Presentation Quality <input type = "number" min = "1" max = "10" value = "'.$_POST['presentation'].'" name = "presentation"></input></td></tr>';
				}else {
					echo '<tr><td>Presentation Quality <input type = "number" min = "1" max = "10" value = "'.$wrks['presentation_quality'].'" name = "presentation"></input></td></tr>';
				}
				if(isset($_POST['duration'])){
					echo '<tr><td>Duration <input type = "text" name = "duration" value = "'.$_POST['duration'].'"></input></td></tr>';
				}else {
					echo '<tr><td>Duration <input type = "text" name = "duration" value = "'.$wrks['duration'].'"></input></td></tr>';
				}
				echo '<tr><td><input type = "submit" value = "update"></input></td>';
					echo '<td><a href="view_workshops.php?start=0&page=5&sort=workshop_id">
   <input type="button" value="Go Back" /></td></tr>';
			}
			
			//Update query
			if(isset($_POST['topic'], $_POST['start_date'], $_POST['end_date'], $_POST['loc_addr'], $_POST['zip'])){
				if($_POST['start_date'] <= $_POST['end_date']){
					$wrks_upd = 'UPDATE workshop SET topic = "'.$_POST['topic'].'", start_date = "'.$_POST['start_date'].'", ';
					$wrks_upd .= 'end_date = "'.$_POST['end_date'].'", location_address = "'.$_POST['loc_addr'].'", ';
					$wrks_upd .= 'zip_code = "'.$_POST['zip'].'", workshop_type = "'.$_POST['wrks_type'].'", ';
					$wrks_upd .= 'organization_id = "'.$_POST['org_id'].'", overall_rating = "'.$_POST['rating'].'", ';
					$wrks_upd .= 'presentation_quality = "'.$_POST['presentation'].'", duration = "'.$_POST['duration'].'" WHERE workshop_id = '.$_POST['wid'].';';
					//echo $wrks_upd;
					if(@mysqli_query($dbc, $wrks_upd)){
						echo '<tr><td><p style = "color:green">The Workshop details were successfully updated</p></td></tr>';
					}else {
						echo '<tr></td><p style = "color:red">There was an error in updating the workshop details</p></td></tr>';
					}
				}else {
					echo '<tr><td><p style = "color:red;font-weight:bold">The Start Date should be less than or equal to the End Date</p></td></tr>';
				}
			}
		echo '</form>';
		?>
	</div>
</html>