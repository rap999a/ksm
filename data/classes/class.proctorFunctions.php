<?php if(!isset($_SESSION))
    {
        session_start();
    }
include_once('class.dbinfo.php');

/**
* 	Name : Proctor Functions
*	Author :
*	Date : 25/1/2017
*	Version : 1.1
*	Application : ---KSM Phase 1---
*/
/**

*/


class proctor {
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

  public function getID($columns,$entryData){

    if($columns == 2){
      $class = $entryData->class;
      // $class = $entryData['class'];
      $sem = $entryData->sem;
      // $sem = $entryData['sem'];


      $stmt = $this->pdo->prepare("SELECT prim_id FROM PM010004 WHERE class = :class AND sem = :sem");
      $stmt->bindParam(":class",$class,PDO::PARAM_STR);
      $stmt->bindParam(":sem",$sem,PDO::PARAM_STR);
      $stmt->execute();
      $count = $stmt->fetchAll(PDO::FETCH_ASSOC);
      $_SESSION['classID'] = $count[0]['prim_id'];
      return $count;
      }
    if ($columns == 3) {
      $class = $entryData->class;
      // $class = $entryData['class'];
      $sem = $entryData->sem;
      // $sem = $entryData['sem'];
      $ut = $entryData->ut;
      // $ut = $entryData['ut'];

      $stmt = $this->pdo->prepare("SELECT prim_id FROM PM010004 WHERE class = :class AND sem = :sem AND unit_test =:unit_test");
      $stmt->bindParam(":class",$class,PDO::PARAM_STR);
      $stmt->bindParam(":sem",$sem,PDO::PARAM_STR);
      $stmt->bindParam(":unit_test",$ut,PDO::PARAM_STR);
      $stmt->execute();
      $count = $stmt->fetchAll(PDO::FETCH_ASSOC);
      $_SESSION['classID'] = $count[0]['prim_id'];
      return $count[0]['prim_id'];
    }



  }
    public function getCurrentClass($student_id,$class_id){
      $stmt = $this->pdo->prepare("SELECT sr_no FROM PM010011 WHERE student_key_id = :student_id AND class_id = :class_id ");
      $stmt->bindParam(":student_id",$student_id,PDO::PARAM_STR);
      $stmt->bindParam(":class_id",$class_id,PDO::PARAM_STR);
      $stmt->execute();
      $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
      return $data;
    }

    public function fetchPhoto($id){
      $stmt = $this->pdo->prepare("SELECT photo FROM PM010001 WHERE prim_id = :student_id");
      $stmt->bindParam(":student_id",$id,PDO::PARAM_STR);
      $stmt->execute();
      $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
      return $row;
    }

    public function fetchProctorBasic($id){

      $stmt = $this->pdo->prepare("SELECT * FROM PM010002 WHERE sr_no = :student_id");
      $stmt->bindParam(":student_id",$id,PDO::PARAM_STR);
      $stmt->execute();
      $count = $stmt->fetchAll(PDO::FETCH_ASSOC);
      return $count;
    }

    public function fetchProctorRest($id){

      $stmt = $this->pdo->prepare("SELECT * FROM PM010003 WHERE student_key_id = :student_id");
      $stmt->bindParam(":student_id",$id,PDO::PARAM_STR);
      $stmt->execute();
      $count = $stmt->fetchAll(PDO::FETCH_ASSOC);
      return $count;
    }

    public function fetchCurrentClass($id){
      $active = 1;
      $stmt = $this->pdo->prepare("SELECT class_id,division FROM PM010011 WHERE student_key_id = :student_id AND active = :active");
      $stmt->bindParam(":student_id",$id,PDO::PARAM_STR);
      $stmt->bindParam(":active",$active,PDO::PARAM_STR);
      $stmt->execute();
      $count = $stmt->fetchAll(PDO::FETCH_ASSOC);
      return $count;
    }

