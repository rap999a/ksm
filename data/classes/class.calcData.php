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


class calcData {
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

  // public function fetchFEAcad($id){
  //   $stmt = $this->pdo->prepare("SELECT * FROM PM010007 WHERE student_id = :student_id");
  //   $stmt->bindParam(":student_id",$_SESSION['studentId'],PDO::PARAM_STR);
  //   $stmt->execute();
  //   $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
  //   return $data;
  // }

  public function fetchFEResearch($id){

      $stmt = $this->pdo->prepare("SELECT * FROM PM010019 WHERE student_id = :student_id AND class_id >= 1 AND class_id <=4");
      $stmt->bindParam(":student_id",$id,PDO::PARAM_STR);
      $stmt->execute();
      $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
      return $data;
  }
  public function fetchSEResearch($id){

      $stmt = $this->pdo->prepare("SELECT * FROM PM010019 WHERE student_id = :student_id AND class_id >= 5 AND class_id <=8");
      $stmt->bindParam(":student_id",$id,PDO::PARAM_STR);
      $stmt->execute();
      $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
      return $data;
  }
  public function fetchTEResearch($id){

      $stmt = $this->pdo->prepare("SELECT * FROM PM010019 WHERE student_id = :student_id AND class_id >= 9 AND class_id <=12");
      $stmt->bindParam(":student_id",$id,PDO::PARAM_STR);
      $stmt->execute();
      $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
      return $data;
  }
  public function fetchBEResearch($id){

      $stmt = $this->pdo->prepare("SELECT * FROM PM010019 WHERE student_id = :student_id AND class_id >= 13 AND class_id <=16");
      $stmt->bindParam(":student_id",$id,PDO::PARAM_STR);
      $stmt->execute();
      $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
      return $data;
  }


  public function fetchFESelfDev($id){

      $stmt = $this->pdo->prepare("SELECT * FROM PM010018 WHERE student_id = :student_id AND class_id >= 1 AND class_id <=4");
      $stmt->bindParam(":student_id",$id,PDO::PARAM_STR);
      $stmt->execute();
      $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
      return $data;
  }
  public function fetchSESelfDev($id){

      $stmt = $this->pdo->prepare("SELECT * FROM PM010018 WHERE student_id = :student_id AND class_id >= 5 AND class_id <=8");
      $stmt->bindParam(":student_id",$id,PDO::PARAM_STR);
      $stmt->execute();
      $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
      return $data;
  }
  public function fetchTESelfDev($id){

      $stmt = $this->pdo->prepare("SELECT * FROM PM010018 WHERE student_id = :student_id AND class_id >= 9 AND class_id <=12");
      $stmt->bindParam(":student_id",$id,PDO::PARAM_STR);
      $stmt->execute();
      $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
      return $data;
  }
  public function fetchBESelfDev($id){

      $stmt = $this->pdo->prepare("SELECT * FROM PM010018 WHERE student_id = :student_id AND class_id >= 13 AND class_id <=16");
      $stmt->bindParam(":student_id",$id,PDO::PARAM_STR);
      $stmt->execute();
      $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
      return $data;
  }



  public function fetchFEExtra($id){

      $stmt = $this->pdo->prepare("SELECT * FROM PM010017 WHERE student_id = :student_id AND class_id >= 1 AND class_id <=4");
      $stmt->bindParam(":student_id",$id,PDO::PARAM_STR);
      $stmt->execute();
      $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
      return $data;
  }
  public function fetchSEExtra($id){

      $stmt = $this->pdo->prepare("SELECT * FROM PM010017 WHERE student_id = :student_id AND class_id >= 5 AND class_id <=8");
      $stmt->bindParam(":student_id",$id,PDO::PARAM_STR);
      $stmt->execute();
      $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
      return $data;
  }
  public function fetchTEExtra($id){

      $stmt = $this->pdo->prepare("SELECT * FROM PM010017 WHERE student_id = :student_id AND class_id >= 9 AND class_id <=12");
      $stmt->bindParam(":student_id",$id,PDO::PARAM_STR);
      $stmt->execute();
      $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
      return $data;
  }
  public function fetchBEExtra($id){

      $stmt = $this->pdo->prepare("SELECT * FROM PM010017 WHERE student_id = :student_id AND class_id >= 13 AND class_id <=16");
      $stmt->bindParam(":student_id",$id,PDO::PARAM_STR);
      $stmt->execute();
      $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
      return $data;
  }

  public function fetchFEAcad($id){

      $stmt = $this->pdo->prepare("SELECT * FROM PM010016 WHERE student_id = :student_id AND class_id >= 1 AND class_id <=4");
      $stmt->bindParam(":student_id",$id,PDO::PARAM_STR);
      $stmt->execute();
      $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
      return $data;
  }
  public function fetchSEAcad($id){

      $stmt = $this->pdo->prepare("SELECT * FROM PM010016 WHERE student_id = :student_id AND class_id >= 5 AND class_id <=8");
      $stmt->bindParam(":student_id",$id,PDO::PARAM_STR);
      $stmt->execute();
      $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
      return $data;
  }
  public function fetchTEAcad($id){

      $stmt = $this->pdo->prepare("SELECT * FROM PM010016 WHERE student_id = :student_id AND class_id >= 9 AND class_id <=12");
      $stmt->bindParam(":student_id",$id,PDO::PARAM_STR);
      $stmt->execute();
      $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
      return $data;
  }
  public function fetchBEAcad($id){

      $stmt = $this->pdo->prepare("SELECT * FROM PM010016 WHERE student_id = :student_id AND class_id >= 13 AND class_id <=16");
      $stmt->bindParam(":student_id",$id,PDO::PARAM_STR);
      $stmt->execute();
      $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
      return $data;
  }

  public function fetchAttendance($id,$low,$high){

    $stmt = $this->pdo->prepare("SELECT student_id FROM PM010001 WHERE prim_id = :student_id");
    $stmt->bindParam(":student_id",$id,PDO::PARAM_STR);
    $stmt->execute();
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $stmt = $this->pdo->prepare("SELECT AVG(attendance_percentage) as attendance_percentage FROM PM010007 WHERE student_id = :student_id AND class_id >= :low AND class_id <=:high");
    $stmt->bindParam(":student_id",$data[0]['student_id'],PDO::PARAM_STR);
    $stmt->bindParam(":low",$low,PDO::PARAM_STR);
    $stmt->bindParam(":high",$high,PDO::PARAM_STR);
    $stmt->execute();
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $data;
  }

  public function fetchUTperformance($id,$low,$high){
    $stmt = $this->pdo->prepare("SELECT student_id FROM PM010001 WHERE prim_id = :student_id");
    $stmt->bindParam(":student_id",$id,PDO::PARAM_STR);
    $stmt->execute();
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $stmt = $this->pdo->prepare("SELECT AVG(percentage) as percentage,SUM(passed) as passed FROM PM010005 WHERE student_id = :student_id AND class_id >= :low AND class_id <=:high");
    $stmt->bindParam(":student_id",$data[0]['student_id'],PDO::PARAM_STR);
    $stmt->bindParam(":low",$low,PDO::PARAM_STR);
    $stmt->bindParam(":high",$high,PDO::PARAM_STR);
    $stmt->execute();
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $data;
  }
}
