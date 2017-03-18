<?php
	include_once("../classes/class.users.php");
	$obj = new users();
	$data = $obj->fetchProctorRest();
  echo json_encode ($data);

 ?>