    public function fetchPrevAcademic($id){
      $stmt = $this->pdo->prepare("SELECT student_id FROM PM010001 WHERE prim_id = :student_id");
      $stmt->bindParam(":student_id",$id,PDO::PARAM_STR);
      $stmt->execute();
      $count = $stmt->fetchAll(PDO::FETCH_ASSOC);

      $stmt = $this->pdo->prepare("SELECT * FROM PM010008 WHERE student_id = :student_id");
      $stmt->bindParam(":student_id",$count[0]['student_id'],PDO::PARAM_STR);
      $stmt->execute();
      $count = $stmt->fetchAll(PDO::FETCH_ASSOC);
      return $count;
    }

    public function fetchCertificates($classId){

      $stmt = $this->pdo->prepare("SELECT * FROM PM010015 WHERE student_id = :student_id AND class_id = :class_id");
      $stmt->bindParam(":student_id",$_SESSION['user_plexus_id'],PDO::PARAM_STR);
      $stmt->bindParam(":class_id",$classId,PDO::PARAM_STR);
      $stmt->execute();
      $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
      return $data;
    }
    public function fetchCertificatesForValidation($studentID){
      $approve = 0;
      $stmt = $this->pdo->prepare("SELECT * FROM PM010015 WHERE student_id = :student_id AND approval = :notApproved");
      $stmt->bindParam(":student_id",$studentID,PDO::PARAM_STR);
      $stmt->bindParam(":notApproved",$approve,PDO::PARAM_STR);
      $stmt->execute();
      $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
      return $data;
    }
    public function validateCertificate($data){
      $approve = 1;
      foreach ($data as $key => $value) {
        if (isset($data[$key]['approval']) && $data[$key]['approval'] == true ) {
          $stmt = $this->pdo->prepare("UPDATE PM010015 SET approval = :approve WHERE sr_no = :id");
          $stmt->bindParam(":approve",$approve,PDO::PARAM_STR);
          $stmt->bindParam(":id",$data[$key]['id'],PDO::PARAM_STR);
          $stmt->execute();
        }
      }
    }

    public function fetchAllAttendance(){
      $stmt = $this->pdo->prepare("SELECT * FROM PM010007 WHERE student_id = :student_id");
      $stmt->bindParam(":student_id",$_SESSION['studentId'],PDO::PARAM_STR);
      $stmt->execute();
      $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
      return $data;
    }
    public function fetchAllUnit(){
      $stmt = $this->pdo->prepare("SELECT * FROM PM010005 WHERE student_id = :student_id");
      $stmt->bindParam(":student_id",$_SESSION['studentId'],PDO::PARAM_STR);
      $stmt->execute();
      $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
      return $data;
    }
    public function fetchAllResearch(){
      $stmt = $this->pdo->prepare("SELECT * FROM PM010019 WHERE student_id = :student_id");
      $stmt->bindParam(":student_id",$_SESSION['user_plexus_id'],PDO::PARAM_STR);
      $stmt->execute();
      $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
      return $data;
    }
    public function fetchAllSelfDev(){
      $stmt = $this->pdo->prepare("SELECT * FROM PM010018 WHERE student_id = :student_id");
      $stmt->bindParam(":student_id",$_SESSION['user_plexus_id'],PDO::PARAM_STR);
      $stmt->execute();
      $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
      return $data;
    }
    public function fetchExtraCurricularData(){
      $stmt = $this->pdo->prepare("SELECT * FROM PM010017 WHERE student_id = :student_id");
      $stmt->bindParam(":student_id",$_SESSION['user_plexus_id'],PDO::PARAM_STR);
      $stmt->execute();
      $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
      return $data;
    }

    public function checkEntry($table,$classId){
      $stmt = $this->pdo->prepare("SELECT prim_id,approved FROM ".$table." WHERE class_id = :class_id");
      $stmt->bindParam(":class_id",$classId,PDO::PARAM_STR);
      $stmt->execute();
      $dbData = $stmt->fetchAll(PDO::FETCH_ASSOC);
      $count = $stmt->rowCount();
      if ($count == 1) {
        $_SESSION['approved'] = $dbData[0]['approved'];
      }
      echo json_encode($count);
    }

