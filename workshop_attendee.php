<html>
	
<?php
echo '<div>
		<h2>Attendee Detail List</h2>';		
				//establishing database connection
				include("db.php");
				//pages and display
				$display = 5;
				//echo '<form action = "workshop_attendee.php?s=$start&p=$pages" method = "get">';
				//$start = $_GET['start'];
				//$pages = $_GET['pages'];
				if(isset($_GET['wid'], $_GET['w_name'])){
					$w_id = $_GET['wid'];
					$w_name = $_GET['w_name'];
					echo '<h3>Workshop Name: '.$w_name.'</h3>';
				}else {
					die('Please access this page through the proper link');
				}				
				if(isset($_GET['start']) && is_numeric($_GET['start']) && ($_GET['start'] > 0)){
					$start = $_GET['start'];
				}else{
					$start = 0;
				}
				if(isset($_GET['page']) && is_numeric($_GET['page'])){
					$page = $_GET['page'];
				}else{
					$row = 'SELECT COUNT(Attendee_Attendee_id) FROM works_atnd'.$w_id.';';
					//echo $row;
					$row_result = @mysqli_query($dbc, $row);
					if(mysqli_num_rows($row_result) == 0){
						die('No attendees have been added to this Workshop');
					}else {
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
				}
				//get the item upon which the table is to be sorted
				$sort = (isset($_GET['sort'])) ? $_GET['sort'] : 'Attendee_Attendee_id';
				//echo $sort.'<br>';
				//cases
				switch ($sort) {
					case 'id':
						$order_by = 'Attendee_Attendee_id';
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
						$order_by = 'organization_name';
						break;
					default:
						$order_by = $sort;
						break;
				}
				//echo $order_by;
				//fetching the list of attendees
				
				//creating a view
				$view  = "CREATE VIEW works_atnd$w_id AS ";
				$view .= "SELECT workshop_has_attendee.Attendee_Attendee_id, attendee.first_name,attendee.last_name, attendee.title, attendee.city, attendee.state, attendee.zip_code, ";
				$view .= "attendee.phone, attendee.email, attendee.IACUC_member_status, attendee.principal_investigator, attendee.experienced_db_searcher, organization.organization_name ";
				$view .= "FROM workshop_has_attendee INNER JOIN attendee ON workshop_has_attendee.Attendee_Attendee_id = attendee.Attendee_id ";
				$view .= "INNER JOIN organization ON attendee.attendee_orgID = organization.organization_id WHERE workshop_has_attendee.Workshop_workshop_id = $w_id;";
				//echo $view. '<br>';
				if(@mysqli_query($dbc, $view)){
					echo "<p style = 'color:green'> View Successfully Generated</p>";
				}
				$waid  = "SELECT * FROM works_atnd$w_id ORDER BY $order_by LIMIT $start, $display;";
				//echo $waid;
				echo '<h3>Attendees registered for this workshop:</h3>';
				$waID_result = @mysqli_query($dbc, $waid);
						$bg = '#eeeeee';
								//fetching the query		
					echo '<table>
							<tr bgcolor="#eeeeee">
								<td><a href = "workshop_attendee.php?sort=id&wid='.$w_id.'&w_name='.$w_name.'">ID</a></td>
								<td><a href = "workshop_attendee.php?sort=fn&wid='.$w_id.'&w_name='.$w_name.'">First Name</a></td>
								<td><a href = "workshop_attendee.php?sort=ln&wid='.$w_id.'&w_name='.$w_name.'">Last Name</a></td>
								<td><a href = "workshop_attendee.php?sort=title&wid='.$w_id.'&w_name='.$w_name.'">Title</a></td>
								<td><a href = "workshop_attendee.php?sort=city&wid='.$w_id.'&w_name='.$w_name.'">City</a></td>
								<td><a href = "workshop_attendee.php?sort=state&wid='.$w_id.'&w_name='.$w_name.'">State</a></td>
								<td><a href = "workshop_attendee.php?sort=zip&wid='.$w_id.'&w_name='.$w_name.'">Zip Code</a></td>
								<td><a href = "workshop_attendee.php?sort=phone&wid='.$w_id.'&w_name='.$w_name.'">Phone</a></td>
								<td><a href = "workshop_attendee.php?sort=email&wid='.$w_id.'&w_name='.$w_name.'">Email</a></td>
								<td><a href = "workshop_attendee.php?sort=iacuc&wid='.$w_id.'&w_name='.$w_name.'">IACUC Member</a></td>
								<td><a href = "workshop_attendee.php?sort=princ&wid='.$w_id.'&w_name='.$w_name.'">Principal Investigator?</a></td>
								<td><a href = "workshop_attendee.php?sort=db_search&wid='.$w_id.'&w_name='.$w_name.'">Database Experience</a></td>
								<td><a href = "workshop_attendee.php?sort=org_id&wid='.$w_id.'&w_name='.$w_name.'">Organization</a></td>
								<!--<td>Edit Details</td>-->
								<td>Delete</td>
							</tr>';
				while($waid = mysqli_fetch_array($waID_result, MYSQLI_ASSOC)){
					//query
					//echo $waid;
							$bg = ($bg =='#eeeeee' ? '#ffffff' :'#eeeeee'); // Switch the background color.
							echo '<tr bgcolor="'.$bg.'">';
							echo '<td>'.$waid['Attendee_Attendee_id'].'</td>';
							echo '<td>'.$waid['first_name'].'</td>';
							echo '<td>'.$waid['last_name'].'</td>';
							echo '<td>'.$waid['title'].'</td>';
							echo '<td>'.$waid['city'].'</td>';
							echo '<td>'.$waid['state'].'</td>';
							echo '<td>'.$waid['zip_code'].'</td>';
							echo '<td>'.$waid['phone'].'</td>';
							echo '<td>'.$waid['email'].'</td>';
							echo '<td>'.$waid['IACUC_member_status'].'</td>';
							echo '<td>'.$waid['principal_investigator'].'</td>';
							echo '<td>'.$waid['experienced_db_searcher'].'</td>';
							echo '<td>'.$waid['organization_name'].'</td>';
							//echo '<td><a href = "attendee_edit.php?aid='.$waid['Attendee_id'].'" target = "#">Edit</a></td>';
							//echo '<td><a href = "attendee_delete.php?aid='.$waid['Attendee_id'].'" target = "#">Delete</a></td>';
							echo '</tr>';
				}
				//echo $atnd_detail."<br><br>";
				//echo mysqli_num_rows($wrks_det_result). "<br><br>";
				//setting the background color
				//echo $atnd_detail;

				
				//mysqli_free_result ($row_result);
				mysqli_close($dbc);
			//echo '</form>';	
			echo '</table>';
			//The page which is being currently displayed
			echo '<br><br>';
			$cur_page = ($start/$display) + 1;
			//If not the first page then a previous link is created
			if($cur_page > 1){
				echo '<a href = "workshop_attendee.php?start='.($start-$display).'&page='.$page.'&sort='.$sort.'&wid='.$w_id.'&w_name='.$w_name.'">Previous</a>';
			}
			//creating the numbered pages
			for($i=1; $i<=$page; $i++){
				echo '<a href = "workshop_attendee.php?start='.$display * ($i-1).'&page='.$page.'&sort='.$sort.'&wid='.$w_id.'&w_name='.$w_name.'">&nbsp;'.$i .'&nbsp;</a>';
			}

			//creating the next button
			if($cur_page < $page){
				echo '<a href= "workshop_attendee.php?start='.($start+$display).'&page='.$page.'&sort='.$sort.'&wid='.$w_id.'&w_name='.$w_name.'">Next</a>';
			}
			//echo '</p></td></tr>';
			/* $drp_view = "DROP VIEW IF EXISTS `nal`.`works_atnd`;";
			$drp_result = @mysqli_query($dbc, $drp_view);
			echo mysqli_num_rows($drp_result);
			if(@mysqli_query($dbc, $drp_view)){
				echo "all is well";
			}else {
				echo 'something is wrong';
			}		 */	
			echo '<tr>
				
				
			</tr>

		</table>
	</div>';
?>
</html>