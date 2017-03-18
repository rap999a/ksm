<?php
	include_once("../classes/class.users.php");

	$obj = new users();
	$data = $obj->fetchProctorBasic();
  echo json_encode ($data);

 ?>