    public function checkEntryUT($table,$classId){
      $stmt = $this->pdo->prepare("SELECT prim_id,approved FROM ".$table." WHERE class_id = :class_id AND student_id = :student_id");
      $stmt->bindParam(":class_id",$classId,PDO::PARAM_STR);
      $stmt->bindParam(":student_id",$_SESSION['studentId'],PDO::PARAM_STR);
      $stmt->execute();
      $dbData = $stmt->fetchAll(PDO::FETCH_ASSOC);
      $count = $stmt->rowCount();
      if ($count == 1) {
        $_SESSION['approved'] = $dbData[0]['approved'];
      }
      echo json_encode($count);
    }


    public function checkEntryAttendance($table,$classId){
      $fnight = "f_".$classId[0]['fortnight'];
      $null = 0;
      $stmt = $this->pdo->prepare("SELECT prim_id,approved,".$fnight." FROM ".$table." WHERE class_id = :class_id");
      $stmt->bindParam(":class_id",$classId[0]['prim_id'],PDO::PARAM_STR);
      $stmt->execute();
      $dbData = $stmt->fetchAll(PDO::FETCH_ASSOC);
      $count = $stmt->rowCount();
      if ($count == 1) {
        $_SESSION['approved'] = $dbData[0]['approved'];
        if ($dbData[0][$fnight] == 0) {
          echo json_encode(0);
          $_SESSION['fnight_column'] = $fnight;
          $_SESSION['fnight_count'] = $count;
        }
        else {
          $_SESSION['fnight_column'] = $fnight;
          $_SESSION['fnight_count'] = $count;
          echo json_encode($count);
        }
      }
      else{
        $_SESSION['fnight_column'] = $fnight;
        $_SESSION['fnight_count'] = $count;
        echo json_encode($count);
      }
    }
    public function saveResearchData($data,$types,$choice,$classID){
      $type = $types['type'];
      $subtype = $types['subtype'];
      $choice = $choice['choice'];
      foreach ($data as $key => $value) {
        $stmt = $this->pdo->prepare("INSERT INTO PM010019 (student_id,class_id,research_type,research_sub_type,name,details,answer) VALUES (:student_id,:class_id,:research_type,:research_sub_type,:name,:details,:answer)");
        $stmt->bindParam(":student_id",$_SESSION['user_plexus_id'],PDO::PARAM_STR);
        $stmt->bindParam(":class_id",$classID,PDO::PARAM_STR);
        $stmt->bindParam(":research_type",$type,PDO::PARAM_STR);
        $stmt->bindParam(":research_sub_type",$subtype,PDO::PARAM_STR);
        $stmt->bindParam(":name",$data[$key]['name'],PDO::PARAM_STR);
        $stmt->bindParam(":details",$data[$key]['details'],PDO::PARAM_STR);
        $stmt->bindParam(":answer",$choice,PDO::PARAM_STR);
        $stmt->execute();

      }
      echo "";
    }
    public function saveExtraCurricularData($data,$types,$choice,$classID){
      $type = $types['type'];
      $subtype = $types['subtype'];
      $choice = $choice['choice'];
      foreach ($data as $key => $value) {
        $stmt = $this->pdo->prepare("INSERT INTO PM010017 (student_id,class_id,activity_type,act_sub_type,name,details,answer) VALUES (:student_id,:class_id,:activity_type,:act_sub_type,:name,:details,:answer)");
        $stmt->bindParam(":student_id",$_SESSION['user_plexus_id'],PDO::PARAM_STR);
        $stmt->bindParam(":class_id",$classID,PDO::PARAM_STR);
        $stmt->bindParam(":activity_type",$type,PDO::PARAM_STR);
        $stmt->bindParam(":act_sub_type",$subtype,PDO::PARAM_STR);
        $stmt->bindParam(":name",$data[$key]['name'],PDO::PARAM_STR);
        $stmt->bindParam(":details",$data[$key]['details'],PDO::PARAM_STR);
        $stmt->bindParam(":answer",$choice,PDO::PARAM_STR);
        $stmt->execute();

      }
      echo "";
    }
    public function saveSelfDevData($data,$types,$classID){
      $type = $types['type'];

        $stmt = $this->pdo->prepare("INSERT INTO PM010018 (student_id,class_id,improve_type,name,details,duration,answer) VALUES (:student_id,:class_id,:improve_type,:name,:details,:duration,:answer)");
        $stmt->bindParam(":student_id",$_SESSION['user_plexus_id'],PDO::PARAM_STR);
        $stmt->bindParam(":class_id",$classID,PDO::PARAM_STR);
        $stmt->bindParam(":improve_type",$type,PDO::PARAM_STR);
        $stmt->bindParam(":name",$data['name'],PDO::PARAM_STR);
        $stmt->bindParam(":details",$data['details'],PDO::PARAM_STR);
        $stmt->bindParam(":duration",$data['duration'],PDO::PARAM_STR);
        $stmt->bindParam(":answer",$data['choice'],PDO::PARAM_STR);
        $stmt->execute();


      echo "";
    }

