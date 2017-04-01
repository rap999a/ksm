<?php
include_once("../classes/class.proctorFunctions.php");
$post = file_get_contents("php://input");
$entryData = json_decode($post);
$obj = new proctor();
$class = $obj->getID(2,$entryData);
$data = $obj->fetchPTGs($entryData,$class[0]['prim_id'],$entryData->div);
echo json_encode($data);
?>
