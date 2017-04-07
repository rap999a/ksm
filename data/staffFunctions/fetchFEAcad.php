<?php
include_once("../classes/class.calcData.php");
$post = file_get_contents("php://input");
$entryData = json_decode($post);
$obj = new calcData();
$acad = $obj->fetchFEAcad($entryData);
$attendance = $obj->fetchAttendance($entryData,1,4);
$utperf = $obj->fetchUTperformance($entryData,1,4);
$endsem = array('passed' => 5,'percentage'=>88 );
$prac = array('passed' => 3,'percentage'=>78 );

$class = array();
$class['attendance'] = $attendance;
$class['ut'] = $utperf;
$class['acad'] = $acad;
$class['endsem'] = $endsem;
$class['prac'] = $prac;
echo json_encode($class);
?>