    public function saveExtraEfforts($data,$classID){
    $arr = array();
    foreach ($data as $key => $value) {
        if ($data[$key]['type']==8 || $data[$key]['activity'] == 8 || $data[$key]['activity'] == 7 || $data[$key]['activity'] == 4) {
          $type = "8";
          $specs = $data[$key]['specs'];
        }
        else {
          $type = $data[$key]['type'];
          $specs = "0";
        }
        $stmt = $this->pdo->prepare("INSERT INTO PM010015 (student_id,class_id,type_of_activity,activity,specs,details_performance) VALUES (:student_id,:class_id,:type_of_activity,:activity,:specs,:details_performance)");
        $stmt->bindParam(":student_id",$_SESSION['user_plexus_id'],PDO::PARAM_STR);
        $stmt->bindParam(":class_id",$classID,PDO::PARAM_STR);
        $stmt->bindParam(":type_of_activity",$data[$key]['activity'],PDO::PARAM_STR);
        $stmt->bindParam(":activity",$type,PDO::PARAM_STR);
        $stmt->bindParam(":specs",$specs,PDO::PARAM_STR);
        $stmt->bindParam(":details_performance",$data[$key]['perform'],PDO::PARAM_STR);
        $stmt->execute();
      }
      echo json_encode($arr);
    }

    public function saveCurrentClass($data,$classID){
      $activate = 1;
      $deactivate = 0;
      $stmt = $this->pdo->prepare("UPDATE PM010011 SET active = :active WHERE student_key_id = :student_key_id");
      $stmt->bindParam(":student_key_id",$_SESSION['user_plexus_id'],PDO::PARAM_STR);
      $stmt->bindParam(":active",$deactivate,PDO::PARAM_STR);
      $stmt->execute();

      $stmt = $this->pdo->prepare("INSERT INTO PM010011 (student_key_id,class_id,division,active) VALUES (:student_key_id,:class_id,:division,:active)");
      $stmt->bindParam(":student_key_id",$_SESSION['user_plexus_id'],PDO::PARAM_STR);
      $stmt->bindParam(":class_id",$classID,PDO::PARAM_STR);
      $stmt->bindParam(":division",$data->div,PDO::PARAM_STR);
      $stmt->bindParam(":active",$activate,PDO::PARAM_STR);
      $stmt->execute();
      echo " ";
    }
    public function storeAttendanceData($data){
      if ($_SESSION['fnight_count'] == 0) {
        $stmt = $this->pdo->prepare("INSERT INTO PM010007 (student_id,class_id,".$_SESSION['fnight_column'].") VALUES (:student_id,:class,:f_no)");
        $stmt->bindParam(":student_id",$_SESSION['studentId'],PDO::PARAM_STR);
        $stmt->bindParam(":class",$_SESSION['classID'],PDO::PARAM_STR);
        $stmt->bindParam(":f_no",$data->attendance,PDO::PARAM_STR);
        $stmt->execute();
      }
      else {
        if (!isset($data->attendancePercentage)){
          $attendance = " ";
        }
        else{
          $attendance = $data->attendancePercentage;
        }
        $stmt = $this->pdo->prepare("UPDATE PM010007 SET ".$_SESSION['fnight_column']." =:attendance AND attendance_percentage = :attendance_percentage WHERE student_id = :student_id AND class_id = :class");
        $stmt->bindParam(":student_id",$_SESSION['studentId'],PDO::PARAM_STR);
        $stmt->bindParam(":class",$_SESSION['classID'],PDO::PARAM_STR);
        $stmt->bindParam(":attendance",$data->attendance,PDO::PARAM_STR);
        $stmt->bindParam(":attendance_percentage",$attendance,PDO::PARAM_STR);
        $stmt->execute();
      }

    }

