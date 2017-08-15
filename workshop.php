<?php
include('db.php');
if(isset($_POST['org_name'], $_POST['trainer_name'], $_POST['start_date'])){
	$org_id = $_POST['org_name'];
	$tr_name = $_POST['trainer_name'];
	$start_date = $_POST['start_date'];
	//echo $trainer_name;
}
echo '<h4>Add a Workshop</h4>

<form action = "workshop.php" method = "post">
	Workshop Topic: ';
	if(isset($_POST['wrks_name'])){
		echo '<input type = "text" name = "wrks_name" value = "'.$_POST['wrks_name'].'"></input>';
	}else {
		echo '<input type = "text" name = "wrks_name"></input>';
	}
	echo
	'<table>
		<tr>
			<td style = "width:50%">Start Date</td>
			<td style = "width:50%">End Date</td>
		</tr>
		<tr>';
		if(isset($_POST['start_date'])){
			echo '<td><input type = "date" name = "start_date" value = "'.$_POST['start_date'].'"></input></td>';			
		}else {
			echo '<td><input type = "date" name = "start_date"></input></td>';
		}
		if(isset($_POST['end_date'])){
			echo '<td><input type = "date" name = "end_date" value = "'.$_POST['end_date'].'"></input></td>';			
		}else {
			echo '<td><input type = "date" name = "end_date"></input></td>';
		}
		echo '</tr>
		<tr>
			<td>Organization Name:
			<select name = "org_name">';
			$org_sql = "SELECT organization_id as org_id, organization_name as org_name FROM organization";
			$org_result = @mysqli_query($dbc, $org_sql);
			if(!$org_result){
				die('The Organization query was not successful');
			}
			while($org = mysqli_fetch_array($org_result, MYSQLI_ASSOC)){
				if($org_id == $org['org_id']){
					echo '<option value = "'.$org['org_id'].'" selected>'.$org['org_name'].'</option>';
				}else {
					echo '<option value = "'.$org['org_id'].'">'.$org['org_name'].'</option>';
					}
			}
							
			echo '</select>
			<td>
			<input type = "submit" value = "Select this organization"></input>
			</td>
		</tr>
		<tr>
			<td>
				Available Trainers for the selected organization:
			
				<select name = "trainer_name">';
				if(isset($_POST['org_name'])){
					$trainer_sql = "SELECT trainer_id as tr_id, trainer_name as tr_name FROM awic_trainer WHERE org2_id =$org_id";
					$trainer_result = @mysqli_query($dbc, $trainer_sql);
					if(!$trainer_result){
						die("Trainer Query Failed");
					}else if(mysqli_num_rows($trainer_result)>0){
						while($trainer = mysqli_fetch_array($trainer_result, MYSQLI_ASSOC)){
							if($tr_name == $trainer['tr_id']){
								echo '<option value = "'.$trainer['tr_id'].'" selected>'.$trainer['tr_name'].'</option>';
							}else {
								echo '<option value = "'.$trainer['tr_id'].'">'.$trainer['tr_name'].'</option>';
							}
						}
					}else {
						echo '<option value = "none">No registered trainers</option>';
					}					
				}else {
					echo '<option value = "none">Please select an organization</option>';
				}					
				echo '</select>
			</td>
		</tr>
		<tr>
			<td>';
			if(isset($_POST['loc'])){
				echo 'Location Address:<input type = "text" name = "loc" value = "'.$_POST['loc'].'"></input>';
			}else {
				echo 'Location Address:<input type = "text" name = "loc"></input>';
			}
			echo '</td>
			<td>';
			if(isset($_POST['zip'])){
				echo 'ZIP:<input type = "number" min = "11111" max = "99999" name = "zip" value = "'.$_POST['zip'].'"></input>';
			}else {
				echo 'ZIP:<input type = "number" min = "11111" max = "99999" name = "zip"></input>';
			}
			
			echo '</td>
		</tr>
		<tr>
			<td>
				Workshop type:
				<select name = "works_type">';
				$wrks_sql = 'SELECT DISTINCT(workshop_type) as wrks_type FROM workshop';
				$wrks_result = @mysqli_query($dbc,$wrks_sql);
				if(isset($_POST['works_type'])){
					$wrk_typ = $_POST['works_type'];
				}
				while($wrks_type = mysqli_fetch_array($wrks_result, MYSQLI_ASSOC)){
						if($wrk_typ == $wrks_type['wrks_type']){
							echo '<option value = "'.$wrks_type['wrks_type'].'" selected>'.$wrks_type['wrks_type'].'</option>';
						}else {
							echo '<option value = "'.$wrks_type['wrks_type'].'">'.$wrks_type['wrks_type'].'</option>';
						}
				}				
			echo '</selected></td>
		</tr>
		<tr>
			<td>
				<input type = "submit" value = "Add Workshop"></input>
			</td>
		</tr>
	</table>';
	if(isset($_POST['wrks_name'], $_POST['start_date'], $_POST['end_date'], $_POST['loc'], $_POST['zip'])){
		if($_POST['wrks_name'] == ''){
			echo '<p style = "color:red">Please enter the Workshop name</p>';
			//continue;
		}
		if($_POST['start_date'] == '') {
			echo '<p style = "color:red">Please enter start date</p>';
			//continue;
		}
		if($_POST['end_date'] == '') {
			echo '<p style = "color:red">Please enter end date</p>';
			//continue;
		}
		if($_POST['start_date'] > $_POST['end_date']){
			echo '<p style = "color:red">The start date should be less than or equal to the end date!.</p>';
		}
		if($_POST['loc'] == ''){
			echo '<p style = "color:red">Please enter location for the workshop</p>';
			//continue;
		}
		if($_POST['zip'] == ''){
			echo '<p style = "color:red">Please enter the zip code for the location</p>';
			//continue;
		}
		if($_POST['trainer_name'] == 'none'){
			echo '<p style = "color:red">No trainers selected. Please add a trainer in the database</p>';
			//continue;
		}
		if($_POST['wrks_name'] != '' & $_POST['start_date'] != '' & $_POST['end_date'] != '' & $_POST['start_date'] <= $_POST['end_date'] & $_POST['loc'] != '' & $_POST['zip'] != ''){
			$verifi = 'SELECT * FROM workshop WHERE start_date = "'.$_POST['start_date'].'" AND end_date = "'.$_POST['end_date'].'" AND zip_code = "'.$_POST['zip'].'"';
			//echo $verifi;
			$verifi_result = @mysqli_query($dbc, $verifi);
			if(mysqli_num_rows($verifi_result) == 0) {
				$wrks_insert  = 'INSERT INTO workshop (topic, start_date, end_date, location_address,';
				$wrks_insert .= 'zip_code, workshop_type, organization_id)VALUES("'.$_POST['wrks_name'].'",';
				$wrks_insert .= '"'.$_POST['start_date'].'", "'.$_POST['end_date'].'", "'.$_POST['loc'].'","';
				$wrks_insert .= ''.$_POST['zip'].'", "'.$_POST['works_type'].'","'.$_POST['org_name'].'");';
				//echo $wrks_upd; 
				$insertion = @mysqli_query($dbc, $wrks_insert);
				echo '<p style = "color:green">Workshop created successfully</p>';
			}else {
				echo '<p style = "color:red">There is another workshop being conducted at the same location at that time</p>';
			}
		}
		//echo $wrks_upd;
	}
	mysqli_close($dbc);
	
	
echo '</form>';
?>

