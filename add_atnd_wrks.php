
<?php

 echo '<div>
		<h2>Add attendees to the following workhop</h2>';		
				//establishing database connection
				if(isset($_GET['wid'], $_GET['w_name'])){
					$wid = $_GET['wid'];
					$wname = $_GET['w_name'];
				}
				include("db.php");
				//pages and display
				$display = 5;
				//echo '<form action = "view_attendees.php?s=$start&p=$pages" method = "get">';
				//$start = $_GET['start'];
				//$pages = $_GET['pages'];
				if(isset($_GET['start']) && is_numeric($_GET['start']) && ($_GET['start'] > 0)){
					$start = $_GET['start'];
				}else{
					$start = 0;
				}
				if(isset($_GET['page']) && is_numeric($_GET['page'])){
					$page = $_GET['page'];
				}else{
					$row = "SELECT COUNT(Attendee_id) FROM attendee;";
					$row_result = @mysqli_query($dbc, $row);
					$row_num = mysqli_fetch_array($row_result, MYSQLI_NUM);
					//echo $row_num;
					$num_row = $row_num[0];
					//echo $num_row;
					if($num_row > $display){
						$page = ceil($num_row/$display);
					}else {
						$page = 1;					
					}
				}

				//get the item upon which the table is to be sorted
				$sort = (isset($_GET['sort'])) ? $_GET['sort'] : 'attendee_id';
				//echo $sort.'<br>';
				//cases
				switch ($sort) {
					case 'id':
						$order_by = 'Attendee_id';
						break;
					case 'fn':
						$order_by = 'first_name';
						break;
					case 'ln':
						$order_by = 'last_name';
						break;
					case 'title':
						$order_by = 'title';
						break;
					case 'city':
						$order_by = 'city';
						break;
					case 'state':
						$order_by = 'state';
						break;
					case 'zip':
						$order_by = 'zip_code';
						break;
					case 'ph':
						$order_by = 'phone';
						break;
					case 'email':
						$order_by = 'email';
						break;
					case 'iacuc':
						$order_by = 'IACUC_member_status';
						break;
					case 'princ':
						$order_by = 'principal_investigator';
						break;
					case 'db_search':
						$order_by = 'experienced_db_searcher';
						break;
					case 'org_id':
						$order_by = 'attendee_orgID';
						break;
					default:
						$order_by = $sort;
						break;
				}
				//echo $order_by;