    public function fetchUnvalidatedStaff(){
      $account_type = 1;
      $approve = 0;
      $stmt = $this->pdo->prepare("SELECT * FROM PM010001 WHERE account_type = :account_type AND approve = :approve");
      $stmt->bindParam(":account_type",$account_type,PDO::PARAM_STR);
      $stmt->bindParam(":approve",$approve,PDO::PARAM_STR);
      $stmt->execute();
      $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
      echo json_encode($data);
    }

    public function validateStaff($data){
      if (isset($data)) {
        foreach ($data as $key => $value) {
          $stmt = $this->pdo->prepare("UPDATE PM010001 SET approve = :approve WHERE prim_id = :prim_id");
          $stmt->bindParam(":approve",$data[$key]['approve'],PDO::PARAM_STR);
          $stmt->bindParam(":prim_id",$data[$key]['prim_id'],PDO::PARAM_STR);
          $stmt->execute();
        }
      }
    }

    public function savePtgData($students,$staff,$date){
      if (isset($students)){
        foreach ($students as $key => $value) {
          $stmt = $this->pdo->prepare("INSERT INTO PM010012 (student_id,staff_key_id,current_class,year) VALUES (:student_id,:staff_key_id,:current_class,:year)");
          $stmt->bindParam(":student_id",$students[$key]['student_key_id'],PDO::PARAM_STR);
          $stmt->bindParam(":staff_key_id",$staff,PDO::PARAM_STR);
          $stmt->bindParam(":current_class",$students[$key]['sr_no'],PDO::PARAM_STR); // This is the primary key of 011 check 'fetchStudent' function below
          $stmt->bindParam(":year",$date,PDO::PARAM_STR);
          $stmt->execute();
          echo "b";
        }
      }
    }

