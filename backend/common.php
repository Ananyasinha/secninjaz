<?php 
	require_once 'db.php';
	$action = $_POST['action']; 
	
	Switch ($action) {
		case 'formSave':
			$name			= $_POST['name']; 	
			$mobile			= $_POST['mobile']; 	
			$gender			= $_POST['gender']; 	
			$location		= $_POST['location'];
			$latitude		= $_POST['latitude'];
			$longitude		= $_POST['longitude'];

			if(empty($name) || empty($mobile) || empty($gender) || empty($location) || empty($latitude) || empty($longitude) || !($name) || !($mobile) || !($gender) || !($location) || !($latitude) || !($longitude)){
				echo json_encode(
					array(
						'status' => false,
						'msg' => 'blank_field'
					)
				);
			}else if(!preg_match("/^[4-9][0-9]{9}$/",$mobile)){
				echo json_encode(
					array(
						'status' => false,
						'msg' => 'wrong_mobile'
					)
				);
			}else {
				$insert_user = "INSERT INTO `users` (name,mobile,gender,location,latitude,longitude,datetime) VALUES ('$name','$mobile','$gender','$location','$latitude','$longitude','$datetime')";
				$inserted    = $conn->query($insert_user);
				if($inserted){
					echo json_encode(
						array(
							'status'  => true,
							'message' => 'inserted'
						)
					);
				}else {
					echo json_encode(
						array(
							'status'  => false,
							'message' => 'failed'
						)
					);
				}
			}
		break;

		case 'formUpdate' :
			$id 			= $_POST['id']; 	
			$name			= $_POST['name']; 	
			$mobile			= $_POST['mobile']; 	
			$gender			= $_POST['gender']; 	
			$location		= $_POST['location'];
			$latitude		= $_POST['latitude'];
			$longitude		= $_POST['longitude'];

			if(empty($id) ||empty($name) || empty($mobile) || empty($gender) || empty($location) || empty($latitude) || empty($longitude) || !($id) || !($name) || !($mobile) || !($gender) || !($location) || !($latitude) || !($longitude)){
				echo json_encode(
					array(
						'status' => false,
						'msg' => 'blank_field'
					)
				);
			}else if(!preg_match("/^[4-9][0-9]{9}$/",$mobile)){
				echo json_encode(
					array(
						'status' => false,
						'msg' => 'wrong_mobile'
					)
				);
			}else {
				$update_user = "UPDATE `users` SET name='$name', mobile='$mobile', gender='$gender', location='$location', latitude='$latitude', longitude='$longitude', datetime='$datetime' WHERE id='$id'";
				$updated    = $conn->query($update_user);
				
				if($updated){
					echo json_encode(
						array(
							'status'  => true,
							'message' => 'updated'
						)
					);
				}else {
					echo json_encode(
						array(
							'status'  => false,
							'message' => 'failed'
						)
					);
				}
			}
		break;

		case 'formsLoad':
		    $select_lists   	= "SELECT * FROM `users`";
		    $selected_lists 	= $conn->query($select_lists);

			if($selected_lists){
		   		$ListArr = array();
				while($row = $selected_lists->fetch_assoc()){
					$id         = $row['id'];
					array_push($ListArr,$id);
					$name  		= $row['name'];
					array_push($ListArr,$name);
					$mobile     = $row['mobile'];
					array_push($ListArr,$mobile);
				    $gender 	= $row['gender'];
					array_push($ListArr,$gender);
					$location 	= $row['location'];
					array_push($ListArr,$location);
					$latitude 	= $row['latitude'];
					array_push($ListArr,$latitude);
					$longitude 	= $row['longitude'];
					array_push($ListArr,$longitude);
				}
				$ListsArr = array_chunk($ListArr,7);
				
				echo json_encode(
					array(
						'status'  	=> true,
						'message' 	=> $ListsArr,
					)
				);
			}else {
				echo json_encode(
					array(
						'status'  	=> false,
						'message' 	=> 'not_found',
					)
				);
			}
		break;

		case 'deleteData' :
			$id 		 = $_POST['id'];
			$delete_data = "DELETE FROM `users` WHERE id='$id'";
			$deleted     = $conn->query($delete_data);
			if($deleted){
				echo json_encode(
					array(
						'status' 	=> true,
						'message'	=> 'deleted'
					)
				);
			}else {
				echo json_encode(
					array(
						'status' 	=> false,
						'message'	=> 'error'
					)
				);
			}
		break;
	}
?>