echo '<form action = "add_atnd_wrks.php?wid='.$wid.'&w_name='.$wname.'&start='.$start.'&page='.$page.'&sort='.$sort.'" method = "post">';
				//query
				$atnd_detail  = "SELECT attendee.Attendee_id, attendee.first_name, ";
				$atnd_detail .= "attendee.last_name, attendee.title, attendee.city, ";
				$atnd_detail .= "attendee.state, attendee.zip_code, attendee.phone, attendee.email, ";
				$atnd_detail .= "attendee.IACUC_member_status, attendee.principal_investigator, attendee.experienced_db_searcher, organization.organization_name ";
				$atnd_detail .= "FROM attendee ";
				$atnd_detail .= "INNER JOIN organization ON attendee.attendee_orgID = organization.organization_id ORDER BY $order_by ";
				$atnd_detail .= "LIMIT $start, $display;";
				$atnd_det_result = @mysqli_query($dbc, $atnd_detail);
				//echo $atnd_detail."<br><br>";
				//echo mysqli_num_rows($wrks_det_result). "<br><br>";
				//setting the background color
				//echo $atnd_detail;
				$bg = '#eeeeee';
				//fetching the query
				echo '<h3>Workshop Name: '.$wname.'</h3>';
	echo '<table>
			<tr bgcolor="#eeeeee">
				<td><a href = "add_atnd_wrks.php?sort=id">ID</a></td>
				<td>Select Attendees</td>
				<td><a href = "add_atnd_wrks.php?sort=fn&wid='.$wid.'&w_name='.$wname.'&start='.$start.'&page='.$page.'">First Name</a></td>
				<td><a href = "add_atnd_wrks.php?sort=ln&wid='.$wid.'&w_name='.$wname.'&start='.$start.'&page='.$page.'">Last Name</a></td>
				<td><a href = "add_atnd_wrks.php?sort=title&wid='.$wid.'&w_name='.$wname.'&start='.$start.'&page='.$page.'">Title</a></td>
				<td><a href = "add_atnd_wrks.php?sort=city&wid='.$wid.'&w_name='.$wname.'&start='.$start.'&page='.$page.'">City</a></td>
				<td><a href = "add_atnd_wrks.php?sort=state&wid='.$wid.'&w_name='.$wname.'&start='.$start.'&page='.$page.'">State</a></td>
				<td><a href = "add_atnd_wrks.php?sort=zip&wid='.$wid.'&w_name='.$wname.'&start='.$start.'&page='.$page.'">Zip Code</a></td>
				<td><a href = "add_atnd_wrks.php?sort=phone&wid='.$wid.'&w_name='.$wname.'&start='.$start.'&page='.$page.'">Phone</a></td>
				<td><a href = "add_atnd_wrks.php?sort=email&wid='.$wid.'&w_name='.$wname.'&start='.$start.'&page='.$page.'">Email</a></td>
				<td><a href = "add_atnd_wrks.php?sort=iacuc&wid='.$wid.'&w_name='.$wname.'&start='.$start.'&page='.$page.'">IACUC Member</a></td>
				<td><a href = "add_atnd_wrks.php?sort=princ&wid='.$wid.'&w_name='.$wname.'&start='.$start.'&page='.$page.'">Principal Investigator?</a></td>
				<td><a href = "add_atnd_wrks.php?sort=db_search&wid='.$wid.'&w_name='.$wname.'&start='.$start.'&page='.$page.'">Database Experience</a></td>
				<td><a href = "add_atnd_wrks.php?sort=org_id&wid='.$wid.'&w_name='.$wname.'&start='.$start.'&page='.$page.'">Organization</a></td>
			</tr>';
				while($atdn = mysqli_fetch_array($atnd_det_result, MYSQLI_ASSOC)){
					$bg = ($bg =='#eeeeee' ? '#ffffff' :'#eeeeee'); // Switch the background color.
					echo '<tr bgcolor="'.$bg.'">';
					echo '<td>'.$atdn['Attendee_id'].'</td>';
					echo '<td><input type = "checkbox" name = "ForWrksp[]" value = "'.$atdn['Attendee_id'].'"></input></td>';
					echo '<td>'.$atdn['first_name'].'</td>';
					echo '<td>'.$atdn['last_name'].'</td>';
					echo '<td>'.$atdn['title'].'</td>';
					echo '<td>'.$atdn['city'].'</td>';
					echo '<td>'.$atdn['state'].'</td>';
					echo '<td>'.$atdn['zip_code'].'</td>';
					echo '<td>'.$atdn['phone'].'</td>';
					echo '<td>'.$atdn['email'].'</td>';
					echo '<td>'.$atdn['IACUC_member_status'].'</td>';
					echo '<td>'.$atdn['principal_investigator'].'</td>';
					echo '<td>'.$atdn['experienced_db_searcher'].'</td>';
					echo '<td>'.$atdn['organization_name'].'</td>';
					//echo '<td><a href = "attendee_edit.php?aid='.$atdn['Attendee_id'].'" target = "#">Edit</a></td>';
					//echo '<td><a href = "attendee_delete.php?aid='.$atdn['Attendee_id'].'" target = "#">Delete</a></td>';
					echo '</tr>';
				}
				//mysqli_free_result ($row_result);
				mysqli_close($dbc);
			//echo '</form>';	
			echo '</table>';
			//The page which is being currently displayed
			echo '<br><br>';
			$cur_page = ($start/$display) + 1;
			//If not the first page then a previous link is created
			if($cur_page > 1){
				echo '<a href = "add_atnd_wrks.php?start='.($start-$display).'&page='.$page.'&sort='.$sort.'&wid='.$wid.'&w_name='.$wname.'">Previous</a>';
			}
			//creating the numbered pages
			for($i=1; $i<=$page; $i++){
				echo '<a href = "add_atnd_wrks.php?start='.$display * ($i-1).'&page='.$page.'&sort='.$sort.'&wid='.$wid.'&w_name='.$wname.'">&nbsp;'.$i .'&nbsp;</a>';
			}

			//creating the next button
			if($cur_page < $page){
				echo '<a href= "add_atnd_wrks.php?start='.($start+$display).'&page='.$page.'&sort='.$sort.'&wid='.$wid.'&w_name='.$wname.'">Next</a>';
			}
			//echo '</p></td></tr>';
			echo '<br><br>';
			//echo '1st'.$_POST['ForWrksp'].'<br>';
			if(isset($_POST['ForWrksp'])){
				foreach($_POST['ForWrksp'] as $atnd){
					//echo $atnd;
					$add  = 'INSERT INTO workshop_has_attendee(Workshop_workshop_id, Attendee_Attendee_id) ';
					$add .= 'VALUES ('.$wid.','.$atnd.');';
					//$test = @mysqli_query($dbc, $add);
					//echo $test;
					@include("db.php");
					if(@mysqli_query($dbc, $add)){
						echo '<p style = "color:green">Attendee ID '.$atnd.' added successfully into the workshop</p>';
					}else {
						echo '<p style = "color:red">The attendee ID '.$atnd.' has already been registered for this workshop</p>';
					}
					//echo $add.'<br>';		
				}

				//$add  = 'INSERT INTO `workshop_has_attendee`(`Workshop_workshop_id`, `Attendee_Attendee_id`) ';
				//$add .= 'VALUES ('.$wid.','.$_POST['ForWrksp'].');';
				//echo $add;
			}
			echo '<input type = "submit" value = "Add Selected"></input>';
			echo '<td><a href="view_workshops.php?start=0&page=5&sort=workshop_id">
				<input type="button" value="Go Back" /></td></tr>';
		//	echo '<input type = "submit" value = "Add Selected"></input>';
			
			//echo '2nd'.$_POST['ForWrksp'];			
			echo '<tr>
				
				
			</tr>

		</table>
	</div>';
?>