    public function fetchStaff($department){
      $account_type = 1;
      $stmt = $this->pdo->prepare("SELECT PM010001.f_name,PM010001.l_name,PM010001.prim_id,PM010002.branch FROM PM010001 INNER JOIN PM010002 ON PM010001.prim_id = PM010002.sr_no WHERE PM010001.account_type = :account_type AND PM010002.branch = :branch");
      $stmt->bindParam(":account_type",$account_type,PDO::PARAM_STR);
      $stmt->bindParam(":branch",$department,PDO::PARAM_STR);
      $stmt->execute();
      $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
      return $data;
    }
    public function fetchStudent($class,$department,$division){
      $account_type = 1;
      $stmt = $this->pdo->prepare("SELECT PM010002.firstname,PM010002.lastname,PM010002.branch,PM010011.sr_no,PM010011.student_key_id FROM PM010002 INNER JOIN PM010011 ON PM010002.sr_no = PM010011.student_key_id WHERE PM010011.active = :active AND PM010002.branch = :branch AND class_id = :class AND division = :div");
      $stmt->bindParam(":active",$account_type,PDO::PARAM_STR);
      $stmt->bindParam(":branch",$department,PDO::PARAM_STR);
      $stmt->bindParam(":class",$class,PDO::PARAM_STR);
      $stmt->bindParam(":div",$division,PDO::PARAM_STR);
      $stmt->execute();
      $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
      return $data;
    }
    public function fetchPTGs($data,$class,$division){
      $account_type = 1;
      $stmt = $this->pdo->prepare("SELECT DISTINCT PM010002.firstname,PM010002.lastname,PM010002.sr_no FROM PM010002 INNER JOIN PM010012 ON PM010012.staff_key_id = PM010002.sr_no INNER JOIN PM010011 ON PM010012.current_class = PM010011.sr_no WHERE PM010011.active = :active AND PM010002.branch = :branch AND PM010011.class_id = :class_id AND PM010011.division = :division");
      $stmt->bindParam(":active",$account_type,PDO::PARAM_STR);
      $stmt->bindParam(":branch",$data->branch,PDO::PARAM_STR);
      $stmt->bindParam(":class_id",$class,PDO::PARAM_STR);
      $stmt->bindParam(":division",$division,PDO::PARAM_STR);
      $stmt->execute();
      $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
      return $data;
    }
    public function fetchPTG($data,$class){
      $account_type = 1;
      foreach ($class as $key => $value) {
        $stmt = $this->pdo->prepare("SELECT PM010002.firstname,PM010002.lastname,PM010002.phone,PM010002.email FROM PM010002 INNER JOIN PM010012 ON PM010012.staff_key_id = PM010002.sr_no WHERE PM010012.student_id = :student_id AND PM010012.current_class = :class");
        $stmt->bindParam(":student_id",$data->sr_no,PDO::PARAM_STR);
        $stmt->bindParam(":class",$class[$key]['sr_no'],PDO::PARAM_STR);
        $stmt->execute();
      }

      $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
      return $data;
    }
    public function savecriticalAnalysisData($data,$studentID,$class,$month){
      foreach ($data as $key => $value) {
        $stmt = $this->pdo->prepare("INSERT INTO PM010014 (student_id,staff_id,month,class_id,type,feedback) VALUES (:student_id,:staff_id,:month,:class_id,:type,:feedback)");
        $stmt->bindParam(":student_id",$studentID,PDO::PARAM_STR);
        $stmt->bindParam(":staff_id",$_SESSION['user_plexus_id'],PDO::PARAM_STR);
        $stmt->bindParam(":month",$month,PDO::PARAM_STR);
        $stmt->bindParam(":class_id",$class,PDO::PARAM_STR);
        $stmt->bindParam(":type",$data[$key]['type'],PDO::PARAM_STR);
        $stmt->bindParam(":feedback",$data[$key]['measures'],PDO::PARAM_STR);
        $stmt->execute();
      }
    }
    public function saveMeetingData($data,$studentID,$class,$date,$month){
      foreach ($data as $key => $value) {
        $receivedMonth = explode("-",$data[$key]['dom']);
        if ($data[$key]['dom'] >= $date && (($receivedMonth[1] > 0 && $receivedMonth < 4) || ($receivedMonth[1] > 7 && $receivedMonth < 10))) {
          $stmt = $this->pdo->prepare("INSERT INTO PM010013 (student_id,staff_id,current_class,date,month,discussion,remarks) VALUES (:student_id,:staff_id,current_class,:date,:month,:discussion,:remarks)");
          $stmt->bindParam(":student_id",$studentID,PDO::PARAM_STR);
          $stmt->bindParam(":staff_id",$_SESSION['user_plexus_id'],PDO::PARAM_STR);
          $stmt->bindParam(":current_class",$class,PDO::PARAM_STR);
          $stmt->bindParam(":date",$data[$key]['dom'],PDO::PARAM_STR);
          $stmt->bindParam(":month",$date,PDO::PARAM_STR);
          $stmt->bindParam(":discussion",$data[$key]['meetingDetails'],PDO::PARAM_STR);
          $stmt->bindParam(":remarks",$data[$key]['remarks'],PDO::PARAM_STR);
          $stmt->execute();
        }
        else {
          echo "0";
        }
      }
    }
    public function fetchMyPTG(){
      $stmt = $this->pdo->prepare("SELECT PM010002.firstname,PM010002.lastname,PM010002.designation,PM010002.branch,PM010002.email,PM010002.phone FROM PM010002 INNER JOIN PM010012 ON PM010012.staff_key_id = PM010002.sr_no WHERE PM010012.student_id = :student_id");
      $stmt->bindParam(":student_id",$_SESSION['user_plexus_id'],PDO::PARAM_STR);
      $stmt->execute();
      $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
      return $data;
    }
    public function fetchStudentOfPTG($data){
      $stmt = $this->pdo->prepare("SELECT PM010002.firstname,PM010002.lastname,PM010012.sr_no FROM PM010002 INNER JOIN PM010012 ON PM010012.student_id = PM010002.sr_no WHERE PM010012.staff_key_id = :id");
      $stmt->bindParam(":id",$data->id,PDO::PARAM_STR);
      $stmt->execute();
      $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
      return $data;
    }
    public function fetchMyStudents(){
      $stmt = $this->pdo->prepare("SELECT PM010002.firstname,PM010002.lastname,PM010012.student_id,PM010012.current_class,PM010002.studentID,PM010002.email FROM PM010002 INNER JOIN PM010012 ON PM010012.student_id = PM010002.sr_no WHERE PM010012.staff_key_id = :id");
      $stmt->bindParam(":id",$_SESSION['user_plexus_id'],PDO::PARAM_STR);
      $stmt->execute();
      $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
      return $data;
    }

