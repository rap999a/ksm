<?php
include_once("../classes/class.proctorFunctions.php");
$post = file_get_contents("php://input");
$entryData = json_decode($post,true);
$sendData = array();

foreach ($entryData as $key => $value) {
   if (isset($entryData[$key]['verify']) && $entryData[$key]['verify'][0] == 1) {
     $sendData[$key]['prim_id'] = $entryData[$key]['prim_id'];
     $sendData[$key]['approve'] = 1;
   }
   else {
     $sendData[$key]['prim_id'] = $entryData[$key]['prim_id'];
     $sendData[$key]['approve'] = 0;
   }
}

$obj = new proctor();
$obj->validateStaff($sendData);

?>
