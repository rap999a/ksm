<?php
include_once("../classes/class.proctorFunctions.php");
include_once("../classes/class.users.php");
$obj1 = new users();
$class = $obj1->fetchCurrentClass();
$marks_total = 0;
$obj = new proctor();
$allAttendance = $obj->fetchAllAttendance();
$allUnitTest = $obj->fetchAllUnit();
$allResearchData = $obj->fetchAllResearch();
$allSelfDevData = $obj->fetchAllSelfDev();
$ExtraCurricularData = $obj->fetchExtraCurricularData();

$fecontinuous = 0;
$secontinuous = 0;
$tecontinuous = 0;
$becontinuous = 0;

$feacad = 18;
$seacad = 18;
$teacad = 18;
$beacad = 18;

$feAttendance = ($allAttendance[0]['attendance_percentage'] + $allAttendance[1]['attendance_percentage'])/2;
$seAttendance = ($allAttendance[2]['attendance_percentage'] + $allAttendance[3]['attendance_percentage'])/2;
$teAttendance = ($allAttendance[4]['attendance_percentage'] + $allAttendance[5]['attendance_percentage'])/2;
$beAttendance = ($allAttendance[6]['attendance_percentage'] + $allAttendance[7]['attendance_percentage'])/2;

  $feUnitTest = ($allUnitTest[0]['percentage'] + $allUnitTest[1]['percentage'] + $allUnitTest[2]['percentage'] + $allUnitTest[3]['percentage'])/4;

  $seUnitTest = ($allUnitTest[4]['percentage'] + $allUnitTest[5]['percentage'] + $allUnitTest[6]['percentage'] + $allUnitTest[7]['percentage'])/4;

  $teUnitTest = ($allUnitTest[8]['percentage'] + $allUnitTest[9]['percentage'] + $allUnitTest[10]['percentage'] + $allUnitTest[11]['percentage'])/4;

  $beUnitTest = ($allUnitTest[12]['percentage'] + $allUnitTest[13]['percentage'] + $allUnitTest[14]['percentage'] + $allUnitTest[15]['percentage'])/4;

  $fePracPerf = 491;
  $feese = 100;
  $seese = 100;
  $teese = 100;
  $beese = 100;

  if ($feAttendance > 74 && $feAttendance < 86  ) {
    $marks_total += 3;
    $fecontinuous += 3;
  }
  else if ($feAttendance > 84 && $feAttendance < 91) {
    $marks_total += 5;
    $fecontinuous += 5;

  }
  else if ($feAttendance > 90 && $feAttendance < 96) {
    $marks_total += 7;
    $fecontinuous +=7;
  }
  else if ($feAttendance > 94 && $feAttendance < 101) {
    $marks_total += 10;
    $fecontinuous += 10;
  }
  else {
    $marks_total += 0;

  }

  if ($seAttendance > 74 && $seAttendance < 86  ) {
    $marks_total += 3;
    $secontinuous += 3;
  }
  else if ($seAttendance > 84 && $seAttendance < 91) {
    $marks_total += 5;
    $secontinuous += 5;

  }
  else if ($seAttendance > 90 && $seAttendance < 96) {
    $marks_total += 7;
    $secontinuous += 7;

  }
  else if ($seAttendance > 94 && $seAttendance < 101) {
    $marks_total += 10;
    $secontinuous += 10;

  }
  else {
    $marks_total += 0;

  }

  if ($teAttendance > 74 && $teAttendance < 86  ) {
    $marks_total += 3;
    $tecontinuous += 3;
  }
  else if ($teAttendance > 84 && $teAttendance < 91) {
    $marks_total += 5;
    $tecontinuous += 5;

  }
  else if ($teAttendance > 90 && $teAttendance < 96) {
    $tecontinuous += 7;
    $marks_total += 7;

  }
  else if ($teAttendance > 94 && $teAttendance < 101) {
    $marks_total += 10;
    $tecontinuous += 10;

  }
  else {
    $marks_total += 0;

  }

  if ($beAttendance > 74 && $beAttendance < 86  ) {
    $marks_total += 3;
    $becontinuous += 3;
  }
  else if ($beAttendance > 84 && $beAttendance < 91) {
    $marks_total += 5;
    $becontinuous += 5;

  }
  else if ($beAttendance > 90 && $beAttendance < 96) {
    $marks_total += 7;
    $becontinuous += 7;

  }
  else if ($beAttendance > 94 && $beAttendance < 101) {
    $marks_total += 10;
    $becontinuous += 10;

  }
  else {
    $marks_total += 0;

  }


  if ($feUnitTest > 50 && $feUnitTest < 61  ) {
    $marks_total += 3;
    $fecontinuous += 3;
  }
  else if ($feUnitTest > 60 && $feUnitTest < 71) {
    $marks_total += 5;
    $fecontinuous += 5;

  }
  else if ($feUnitTest > 70 && $feUnitTest < 91) {
    $marks_total += 7;
    $fecontinuous += 7;

  }
  else if ($feUnitTest > 90 && $feUnitTest < 101) {
    $marks_total += 10;
    $fecontinuous += 10;

  }
  else {
    $marks_total += 0;

  }

  if ($seUnitTest > 50 && $seUnitTest < 61  ) {
    $marks_total += 3;
    $secontinuous += 3;
  }
  else if ($seUnitTest > 60 && $seUnitTest < 71) {
    $marks_total += 5;
    $secontinuous += 5;

  }
  else if ($seUnitTest > 70 && $seUnitTest < 91) {
    $marks_total += 7;
    $secontinuous += 7;

  }
  else if ($seUnitTest > 90 && $seUnitTest < 101) {
    $marks_total += 10;
    $secontinuous += 10;

  }
  else {
    $marks_total += 0;

  }

  if ($teUnitTest > 50 && $teUnitTest < 61  ) {
    $marks_total += 3;
    $tecontinuous += 3;
  }
  else if ($teUnitTest > 60 && $teUnitTest < 71) {
    $marks_total += 5;
    $tecontinuous += 5;

  }
  else if ($teUnitTest > 70 && $teUnitTest < 91) {
    $marks_total += 7;
    $tecontinuous += 7;

  }
  else if ($teUnitTest > 90 && $teUnitTest < 101) {
    $marks_total += 10;
    $tecontinuous += 10;

  }
  else {
    $marks_total += 0;

  }

  if ($beUnitTest > 50 && $beUnitTest <= 60  ) {
    $marks_total += 3;
    $becontinuous += 3;
  }
  else if ($beUnitTest > 60 && $beUnitTest <= 70) {
    $marks_total += 5;
    $becontinuous += 5;

  }
  else if ($beUnitTest > 70 && $beUnitTest <= 90) {
    $marks_total += 7;
    $becontinuous += 7;


  }
  else if ($beUnitTest > 90 && $beUnitTest < 101) {
    $marks_total += 10;
    $becontinuous += 10;

  }
  else {
    $marks_total += 0;

  }
   $marks_total += $fePracPerf;
   $feresearchMarks = 0;
   $seresearchMarks = 0;
   $teresearchMarks = 0;
   $beresearchMarks = 0;
   $researchMarks = 0;
   foreach ($allResearchData as $key => $value) {
     if ($allResearchData[$key]['class_id'] == 1 || $allResearchData[$key]['class_id'] == 3 && $allResearchData[$key]['answer'] == 1) {

       if ($allResearchData[$key]['research_type'].$allResearchData[$key]['research_sub_type'] == 11) {
         $feresearchMarks += 10;
       }
       else if ($allResearchData[$key]['research_type'].$allResearchData[$key]['research_sub_type'] == 12) {
         $feresearchMarks += 7;

       }
       if ($allResearchData[$key]['research_type'].$allResearchData[$key]['research_sub_type'] == 13) {
         $feresearchMarks += 10;

       }
       if ($allResearchData[$key]['research_type'].$allResearchData[$key]['research_sub_type'] == 14) {
         $feresearchMarks += 7;

       }
       if ($allResearchData[$key]['research_type'].$allResearchData[$key]['research_sub_type'] == 21) {
         $feresearchMarks += 10;

       }
       if ($allResearchData[$key]['research_type'].$allResearchData[$key]['research_sub_type'] == 31) {
         $feresearchMarks += 8;

       }
       if ($allResearchData[$key]['research_type'].$allResearchData[$key]['research_sub_type'] == 32) {
         $feresearchMarks += 6;

       }
       if ($allResearchData[$key]['research_type'].$allResearchData[$key]['research_sub_type'] == 33) {
         $feresearchMarks += 4;

       }

     }


     if ($allResearchData[$key]['class_id'] == 5 || $allResearchData[$key]['class_id'] == 7 && $allResearchData[$key]['answer'] == 1) {

       if ($allResearchData[$key]['research_type'].$allResearchData[$key]['research_sub_type'] == 11) {
         $seresearchMarks += 10;
       }
       else if ($allResearchData[$key]['research_type'].$allResearchData[$key]['research_sub_type'] == 12) {
         $seresearchMarks += 7;

       }
       if ($allResearchData[$key]['research_type'].$allResearchData[$key]['research_sub_type'] == 13) {
         $seresearchMarks += 10;

       }
       if ($allResearchData[$key]['research_type'].$allResearchData[$key]['research_sub_type'] == 14) {
         $seresearchMarks += 7;

       }
       if ($allResearchData[$key]['research_type'].$allResearchData[$key]['research_sub_type'] == 21) {
         $seresearchMarks += 10;

       }
       if ($allResearchData[$key]['research_type'].$allResearchData[$key]['research_sub_type'] == 31) {
         $seresearchMarks += 8;

       }
       if ($allResearchData[$key]['research_type'].$allResearchData[$key]['research_sub_type'] == 32) {
         $seresearchMarks += 6;

       }
       if ($allResearchData[$key]['research_type'].$allResearchData[$key]['research_sub_type'] == 33) {
         $seresearchMarks += 4;

       }

     }




     if ($allResearchData[$key]['class_id'] == 9 || $allResearchData[$key]['class_id'] == 11 && $allResearchData[$key]['answer'] == 1) {

       if ($allResearchData[$key]['research_type'].$allResearchData[$key]['research_sub_type'] == 11) {
         $teresearchMarks += 10;
       }
       else if ($allResearchData[$key]['research_type'].$allResearchData[$key]['research_sub_type'] == 12) {
         $teresearchMarks += 7;

       }
       if ($allResearchData[$key]['research_type'].$allResearchData[$key]['research_sub_type'] == 13) {
         $teresearchMarks += 10;

       }
       if ($allResearchData[$key]['research_type'].$allResearchData[$key]['research_sub_type'] == 14) {
         $teresearchMarks += 7;

       }
       if ($allResearchData[$key]['research_type'].$allResearchData[$key]['research_sub_type'] == 21) {
         $teresearchMarks += 10;

       }
       if ($allResearchData[$key]['research_type'].$allResearchData[$key]['research_sub_type'] == 31) {
         $teresearchMarks += 8;

       }
       if ($allResearchData[$key]['research_type'].$allResearchData[$key]['research_sub_type'] == 32) {
         $teresearchMarks += 6;

       }
       if ($allResearchData[$key]['research_type'].$allResearchData[$key]['research_sub_type'] == 33) {
         $teresearchMarks += 4;

       }

     }




     if ($allResearchData[$key]['class_id'] == 13 || $allResearchData[$key]['class_id'] == 15 && $allResearchData[$key]['answer'] == 1) {

       if ($allResearchData[$key]['research_type'].$allResearchData[$key]['research_sub_type'] == 11) {
         $beresearchMarks += 10;
       }
       else if ($allResearchData[$key]['research_type'].$allResearchData[$key]['research_sub_type'] == 12) {
         $beresearchMarks += 7;

       }
       if ($allResearchData[$key]['research_type'].$allResearchData[$key]['research_sub_type'] == 13) {
         $beresearchMarks += 10;

       }
       if ($allResearchData[$key]['research_type'].$allResearchData[$key]['research_sub_type'] == 14) {
         $beresearchMarks += 7;

       }
       if ($allResearchData[$key]['research_type'].$allResearchData[$key]['research_sub_type'] == 21) {
         $beresearchMarks += 10;

       }
       if ($allResearchData[$key]['research_type'].$allResearchData[$key]['research_sub_type'] == 31) {
         $beresearchMarks += 8;

       }
       if ($allResearchData[$key]['research_type'].$allResearchData[$key]['research_sub_type'] == 32) {
         $beresearchMarks += 6;

       }
       if ($allResearchData[$key]['research_type'].$allResearchData[$key]['research_sub_type'] == 33) {
         $beresearchMarks += 4;

       }

     }

   }

   if($feresearchMarks >= 10){
     $researchMarks += 10;
     $feresearchMarks = 10;
   }
   else {
     $researchMarks += $feresearchMarks;


   }

   if($seresearchMarks >= 30){
     $researchMarks += 30;
     $seresearchMarks = 30;

   }
   else {
     $researchMarks += $seresearchMarks;


   }

   if($teresearchMarks >= 60){
     $researchMarks += 60;
     $teresearchMarks = 60;
   }
   else {
     $researchMarks += $teresearchMarks;


   }

   if($beresearchMarks >= 60){
     $researchMarks += 60;
     $beresearchMarks = 60;
   }
   else {
     $researchMarks += $beresearchMarks;


   }

  $feselfdevdata = 0;
  $seselfdevdata = 0;
  $teselfdevdata = 0;
  $beselfdevdata = 0;
  $SelfDevData = 0;

  foreach ($allSelfDevData as $key => $value) {
    if ($allSelfDevData[$key]['class_id'] == 1 || $allSelfDevData[$key]['class_id'] == 3 && $allSelfDevData[$key]['answer'] == 1) {

      if ($allSelfDevData[$key]['improve_type'] == 8) {
        if ($allSelfDevData[$key]['grade'] == "A") {
          $feselfdevdata += 10;

        }
        else if ($allSelfDevData[$key]['grade'] == "B") {
          $feselfdevdata += 7;

        }
        else if ($allSelfDevData[$key]['grade'] == "C") {
          $feselfdevdata += 5;

        }
        else {
          $feselfdevdata += 0;
        }
      }

      if ($allSelfDevData[$key]['improve_type'] == 6) {

        if ($allSelfDevData[$key]['grade'] == "A") {
          $feselfdevdata += 10;

        }
        else if ($allSelfDevData[$key]['grade'] == "B") {
          $feselfdevdata += 7;

        }
        else if ($allSelfDevData[$key]['grade'] == "C") {
          $feselfdevdata += 5;

        }
        else {
          $feselfdevdata += 0;
        }
      }

    }

    if ($allSelfDevData[$key]['class_id'] == 5 || $allSelfDevData[$key]['class_id'] == 7 && $allSelfDevData[$key]['answer'] == 1) {

      if ($allSelfDevData[$key]['improve_type'] == 1) {
        if ($allSelfDevData[$key]['grade'] == "A") {
          $seselfdevdata += 10;

        }
        else if ($allSelfDevData[$key]['grade'] == "B") {
          $seselfdevdata += 7;

        }
        else if ($allSelfDevData[$key]['grade'] == "C") {
          $seselfdevdata += 5;

        }
        else {
          $seselfdevdata += 0;
        }
      }

      if ($allSelfDevData[$key]['improve_type'] == 2) {
        if ($allSelfDevData[$key]['grade'] == "A") {
          $seselfdevdata += 10;

        }
        else if ($allSelfDevData[$key]['grade'] == "B") {
          $seselfdevdata += 7;

        }
        else if ($allSelfDevData[$key]['grade'] == "C") {
          $seselfdevdata += 5;

        }
        else {
          $seselfdevdata += 0;
        }
      }

      if ($allSelfDevData[$key]['improve_type'] == 6) {

        if ($allSelfDevData[$key]['grade'] == "A") {
          $seselfdevdata += 10;

        }
        else if ($allSelfDevData[$key]['grade'] == "B") {
          $seselfdevdata += 7;

        }
        else if ($allSelfDevData[$key]['grade'] == "C") {
          $seselfdevdata += 5;

        }
        else {
          $seselfdevdata += 0;
        }
      }

    }


    if ($allSelfDevData[$key]['class_id'] == 9 || $allSelfDevData[$key]['class_id'] == 11 && $allSelfDevData[$key]['answer'] == 1) {

      if ($allSelfDevData[$key]['improve_type'] == 2) {
        if ($allSelfDevData[$key]['grade'] == "A") {
          $teselfdevdata += 10;

        }
        else if ($allSelfDevData[$key]['grade'] == "B") {
          $teselfdevdata += 7;

        }
        else if ($allSelfDevData[$key]['grade'] == "C") {
          $teselfdevdata += 5;

        }
        else {
          $teselfdevdata += 0;
        }
      }

      if ($allSelfDevData[$key]['improve_type'] == 3) {
        if ($allSelfDevData[$key]['grade'] == "A") {
          $teselfdevdata += 10;

        }
        else if ($allSelfDevData[$key]['grade'] == "B") {
          $teselfdevdata += 7;

        }
        else if ($allSelfDevData[$key]['grade'] == "C") {
          $teselfdevdata += 5;

        }
        else {
          $teselfdevdata += 0;
        }
      }

      if ($allSelfDevData[$key]['improve_type'] == 4) {

        if ($allSelfDevData[$key]['grade'] == "A") {
          $teselfdevdata += 10;

        }
        else if ($allSelfDevData[$key]['grade'] == "B") {
          $teselfdevdata += 7;

        }
        else if ($allSelfDevData[$key]['grade'] == "C") {
          $teselfdevdata += 5;

        }
        else {
          $teselfdevdata += 0;
        }
      }

      if ($allSelfDevData[$key]['improve_type'] == 5) {

        if ($allSelfDevData[$key]['grade'] == "A") {
          $teselfdevdata += 10;

        }
        else if ($allSelfDevData[$key]['grade'] == "B") {
          $teselfdevdata += 7;

        }
        else if ($allSelfDevData[$key]['grade'] == "C") {
          $teselfdevdata += 5;

        }
        else {
          $teselfdevdata += 0;
        }
      }

      if ($allSelfDevData[$key]['improve_type'] == 6) {

        if ($allSelfDevData[$key]['grade'] == "A") {
          $teselfdevdata += 10;

        }
        else if ($allSelfDevData[$key]['grade'] == "B") {
          $teselfdevdata += 7;

        }
        else if ($allSelfDevData[$key]['grade'] == "C") {
          $teselfdevdata += 5;

        }
        else {
          $teselfdevdata += 0;
        }
      }

      if ($allSelfDevData[$key]['improve_type'] == 9) {

        if ($allSelfDevData[$key]['grade'] == "A") {
          $teselfdevdata += 10;

        }
        else if ($allSelfDevData[$key]['grade'] == "B") {
          $teselfdevdata += 7;

        }
        else if ($allSelfDevData[$key]['grade'] == "C") {
          $teselfdevdata += 5;

        }
        else {
          $teselfdevdata += 0;
        }
      }

    }

    if ($allSelfDevData[$key]['class_id'] == 13 || $allSelfDevData[$key]['class_id'] == 15 && $allSelfDevData[$key]['answer'] == 1) {

      if ($allSelfDevData[$key]['improve_type'] == 7) {
        if ($allSelfDevData[$key]['grade'] == "A") {
          $beselfdevdata += 10;

        }
        else if ($allSelfDevData[$key]['grade'] == "B") {
          $beselfdevdata += 7;

        }
        else if ($allSelfDevData[$key]['grade'] == "C") {
          $beselfdevdata += 5;

        }
        else {
          $beselfdevdata += 0;
        }
      }

      if ($allSelfDevData[$key]['improve_type'] == 8) {
        if ($allSelfDevData[$key]['grade'] == "A") {
          $beselfdevdata += 10;

        }
        else if ($allSelfDevData[$key]['grade'] == "B") {
          $beselfdevdata += 7;

        }
        else if ($allSelfDevData[$key]['grade'] == "C") {
          $beselfdevdata += 5;

        }
        else {
          $beselfdevdata += 0;
        }
      }

      if ($allSelfDevData[$key]['improve_type'] == 4) {

        if ($allSelfDevData[$key]['grade'] == "A") {
          $beselfdevdata += 10;

        }
        else if ($allSelfDevData[$key]['grade'] == "B") {
          $beselfdevdata += 7;

        }
        else if ($allSelfDevData[$key]['grade'] == "C") {
          $beselfdevdata += 5;

        }
        else {
          $beselfdevdata += 0;
        }
      }



      if ($allSelfDevData[$key]['improve_type'] == 6) {

        if ($allSelfDevData[$key]['grade'] == "A") {
          $beselfdevdata += 10;

        }
        else if ($allSelfDevData[$key]['grade'] == "B") {
          $beselfdevdata += 7;

        }
        else if ($allSelfDevData[$key]['grade'] == "C") {
          $beselfdevdata += 5;

        }
        else {
          $beselfdevdata += 0;
        }
      }

    }
  }

  if($feselfdevdata >= 20){
    $SelfDevData += 20;
    $feselfdevdata = 20;
  }
  else {
    $SelfDevData += $feselfdevdata;


  }

  if($seselfdevdata >= 50){
    $SelfDevData += 50;
    $seselfdevdata = 50;

  }
  else {
    $SelfDevData += $seselfdevdata;


  }

  if($teselfdevdata >= 50){
    $SelfDevData += 50;
    $teselfdevdata = 50;

  }
  else {
    $SelfDevData += $teselfdevdata;


  }

  if($beselfdevdata >= 30){
    $SelfDevData += 30;
    $beselfdevdata = 30;

  }
  else {
    $SelfDevData += $beselfdevdata;

  }

  $feextracurriMarks = 0;
  $seextracurriMarks = 0;
  $teextracurriMarks = 0;
  $beextracurriMarks = 0;
  $extracurriMarks = 0;


  foreach ($ExtraCurricularData as $key => $value) {

    if ($ExtraCurricularData[$key]['class_id'] == 1 || $ExtraCurricularData[$key]['class_id'] == 3) {

      if($ExtraCurricularData[$key]['answer'] == 1){

        if ($ExtraCurricularData[$key]['activity_type'].$ExtraCurricularData[$key]['act_sub_type'] == 11) {
          $feextracurriMarks += 10;
        }
        if ($ExtraCurricularData[$key]['activity_type'].$ExtraCurricularData[$key]['act_sub_type'] == 12) {
          $feextracurriMarks += 7;

        }
        if ($ExtraCurricularData[$key]['activity_type'].$ExtraCurricularData[$key]['act_sub_type'] == 13) {
          $feextracurriMarks += 5;

        }
        if ($ExtraCurricularData[$key]['activity_type'].$ExtraCurricularData[$key]['act_sub_type'] == 21) {
          $feextracurriMarks += 10;

        }
        if ($ExtraCurricularData[$key]['activity_type'].$ExtraCurricularData[$key]['act_sub_type'] == 22) {
          $feextracurriMarks += 7;

        }
        if ($ExtraCurricularData[$key]['activity_type'].$ExtraCurricularData[$key]['act_sub_type'] == 23) {
          $feextracurriMarks += 5;

        }
        if ($ExtraCurricularData[$key]['activity_type'].$ExtraCurricularData[$key]['act_sub_type'] == 31) {
          $feextracurriMarks += 10;

        }
        if ($ExtraCurricularData[$key]['activity_type'].$ExtraCurricularData[$key]['act_sub_type'] == 32) {
          $feextracurriMarks += 7;

        }
        if ($ExtraCurricularData[$key]['activity_type'].$ExtraCurricularData[$key]['act_sub_type'] == 33) {
          $feextracurriMarks += 5;

        }
        if ($ExtraCurricularData[$key]['activity_type'].$ExtraCurricularData[$key]['act_sub_type'] == 42) {
          $feextracurriMarks += 10;

        }
        if ($ExtraCurricularData[$key]['activity_type'].$ExtraCurricularData[$key]['act_sub_type'] == 42) {
          $feextracurriMarks += 7;

        }
        if ($ExtraCurricularData[$key]['activity_type'].$ExtraCurricularData[$key]['act_sub_type'] == 51) {
          $feextracurriMarks += 5;
        }

      }


    }

    if (($ExtraCurricularData[$key]['class_id'] == 5 || $ExtraCurricularData[$key]['class_id'] == 7) && $ExtraCurricularData[$key]['answer'] == 1) {

      if ($ExtraCurricularData[$key]['activity_type'].$ExtraCurricularData[$key]['act_sub_type'] == 11) {
        $seextracurriMarks += 10;
      }
      if ($ExtraCurricularData[$key]['activity_type'].$ExtraCurricularData[$key]['act_sub_type'] == 12) {
        $seextracurriMarks += 7;

      }
      if ($ExtraCurricularData[$key]['activity_type'].$ExtraCurricularData[$key]['act_sub_type'] == 13) {
        $seextracurriMarks += 5;

      }
      if ($ExtraCurricularData[$key]['activity_type'].$ExtraCurricularData[$key]['act_sub_type'] == 21) {
        $seextracurriMarks += 10;

      }
      if ($ExtraCurricularData[$key]['activity_type'].$ExtraCurricularData[$key]['act_sub_type'] == 22) {
        $seextracurriMarks += 7;

      }
      if ($ExtraCurricularData[$key]['activity_type'].$ExtraCurricularData[$key]['act_sub_type'] == 23) {
        $seextracurriMarks += 5;

      }
      if ($ExtraCurricularData[$key]['activity_type'].$ExtraCurricularData[$key]['act_sub_type'] == 31) {
        $seextracurriMarks += 10;

      }
      if ($ExtraCurricularData[$key]['activity_type'].$ExtraCurricularData[$key]['act_sub_type'] == 32) {
        $seextracurriMarks += 7;

      }
      if ($ExtraCurricularData[$key]['activity_type'].$ExtraCurricularData[$key]['act_sub_type'] == 33) {
        $seextracurriMarks += 5;

      }
      if ($ExtraCurricularData[$key]['activity_type'].$ExtraCurricularData[$key]['act_sub_type'] == 42) {
        $seextracurriMarks += 10;

      }
      if ($ExtraCurricularData[$key]['activity_type'].$ExtraCurricularData[$key]['act_sub_type'] == 42) {
        $seextracurriMarks += 7;

      }
      if ($ExtraCurricularData[$key]['activity_type'].$ExtraCurricularData[$key]['act_sub_type'] == 51) {
        $seextracurriMarks += 5;
      }

    }
    if (($ExtraCurricularData[$key]['class_id'] == 9 || $ExtraCurricularData[$key]['class_id'] == 11) && $ExtraCurricularData[$key]['answer'] == 1) {

      if ($ExtraCurricularData[$key]['activity_type'].$ExtraCurricularData[$key]['act_sub_type'] == 11) {
        $teextracurriMarks += 10;
      }
      if ($ExtraCurricularData[$key]['activity_type'].$ExtraCurricularData[$key]['act_sub_type'] == 12) {
        $teextracurriMarks += 7;

      }
      if ($ExtraCurricularData[$key]['activity_type'].$ExtraCurricularData[$key]['act_sub_type'] == 13) {
        $teextracurriMarks += 5;

      }
      if ($ExtraCurricularData[$key]['activity_type'].$ExtraCurricularData[$key]['act_sub_type'] == 21) {
        $teextracurriMarks += 10;

      }
      if ($ExtraCurricularData[$key]['activity_type'].$ExtraCurricularData[$key]['act_sub_type'] == 22) {
        $teextracurriMarks += 7;

      }
      if ($ExtraCurricularData[$key]['activity_type'].$ExtraCurricularData[$key]['act_sub_type'] == 23) {
        $teextracurriMarks += 5;

      }
      if ($ExtraCurricularData[$key]['activity_type'].$ExtraCurricularData[$key]['act_sub_type'] == 31) {
        $teextracurriMarks += 10;

      }
      if ($ExtraCurricularData[$key]['activity_type'].$ExtraCurricularData[$key]['act_sub_type'] == 32) {
        $teextracurriMarks += 7;

      }
      if ($ExtraCurricularData[$key]['activity_type'].$ExtraCurricularData[$key]['act_sub_type'] == 33) {
        $teextracurriMarks += 5;

      }
      if ($ExtraCurricularData[$key]['activity_type'].$ExtraCurricularData[$key]['act_sub_type'] == 42) {
        $teextracurriMarks += 10;

      }
      if ($ExtraCurricularData[$key]['activity_type'].$ExtraCurricularData[$key]['act_sub_type'] == 42) {
        $teextracurriMarks += 7;

      }
      if ($ExtraCurricularData[$key]['activity_type'].$ExtraCurricularData[$key]['act_sub_type'] == 51) {
        $teextracurriMarks += 5;
      }

    }
    if ( ($ExtraCurricularData[$key]['class_id'] == 13 || $ExtraCurricularData[$key]['class_id'] == 15) && $ExtraCurricularData[$key]['answer'] == 1) {

      if ($ExtraCurricularData[$key]['activity_type'].$ExtraCurricularData[$key]['act_sub_type'] == 11) {
        $beextracurriMarks += 10;
      }
      if ($ExtraCurricularData[$key]['activity_type'].$ExtraCurricularData[$key]['act_sub_type'] == 12) {
        $beextracurriMarks += 7;

      }
      if ($ExtraCurricularData[$key]['activity_type'].$ExtraCurricularData[$key]['act_sub_type'] == 13) {
        $beextracurriMarks += 5;

      }
      if ($ExtraCurricularData[$key]['activity_type'].$ExtraCurricularData[$key]['act_sub_type'] == 21) {
        $beextracurriMarks += 10;

      }
      if ($ExtraCurricularData[$key]['activity_type'].$ExtraCurricularData[$key]['act_sub_type'] == 22) {
        $beextracurriMarks += 7;

      }
      if ($ExtraCurricularData[$key]['activity_type'].$ExtraCurricularData[$key]['act_sub_type'] == 23) {
        $beextracurriMarks += 5;

      }
      if ($ExtraCurricularData[$key]['activity_type'].$ExtraCurricularData[$key]['act_sub_type'] == 31) {
        $beextracurriMarks += 10;

      }
      if ($ExtraCurricularData[$key]['activity_type'].$ExtraCurricularData[$key]['act_sub_type'] == 32) {
        $beextracurriMarks += 7;

      }
      if ($ExtraCurricularData[$key]['activity_type'].$ExtraCurricularData[$key]['act_sub_type'] == 33) {
        $beextracurriMarks += 5;

      }
      if ($ExtraCurricularData[$key]['activity_type'].$ExtraCurricularData[$key]['act_sub_type'] == 42) {
        $beextracurriMarks += 10;

      }
      if ($ExtraCurricularData[$key]['activity_type'].$ExtraCurricularData[$key]['act_sub_type'] == 42) {
        $beextracurriMarks += 7;

      }
      if ($ExtraCurricularData[$key]['activity_type'].$ExtraCurricularData[$key]['act_sub_type'] == 51) {
        $beextracurriMarks += 5;
      }

    }


  }

  if($feextracurriMarks >= 10){
    $extracurriMarks += 10;
    $feextracurriMarks = 10;
  }
  else {
    $extracurriMarks += $feextracurriMarks;


  }

  if($seextracurriMarks >= 35){
    $extracurriMarks += 35;
    $seextracurriMarks = 35;

  }
  else {
    $extracurriMarks += $seextracurriMarks;


  }

  if($teextracurriMarks >= 35){
    $extracurriMarks += 35;
    $teextracurriMarks = 35;

  }
  else {
    $extracurriMarks += $teextracurriMarks;


  }

  if($beextracurriMarks >= 20){
    $extracurriMarks += 20;
    $beextracurriMarks = 20;

  }
  else {
    $extracurriMarks += $beextracurriMarks;
  }