    public function deleteStudent($data){
      $stmt = $this->pdo->prepare("DELETE FROM PM010012 WHERE sr_no = :sr_no ");
      $stmt->bindParam(":sr_no",$data->sr_no,PDO::PARAM_STR);
      $stmt->execute();
    }

    public function storeUTData($approvalFlag,$data){

      if ($approvalFlag == 0) {
        $stmt = $this->pdo->prepare("INSERT INTO PM010005 (student_id,class_id,total_sub,appeared,passed,failed) VALUES (:student_id,:class_id,:total_sub,:appeared,:passed,:failed)");
        $stmt->bindParam(":student_id",$_SESSION['studentId'],PDO::PARAM_STR);
        $stmt->bindParam(":class_id",$_SESSION['classID'],PDO::PARAM_STR);
        $stmt->bindParam(":total_sub",$data->subjects,PDO::PARAM_STR);
        $stmt->bindParam(":appeared",$data->appeared,PDO::PARAM_STR);
        $stmt->bindParam(":passed",$data->passed,PDO::PARAM_STR);
        $stmt->bindParam(":failed",$data->failed,PDO::PARAM_STR);
        $stmt->execute();
        echo " ";
      }
      else if($approvalFlag == 2){
        $stmt = $this->pdo->prepare("UPDATE PM010005 SET total_sub = :total_sub ,appeared = :appeared,passed = :appeared ,passed = :passed AND failed = :failed WHERE student_id = :student_id AND class_id = :class_id");
        $stmt->bindParam(":total_sub",$data->subjects,PDO::PARAM_STR);
        $stmt->bindParam(":appeared",$data->appeared,PDO::PARAM_STR);
        $stmt->bindParam(":passed",$data->passed,PDO::PARAM_STR);
        $stmt->bindParam(":failed",$data->failed,PDO::PARAM_STR);
        $stmt->bindParam(":student_id",$_SESSION['student_id'],PDO::PARAM_STR);
        $stmt->bindParam(":class_id",$_SESSION['classID'],PDO::PARAM_STR);
        $stmt->execute();
        echo " ";
      }
    }

