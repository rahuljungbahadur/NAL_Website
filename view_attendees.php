
<?php
echo '<div>
		<h2>Attendee Detail List</h2>';		
				//establishing database connection
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
	echo '<table>
			<tr bgcolor="#eeeeee">
				<td><a href = "view_attendees.php?sort=id">ID</a></td>
				<td><a href = "view_attendees.php?sort=fn">First Name</a></td>
				<td><a href = "view_attendees.php?sort=ls">Last Name</a></td>
				<td><a href = "view_attendees.php?sort=title">Title</a></td>
				<td><a href = "view_attendees.php?sort=city">City</a></td>
				<td><a href = "view_attendees.php?sort=state">State</a></td>
				<td><a href = "view_attendees.php?sort=zip">Zip Code</a></td>
				<td><a href = "view_attendees.php?sort=phone">Phone</a></td>
				<td><a href = "view_attendees.php?sort=email">Email</a></td>
				<td><a href = "view_attendees.php?sort=iacuc">IACUC Member</a></td>
				<td><a href = "view_attendees.php?sort=princ">Principal Investigator?</a></td>
				<td><a href = "view_attendees.php?sort=db_search">Database Experience</a></td>
				<td><a href = "view_attendees.php?sort=org_id">Organization</a></td>
				<td>Edit Details</td>
				<td>Delete</td>
			</tr>';
				while($atdn = mysqli_fetch_array($atnd_det_result, MYSQLI_ASSOC)){
					$bg = ($bg =='#eeeeee' ? '#ffffff' :'#eeeeee'); // Switch the background color.
					echo '<tr bgcolor="'.$bg.'">';
					echo '<td>'.$atdn['Attendee_id'].'</td>';
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
					echo '<td><a href = "attendee_edit.php?aid='.$atdn['Attendee_id'].'" target = "#">Edit</a></td>';
					echo '<td><a href = "attendee_delete.php?aid='.$atdn['Attendee_id'].'" target = "#">Delete</a></td>';
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
				echo '<a href = "view_attendees.php?start='.($start-$display).'&page='.$page.'&sort='.$sort.'">Previous</a>';
			}
			//creating the numbered pages
			for($i=1; $i<=$page; $i++){
				echo '<a href = "view_attendees.php?start='.$display * ($i-1).'&page='.$page.'&sort='.$sort.'">&nbsp;'.$i .'&nbsp;</a>';
			}

			//creating the next button
			if($cur_page < $page){
				echo '<a href= "view_attendees.php?start='.($start+$display).'&page='.$page.'&sort='.$sort.'">Next</a>';
			}
			//echo '</p></td></tr>';
			
			
			

			
			echo '<tr>
				
				
			</tr>

		</table>
	</div>';
?>