$returnArray = [];
$returnArray['academic'] = $marks_total;
$returnArray['research'] = $researchMarks;
$returnArray['selfDev'] = $SelfDevData;
$returnArray['Extracurriculars'] = $extracurriMarks;

$returnArray['fe']['continuous'] = $fecontinuous;
$returnArray['se']['continuous'] = $secontinuous;
$returnArray['te']['continuous'] = $tecontinuous;
$returnArray['be']['continuous'] = $becontinuous;

$returnArray['be']['acad'] = $beacad;
$returnArray['se']['acad'] = $seacad;
$returnArray['te']['acad'] = $teacad;
$returnArray['fe']['acad'] = $feacad;

$returnArray['fe']['ese'] = $feese;
$returnArray['se']['ese'] = $seese;
$returnArray['te']['ese'] = $teese;
$returnArray['be']['ese'] = $beese;

$returnArray['fe']['research'] = $feresearchMarks;
$returnArray['se']['research'] = $seresearchMarks;
$returnArray['te']['research'] = $teresearchMarks;
$returnArray['be']['research'] = $beresearchMarks;

$returnArray['fe']['selfdev'] = $feselfdevdata;
$returnArray['se']['selfdev'] = $seselfdevdata;
$returnArray['te']['selfdev'] = $teselfdevdata;
$returnArray['be']['selfdev'] = $beselfdevdata;

$returnArray['fe']['extra'] = $feextracurriMarks;
$returnArray['se']['extra'] = $seextracurriMarks;
$returnArray['te']['extra'] = $teextracurriMarks;
$returnArray['be']['extra'] = $beextracurriMarks;









echo json_encode ($returnArray);

 ?>
