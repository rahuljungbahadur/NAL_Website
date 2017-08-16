
<?php
echo '<div>
		<h2>Workshop Detail List</h2>';		
				//establishing database connection
				include("db.php");
				//pages and display
				$display = 5;
				//echo '<form action = "view_workshop.php?s=$start&p=$pages" method = "get">';
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
					$row = "SELECT COUNT(workshop_id) FROM workshop;";
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
				$sort = (isset($_GET['sort'])) ? $_GET['sort'] : 'workshop_id';
				//echo $sort.'<br>';
				//cases
				switch ($sort) {
					case 'id':
						$order_by = 'workshop_id';
						break;
					case 'tp':
						$order_by = 'topic';
						break;
					case 'start':
						$order_by = 'start_date';
						break;
					case 'end':
						$order_by = 'end_date';
						break;
					case 'loc':
						$order_by = 'location_address';
						break;
					case 'zip':
						$order_by = 'zip_code';
						break;
					case 'type':
						$order_by = 'workshop_type';
						break;
					case 'org':
						$order_by = 'organization_name';
						break;
					case 'rat':
						$order_by = 'overall_rating';
						break;
					case 'pre':
						$order_by = 'presentation_quality';
						break;
					case 'dur':
						$order_by = 'duration';
						break;
					default:
						$order_by = $sort;
						break;
				}
				//echo $order_by;
				
				//query
				$wrks_detail  = "SELECT workshop.workshop_id, workshop.topic, ";
				$wrks_detail .= "workshop.start_date, workshop.end_date, workshop.location_address, ";
				$wrks_detail .= "workshop.zip_code, workshop.workshop_type, organization.organization_name, ";
				$wrks_detail .= "workshop.overall_rating, workshop.presentation_quality, workshop.duration FROM workshop ";
				$wrks_detail .= "INNER JOIN organization ON workshop.organization_id = organization.organization_id ORDER BY $order_by ";
				$wrks_detail .= "LIMIT $start, $display;";
				$wrks_det_result = @mysqli_query($dbc, $wrks_detail);
				//echo $wrks_detail."<br><br>";
				//echo mysqli_num_rows($wrks_det_result). "<br><br>";
				//setting the background color
				$bg = '#eeeeee';
				//fetching the query		
	echo '<table>
			<tr bgcolor="#eeeeee">
				<td><a href = "view_workshops.php?sort=id">ID</a></td>
				<td><a href = "view_workshops.php?sort=tp">Topic</a></td>
				<td><a href = "view_workshops.php?sort=start">Start Date</a></td>
				<td><a href = "view_workshops.php?sort=end">End Date</a></td>
				<td><a href = "view_workshops.php?sort=loc">Location Address</a></td>
				<td><a href = "view_workshops.php?sort=zip">Zip Code</a></td>
				<td><a href = "view_workshops.php?sort=type">Workshop Type</a></td>
				<td><a href = "view_workshops.php?sort=org">Organization</a></td>
				<td><a href = "view_workshops.php?sort=rat">Overall Rating</a></td>
				<td><a href = "view_workshops.php?sort=pre">Presentation Quality</a></td>
				<td><a href = "view_workshops.php?sort=dur">Duration</a></td>
				<td>Edit Details</td>
				<td>Delete</td>
				<td>View Attendees</a></td>
				<td>Add Attendees</a></td>
			</tr>';
				while($wrks = mysqli_fetch_array($wrks_det_result, MYSQLI_ASSOC)){
					$bg = ($bg =='#eeeeee' ? '#ffffff' :'#eeeeee'); // Switch the background color.
					echo '<tr bgcolor="'.$bg.'">';
					echo '<td>'.$wrks['workshop_id'].'</td>';
					echo '<td>'.$wrks['topic'].'</td>';
					echo '<td>'.$wrks['start_date'].'</td>';
					echo '<td>'.$wrks['end_date'].'</td>';
					echo '<td>'.$wrks['location_address'].'</td>';
					echo '<td>'.$wrks['zip_code'].'</td>';
					echo '<td>'.$wrks['workshop_type'].'</td>';
					echo '<td>'.$wrks['organization_name'].'</td>';
					echo '<td>'.$wrks['overall_rating'].'</td>';
					echo '<td>'.$wrks['presentation_quality'].'</td>';
					echo '<td>'.$wrks['duration'].'</td>';
					echo '<td><a href = "workshop_edit.php?wid='.$wrks['workshop_id'].'" target = "#">Edit</a></td>';
					echo '<td><a href = "workshop_delete.php?wid='.$wrks['workshop_id'].'&w_name='.$wrks['topic'].'" target = "#">Delete</a></td>';
					echo '<td><a href = "wrks_atnd.php?wid='.$wrks['workshop_id'].'&w_name='.$wrks['topic'].'" target = "#">View </a></td>';
					echo '<td><a href = "add_atnd_wrks.php?wid='.$wrks['workshop_id'].'&w_name='.$wrks['topic'].'&start=0&page=5" target = "#">Add </a></td>';
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
				echo '<a href = "view_workshops.php?start='.($start-$display).'&page='.$page.'&sort='.$sort.'">Previous</a>';
			}
			//creating the numbered pages
			for($i=1; $i<=$page; $i++){
				echo '<a href = "view_workshops.php?start='.$display * ($i-1).'&page='.$page.'&sort='.$sort.'">&nbsp;'.$i .'&nbsp;</a>';
			}

			//creating the next button
			if($cur_page < $page){
				echo '<a href= "view_workshops.php?start='.($start+$display).'&page='.$page.'&sort='.$sort.'">Next</a>';
			}
			//echo '</p></td></tr>';
			
			
			

			
			echo '<tr>
				
				
			</tr>

		</table>
	</div>';
?>