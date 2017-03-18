<?php
	include_once("../classes/class.users.php");
	$post = file_get_contents("php://input");
	$proctorFormData = json_decode($post,true);
	$obj = new users();
	$data = $obj->proctorForm($proctorFormData);


 ?>