    public function checkAcademicData(){

      $stmt = $this->pdo->prepare("SELECT * FROM PM010008 WHERE student_id = :student_id");
      $stmt->bindParam(":student_id",$_SESSION['studentId'],PDO::PARAM_STR);
      $stmt->execute();
      $count = $stmt->rowCount();
      echo json_encode($count);
    }

    public function submitAcademicInfo($data){
      $ssc = 1;
      $hsc = 2;
      $stmt = $this->pdo->prepare("INSERT INTO PM010008 (student_id,class,yop,institute,percentage,subjects,achievements,problems) VALUES (:student_id,:class,:yop,:institute,:percentage,:subjects,:achievements,:problems)");
      $stmt->bindParam(":student_id",$_SESSION['studentId'],PDO::PARAM_STR);
      $stmt->bindParam(":class",$ssc,PDO::PARAM_STR);
      $stmt->bindParam(":yop",$data->yop,PDO::PARAM_STR);
      $stmt->bindParam(":institute",$data->institute,PDO::PARAM_STR);
      $stmt->bindParam(":percentage",$data->percentage,PDO::PARAM_STR);
      $stmt->bindParam(":subjects",$data->subjects,PDO::PARAM_STR);
      $stmt->bindParam(":achievements",$data->achievements,PDO::PARAM_STR);
      $stmt->bindParam(":problems",$data->problems,PDO::PARAM_STR);
      $stmt->execute();

      $stmt = $this->pdo->prepare("INSERT INTO PM010008 (student_id,class,yop,institute,percentage,subjects,achievements,problems) VALUES (:student_id,:class,:yop,:institute,:percentage,:subjects,:achievements,:problems)");
      $stmt->bindParam(":student_id",$_SESSION['studentId'],PDO::PARAM_STR);
      $stmt->bindParam(":class",$hsc,PDO::PARAM_STR);
      $stmt->bindParam(":yop",$data->yop1,PDO::PARAM_STR);
      $stmt->bindParam(":institute",$data->institute1,PDO::PARAM_STR);
      $stmt->bindParam(":percentage",$data->percentage1,PDO::PARAM_STR);
      $stmt->bindParam(":subjects",$data->subjects1,PDO::PARAM_STR);
      $stmt->bindParam(":achievements",$data->achievements1,PDO::PARAM_STR);
      $stmt->bindParam(":problems",$data->problems1,PDO::PARAM_STR);
      $stmt->execute();

      echo "";

    }
    public function storeUnivData($data){

      $count = sizeof($data);

      for ($i=0; $i < $count ; $i++) {
        if ($data[$i]->name->result == 1) {
          $data[$i]->name->subjects = 0;
        }
        $stmt = $this->pdo->prepare("INSERT INTO PM010010 (student_id,exam,mAndy,seat_no,result,no_of_subjects,reason,suggestion,aggregate) VALUES (:student_id,:exam,:mAndy,:seat_no,:result,:no_of_subjects,:reason,:suggestion,:aggregate)");
        $stmt->bindParam(":student_id",$_SESSION['studentId'],PDO::PARAM_STR);
        $stmt->bindParam(":exam",$data[$i]->name->exam,PDO::PARAM_STR);
        $stmt->bindParam(":mAndy",$data[$i]->name->mAndy,PDO::PARAM_STR);
        $stmt->bindParam(":seat_no",$data[$i]->name->seat,PDO::PARAM_STR);
        $stmt->bindParam(":result",$data[$i]->name->result,PDO::PARAM_STR);
        $stmt->bindParam(":no_of_subjects",$data[$i]->name->subjects,PDO::PARAM_STR);
        $stmt->bindParam(":reason",$data[$i]->name->reason,PDO::PARAM_STR);
        $stmt->bindParam(":suggestion",$data[$i]->name->suggestion,PDO::PARAM_STR);
        $stmt->bindParam(":aggregate",$data[$i]->name->agg,PDO::PARAM_STR);
        $stmt->execute();
      }

    }

}

?>
