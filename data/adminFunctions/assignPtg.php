<?php
include_once("../classes/class.proctorFunctions.php");
$post = file_get_contents("php://input");
$entryData = json_decode($post,true);
$staffId = $entryData[1]['staff'];
$date = Date('m-Y');
$students = array();
  foreach ($entryData[0] as $key => $value) {
    if (isset($entryData[0][$key]['selected']) && $entryData[0][$key]['selected'] == true ) {
      $students[$key]['student_key_id'] = $entryData[0][$key]['student_key_id'];
      $students[$key]['sr_no'] = $entryData[0][$key]['sr_no'];
    }
  }

$obj = new proctor();
$obj->savePtgData($students,$staffId,$date);
?>
