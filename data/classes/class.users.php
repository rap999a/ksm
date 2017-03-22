<?php if(!isset($_SESSION))
    {
        session_start();
    }
	include_once("class.dbinfo.php");
	// include_once("../classes/class.crypto.php");

	/**
	* 	Name : Users
	*	Author : Rohan Purekar
	*	Date : 23/6/2016
	*	Version : 1.1
	*	Application : ---KSM Phase 1---
	*/
	/**

	*/

	class users {
		public function __construct(){
			global $dsn;
			global $user;
			global $password;

			try{
				$this->pdo = new PDO($dsn,$user,$password);
				$this->pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
			}
			catch(PDOException $e){
				echo 'Connection Failed'.$e->getMessage();
			}
		}
		public function signUp($data){

			$email = $data->email;
			$email = explode("@",$email);
			$email_pre = $email[0];
		    $email_suff = $email[1];
			$fname = ucfirst(strtolower($data->firstname));
			$lname = ucfirst(strtolower($data->lastname));

			$stmt = $this->pdo->prepare("INSERT INTO PM010001 (f_name,l_name,username_pre,username_suff,password) VALUES (:f_name,:l_name,:email_pre,:email_suff,:password) ");
			$stmt->bindParam(":f_name",$fname,PDO::PARAM_STR);
			$stmt->bindParam(":l_name",$lname,PDO::PARAM_STR);
			$stmt->bindParam(":email_pre",$email_pre,PDO::PARAM_STR);
			$stmt->bindParam(":email_suff",$email_suff,PDO::PARAM_STR);
			$stmt->bindParam(":password",$data->password,PDO::PARAM_STR);
			$stmt->execute();
			// $articles = $stmt->fetchAll(PDO::FETCH_ASSOC);
		}
		public function login($data){
			if (strpos($data->email,"@")) {
				$email = $data->email;
				$email = explode("@",$email);
				$email_pre = $email[0];
			  $email_suff = $email[1];

				$this->pdo->exec("use ksm_plexus");
				$stmt = $this->pdo->prepare("SELECT prim_id,student_id,f_name,l_name,account_type FROM PM010001 WHERE username_pre=:email_pre AND username_suff = :email_suff AND password = :password ");
				$stmt->bindParam(":email_pre",$email_pre,PDO::PARAM_STR);
				$stmt->bindParam(":email_suff",$email_suff,PDO::PARAM_STR);
				$stmt->bindParam(":password",$data->password,PDO::PARAM_STR);
				$stmt->execute();
				$count = $stmt->rowCount();
				$user = $stmt->fetchAll(PDO::FETCH_ASSOC);

				if ($count == 1){
					$_SESSION['status'] = 1;
					$_SESSION['studentId'] = $user[0]['student_id'];
					$_SESSION['user_plexus_id'] = $user[0]['prim_id'];
					$_SESSION['email']=$email_pre."@".$email_suff;
					$_SESSION['f_name']=$user[0]['f_name'];
					$_SESSION['l_name']=$user[0]['l_name'];
					$_SESSION['account_type']=$user[0]['account_type'];
					echo json_encode($user);
				}
				else {
					echo "0";
				}
			}
			else{
				$student_id = $data->email;

				$this->pdo->exec("use ksm_plexus");
				$stmt = $this->pdo->prepare("SELECT prim_id,username_pre,username_suff,f_name,l_name,account_type FROM PM010001 WHERE student_id = :student_id AND password = :password ");
				$stmt->bindParam(":student_id",$student_id,PDO::PARAM_STR);
				$stmt->bindParam(":password",$data->password,PDO::PARAM_STR);
				$stmt->execute();
				$count = $stmt->rowCount();
				$user = $stmt->fetchAll(PDO::FETCH_ASSOC);

				if ($count == 1){
					$_SESSION['status'] = 1;
					$_SESSION['studentId'] = $student_id;
					$_SESSION['user_plexus_id'] = $user[0]['prim_id'];
					$_SESSION['email']=$user[0]['username_pre']."@".$user[0]['username_suff'];
					$_SESSION['f_name']=$user[0]['f_name'];
					$_SESSION['l_name']=$user[0]['l_name'];
					$_SESSION['account_type']=$user[0]['account_type'];
					echo json_encode($user);
				}
				else {
					echo "0";
				}
			}



		}
		public function fetchProctorBasic(){

			$stmt = $this->pdo->prepare("SELECT * FROM PM010002 WHERE studentID = :student_id");
      $stmt->bindParam(":student_id",$_SESSION['studentId'],PDO::PARAM_STR);
      $stmt->execute();
    	$count = $stmt->fetchAll(PDO::FETCH_ASSOC);
			return $count;
		}
		public function fetchProctorRest(){

			$stmt = $this->pdo->prepare("SELECT sr_no FROM PM010002 WHERE studentID = :student_id");
      $stmt->bindParam(":student_id",$_SESSION['studentId'],PDO::PARAM_STR);
      $stmt->execute();
      $count = $stmt->fetchAll(PDO::FETCH_ASSOC);

			$stmt = $this->pdo->prepare("SELECT * FROM PM010003 WHERE student_key_id = :student_id");
			$stmt->bindParam(":student_id",$count[0]['sr_no'],PDO::PARAM_STR);
			$stmt->execute();
			$count = $stmt->fetchAll(PDO::FETCH_ASSOC);
			return $count;


		}
		public function fetchCurrentClass(){
			$active = 1;
			$stmt = $this->pdo->prepare("SELECT class_id,division FROM PM010011 WHERE student_key_id = :student_id AND active = :active");
			$stmt->bindParam(":student_id",$_SESSION['user_plexus_id'],PDO::PARAM_STR);
			$stmt->bindParam(":active",$active,PDO::PARAM_STR);
			$stmt->execute();
			$count = $stmt->fetchAll(PDO::FETCH_ASSOC);
			return $count;
		}

		public function fetchPrevAcademic(){
			$stmt = $this->pdo->prepare("SELECT * FROM PM010008 WHERE student_id = :student_id");
			$stmt->bindParam(":student_id",$_SESSION['studentId'],PDO::PARAM_STR);
			$stmt->execute();
			$count = $stmt->fetchAll(PDO::FETCH_ASSOC);
			return $count;
		}

		public function saveProfilePic($path,$id){
			$stmt = $this->pdo->prepare("UPDATE PM010001 SET photo = :photo WHERE student_id = :student_id");
			$stmt->bindParam(":student_id",$id,PDO::PARAM_STR);
			$stmt->bindParam(":photo",$path,PDO::PARAM_STR);
			$stmt->execute();

		}
		public function saveCertificate($path,$id,$certificateId){
      echo $certificateId;
			$stmt = $this->pdo->prepare("UPDATE PM010015 SET image = :photo WHERE student_id = :student_id AND sr_no = :prim_id");
      $stmt->bindParam(":photo",$path,PDO::PARAM_STR);
      $stmt->bindParam(":student_id",$id,PDO::PARAM_STR);
			$stmt->bindParam(":prim_id",$certificateId,PDO::PARAM_STR);
			$stmt->execute();

		}

		public function fetchPhoto(){
			$stmt = $this->pdo->prepare("SELECT photo FROM PM010001 WHERE student_id = :student_id");
			$stmt->bindParam(":student_id",$_SESSION['studentId'],PDO::PARAM_STR);
			$stmt->execute();
			$row = $stmt->fetchAll(PDO::FETCH_ASSOC);
			return $row;
		}

		public function proctorForm($data){
			$this->pdo->exec("use ksm_plexus");
			if (isset($data)) {
				$stmt = $this->pdo->prepare("INSERT INTO PM010002 (firstname,lastname,studentId,branch,shift,yoa,myDate,email,phone,Laddress,Paddress) VALUES (:firstname,:lastname,:studentID,:branch,:shift,:yoa,:myDate,:email,:phone,:Laddress,:Paddress)");
				$stmt->bindParam(":firstname",$data['firstname'],PDO::PARAM_STR);
				$stmt->bindParam(":lastname",$data['lastname'],PDO::PARAM_STR);
				$stmt->bindParam(":studentID",$data['studentID'],PDO::PARAM_STR);
				$stmt->bindParam(":branch",$data['branch'],PDO::PARAM_STR);
				$stmt->bindParam(":shift",$data['shift'],PDO::PARAM_STR);
				$stmt->bindParam(":yoa",$data['yoa'],PDO::PARAM_STR);
				$stmt->bindParam(":myDate",$data['myDate'],PDO::PARAM_STR);
				$stmt->bindParam(":email",$data['email'],PDO::PARAM_STR);
				$stmt->bindParam(":phone",$data['phone'],PDO::PARAM_STR);
				$stmt->bindParam(":Laddress",$data['Laddress'],PDO::PARAM_STR);
				$stmt->bindParam(":Paddress",$data['Paddress'],PDO::PARAM_STR);
				$stmt->execute();

				$stmt = $this->pdo->prepare("SELECT sr_no FROM PM010002 WHERE student_id = :studentID ORDER BY sr_no DESC LIMIT 1");
				$stmt->bindParam(":studentID",$data['studentID'],PDO::PARAM_STR);
				$stmt->execute();
				$FK_02_03 = $stmt->fetchAll(PDO::FETCH_ASSOC);

				$stmt = $this->pdo->prepare("INSERT INTO PM010003 (student_key_id,father_name,father_occ,father_contact,mother_name,mother_occ,mother_contact,l_guardian_name,l_guardian_contact,doc_name,doc_contact,med_history,personality_traits,interest_hobbies,awards,inspiration) VALUES (:key,:fathername,:foccupation,:fcontact,:mothername,:moccupation,:mcontact,:guardianname,:gcontact,:docname,:docContact,:medHistory,:personalityTraits,:interest,:awards,:inspiration)");
				$stmt->bindParam(":key",$FK_02_03[0]['sr_no'],PDO::PARAM_STR);
				$stmt->bindParam(":fathername",$data['fathername'],PDO::PARAM_STR);
				$stmt->bindParam(":foccupation",$data['foccupation'],PDO::PARAM_STR);
				$stmt->bindParam(":fcontact",$data['fcontact'],PDO::PARAM_STR);
				$stmt->bindParam(":mothername",$data['mothername'],PDO::PARAM_STR);
				$stmt->bindParam(":moccupation",$data['moccupation'],PDO::PARAM_STR);
				$stmt->bindParam(":mcontact",$data['mcontact'],PDO::PARAM_STR);
				$stmt->bindParam(":guardianname",$data['guardianname'],PDO::PARAM_STR);
				$stmt->bindParam(":gcontact",$data['gcontact'],PDO::PARAM_STR);
				$stmt->bindParam(":docname",$data['docname'],PDO::PARAM_STR);
				$stmt->bindParam(":docContact",$data['docContact'],PDO::PARAM_STR);
				$stmt->bindParam(":medHistory",$data['medicalHistory'],PDO::PARAM_STR);
				$stmt->bindParam(":personalityTraits",$data['Personality'],PDO::PARAM_STR);
				$stmt->bindParam(":interest",$data['interests'],PDO::PARAM_STR);
				$stmt->bindParam(":awards",$data['awards'],PDO::PARAM_STR);
				$stmt->bindParam(":inspiration",$data['roleModel'],PDO::PARAM_STR);
				$stmt->execute();
				echo json_encode($FK_02_03);

			}

		}
		public function uniqueUser($email){

		$email_filtered = explode("@",$email);
		$email_pre = $email_filtered[0];

		if(isset($email_filtered[1])){
			$email_suff = $email_filtered[1];
			$this->pdo->exec("use ksm_plexus");
			$stmt = $this->pdo->prepare("SELECT prim_id FROM PM010001 WHERE username_pre = :email_pre AND username_suff = :email_suff");
			$stmt->bindParam(":email_pre",$email_pre,PDO::PARAM_STR);
			$stmt->bindParam(":email_suff",$email_suff,PDO::PARAM_STR);
			$stmt->execute();
			$row_count = $stmt->rowCount();
			if($row_count == 0){
				echo "0";
			}
			else {
				echo "1";
				}
			}
		else {
			echo "Invalid Email";
			}
		}
	}

 ?>
