<?php
include_once("../classes/class.proctorFunctions.php");
$post = file_get_contents("php://input");
$entryData = json_decode($post,true);
$studentData = explode("@",$entryData['student']);
$studentID = $studentData[0];
$studentclass = $studentData[1];
$obj = new proctor();
$data = $obj->fetchCertificatesForValidation($studentID);
$cert = [];
$type = array(array("Workshop","Seminar","Project","Paper Presentation",0,0,0,"Other"),
          array("Sports","Gathering","Art Circle","Technical Events","Other"),
          array("Technical","Foreign Language","Softskills","Aptitiude","Stress Management Courses","Other"),
          "Certifications",
          array("Industrial","Sabbatical","Project Work","Workshops","Others"),
          array("GATE","GRE","CAT","TOEFL","GMAT","Others"),
          "Placements",
          "Others");
 $activity = array("Co-curricular","Extra-curricular","Add-on","Certifications","Training","Entrance Examinations","Placements","Others");

          foreach ($data as $key => $value) {
            if ($data[$key]['type_of_activity'] == 4) {
              $cert[$key]['name'] = $activity[3];
              $cert[$key]['id'] = $data[$key]['sr_no'];
              $cert[$key]['activity'] = $data[$key]['specs'];
              $cert[$key]['details'] = $data[$key]['details_performance'];
              $cert[$key]['image'] = $data[$key]['image'];
            }
            elseif ($data[$key]['type_of_activity'] == 7) {
              $cert[$key]['name'] = $activity[6];
              $cert[$key]['id'] = $data[$key]['sr_no'];
              $cert[$key]['activity'] = $data[$key]['specs'];
              $cert[$key]['details'] = $data[$key]['details_performance'];
              $cert[$key]['image'] = $data[$key]['image'];

            }
            elseif ($data[$key]['type_of_activity'] == 8) {
              $cert[$key]['name'] = $activity[7];
              $cert[$key]['id'] = $data[$key]['sr_no'];
              $cert[$key]['activity'] = $data[$key]['specs'];
              $cert[$key]['details'] = $data[$key]['details_performance'];
              $cert[$key]['image'] = $data[$key]['image'];

            }
            else {
              $cert[$key]['name'] = $activity[$data[$key]['type_of_activity']-1];
              if($data[$key]['activity'] == 8){
                  $cert[$key]['activity'] = $data[$key]['specs'];
                  $cert[$key]['image'] = $data[$key]['image'];

              }
              else{
                  $cert[$key]['activity'] = $type[$data[$key]['type_of_activity']-1][$data[$key]['activity']-1];
                  $cert[$key]['image'] = $data[$key]['image'];

              }
              $cert[$key]['id'] = $data[$key]['sr_no'];
              $cert[$key]['details'] = $data[$key]['details_performance'];
              $cert[$key]['image'] = $data[$key]['image'];
              

            }
          }
echo json_encode($cert);
?>
