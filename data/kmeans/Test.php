<?php

include_once ('KMeans.php');

$xKey = 0;
$yKey = 1;
$return = array();
// form test data
$AcademicData = array();
$ResearchData = array();
$SelfDevData = array();
$ExtraData = array();
$AcademicData = array(
	array(
		'name'	=> 'Sneha Kewlani',
		'x'		=> 221,
		'y'		=> 0
	),
	array(
		'name'	=> 'Kshitij Malhara',
		'x'		=> 146,
		'y'		=> 0
	),
	array(
		'name'	=> 'Rohit Keswani',
		'x'		=> 477,
		'y'		=> 0
	),
	array(
		'name'	=> 'Priyanka Kakade',
		'x'		=> 387,
		'y'		=> 0
	),
	array(
		'name'	=> 'Rohan Purekar',
		'x'		=> 377,
		'y'		=> 0
	),
	array(
		'name'	=> 'Harshal Bahekar',
		'x'		=> 397,
		'y'		=> 0
	),
	array(
		'name'	=> 'Krutik Thakor',
		'x'		=> 527,
		'y'		=> 0
	),
	array(
		'name'	=> 'Ekta Ghonge',
		'x'		=> 127,
		'y'		=> 0
	),
	array(
		'name'	=> 'Vivek Bhanse',
		'x'		=> 517,
		'y'		=> 0
	),
	array(
		'name'	=> 'Modiksha Madan',
		'x'		=> 577,
		'y'		=> 0
	),
	array(
		'name'	=> 'Mahesh Chitnis',
		'x'		=> 226,
		'y'		=> 0
	),
	array(
		'name'	=> 'Bhushan Darekar',
		'x'		=> 296,
		'y'		=> 0
	),
);


$kmeans = new KMeans();
$kmeans
	->setData($AcademicData)
	->setXKey('x')
	->setYKey('y')
	->setClusterCount(3)
	->solve();

$clusters = $kmeans->getClusters();
foreach ($clusters as $cluster) {
	$x = $cluster->getX();
	$y = $cluster->getY();
	$data = $cluster->getData();
}

$names = array();
$Acadcoordinates = array();
$Acadcoordinates1 = array();
$Acadcoordinates2 = array();
foreach ($clusters[0]->getData() as $key => $ra) {
	$Acadcoordinates[$key]['marks'] = $ra['x'];
	$Acadcoordinates[$key][1] = $ra['y'];
	$Acadcoordinates[$key]['name'] = $ra['name'];
}
foreach ($clusters[1]->getData() as $key => $ra) {
	$Acadcoordinates1[$key]['marks'] = $ra['x'];
	$Acadcoordinates1[$key][1] = $ra['y'];
	$Acadcoordinates1[$key]['name'] = $ra['name'];
}
foreach ($clusters[2]->getData() as $key => $ra) {
	$Acadcoordinates2[$key]['marks'] = $ra['x'];
	$Acadcoordinates2[$key][1] = $ra['y'];
	$Acadcoordinates2[$key]['name'] = $ra['name'];
}

$return[0][0] = $Acadcoordinates;
$return[0][1] = $Acadcoordinates1;
$return[0][2] = $Acadcoordinates2;

$i = 3;
foreach ($clusters as $cluster) {
	$return[0][$i] = $cluster->getX() . ',' . $cluster->getY();
	$i++;
}
#============================================================================================================================
$ResearchData = array(
	array(
		'name'	=> 'Sneha Kewlani',
		'x'		=> 21,
		'y'		=> 0
	),
	array(
		'name'	=> 'Kshitij Malhara',
		'x'		=> 46,
		'y'		=> 0
	),
	array(
		'name'	=> 'Rohit Keswani',
		'x'		=> 107,
		'y'		=> 0
	),
	array(
		'name'	=> 'Priyanka Kakade',
		'x'		=> 77,
		'y'		=> 0
	),
	array(
		'name'	=> 'Rohan Purekar',
		'x'		=> 67,
		'y'		=> 0
	),
	array(
		'name'	=> 'Harshal Bahekar',
		'x'		=> 37,
		'y'		=> 0
	),
	array(
		'name'	=> 'Krutik Thakor',
		'x'		=> 27,
		'y'		=> 0
	),
	array(
		'name'	=> 'Ekta Ghonge',
		'x'		=> 127,
		'y'		=> 0
	),
	array(
		'name'	=> 'Vivek Bhanse',
		'x'		=> 57,
		'y'		=> 0
	),
	array(
		'name'	=> 'Modiksha Madan',
		'x'		=> 97,
		'y'		=> 0
	),
	array(
		'name'	=> 'Mahesh Chitnis',
		'x'		=> 86,
		'y'		=> 0
	),
	array(
		'name'	=> 'Bhushan Darekar',
		'x'		=> 96,
		'y'		=> 0
	),
);
$kmeans
	->setData($ResearchData)
	->setXKey('x')
	->setYKey('y')
	->setClusterCount(3)
	->solve();

$clusters = $kmeans->getClusters();
foreach ($clusters as $cluster) {
	$x = $cluster->getX();
	$y = $cluster->getY();
	$data = $cluster->getData();
}

$names = array();
$researchCoordinates = array();
$researchCoordinates1 = array();
$researchCoordinates2 = array();
foreach ($clusters[0]->getData() as $key => $ra) {
	$researchCoordinates[$key]['marks'] = $ra['x'];
	$researchCoordinates[$key][1] = $ra['y'];
	$researchCoordinates[$key]['name'] = $ra['name'];
}
foreach ($clusters[1]->getData() as $key => $ra) {
	$researchCoordinates1[$key]['marks'] = $ra['x'];
	$researchCoordinates1[$key][1] = $ra['y'];
	$researchCoordinates1[$key]['name'] = $ra['name'];
}
foreach ($clusters[2]->getData() as $key => $ra) {
	$researchCoordinates2[$key]['marks'] = $ra['x'];
	$researchCoordinates2[$key][1] = $ra['y'];
	$researchCoordinates2[$key]['name'] = $ra['name'];
}

$return[1][0] = $researchCoordinates;
$return[1][1] = $researchCoordinates1;
$return[1][2] = $researchCoordinates2;

$i = 3;
foreach ($clusters as $cluster) {
	$return[1][$i] = $cluster->getX() . ',' . $cluster->getY();
	$i++;
}

#============================================================================================================================
$SelfDevData = array(
	array(
		'name'	=> 'Sneha Kewlani',
		'x'		=> 81,
		'y'		=> 0
	),
	array(
		'name'	=> 'Kshitij Malhara',
		'x'		=> 76,
		'y'		=> 0
	),
	array(
		'name'	=> 'Rohit Keswani',
		'x'		=> 57,
		'y'		=> 0
	),
	array(
		'name'	=> 'Priyanka Kakade',
		'x'		=> 127,
		'y'		=> 0
	),
	array(
		'name'	=> 'Rohan Purekar',
		'x'		=> 67,
		'y'		=> 0
	),
	array(
		'name'	=> 'Harshal Bahekar',
		'x'		=> 56,
		'y'		=> 0
	),
	array(
		'name'	=> 'Krutik Thakor',
		'x'		=> 113,
		'y'		=> 0
	),
	array(
		'name'	=> 'Ekta Ghonge',
		'x'		=> 29,
		'y'		=> 0
	),
	array(
		'name'	=> 'Vivek Bhanse',
		'x'		=> 37,
		'y'		=> 0
	),
	array(
		'name'	=> 'Modiksha Madan',
		'x'		=> 17,
		'y'		=> 0
	),
	array(
		'name'	=> 'Mahesh Chitnis',
		'x'		=> 26,
		'y'		=> 0
	),
	array(
		'name'	=> 'Bhushan Darekar',
		'x'		=> 96,
		'y'		=> 0
	),
);
$kmeans
	->setData($SelfDevData)
	->setXKey('x')
	->setYKey('y')
	->setClusterCount(3)
	->solve();

$clusters = $kmeans->getClusters();
foreach ($clusters as $cluster) {
	$x = $cluster->getX();
	$y = $cluster->getY();
	$data = $cluster->getData();
}

$names = array();
$SelfDevCoordinates = array();
$SelfDevCoordinates1 = array();
$SelfDevCoordinates2 = array();
foreach ($clusters[0]->getData() as $key => $ra) {
	$SelfDevCoordinates[$key]['marks'] = $ra['x'];
	$SelfDevCoordinates[$key][1] = $ra['y'];
	$SelfDevCoordinates[$key]['name'] = $ra['name'];
}
foreach ($clusters[1]->getData() as $key => $ra) {
	$SelfDevCoordinates1[$key]['marks'] = $ra['x'];
	$SelfDevCoordinates1[$key][1] = $ra['y'];
	$SelfDevCoordinates1[$key]['name'] = $ra['name'];
}
foreach ($clusters[2]->getData() as $key => $ra) {
	$SelfDevCoordinates2[$key]['marks'] = $ra['x'];
	$SelfDevCoordinates2[$key][1] = $ra['y'];
	$SelfDevCoordinates2[$key]['name'] = $ra['name'];
}

$return[2][0] = $SelfDevCoordinates;
$return[2][1] = $SelfDevCoordinates1;
$return[2][2] = $SelfDevCoordinates2;

$i = 3;
foreach ($clusters as $cluster) {
	$return[2][$i] = $cluster->getX() . ',' . $cluster->getY();
	$i++;
}

#============================================================================================================================
$extraData = array(
	array(
		'name'	=> 'Sneha Kewlani',
		'x'		=> 81,
		'y'		=> 0
	),
	array(
		'name'	=> 'Kshitij Malhara',
		'x'		=> 76,
		'y'		=> 0
	),
	array(
		'name'	=> 'Rohit Keswani',
		'x'		=> 57,
		'y'		=> 0
	),
	array(
		'name'	=> 'Priyanka Kakade',
		'x'		=> 27,
		'y'		=> 0
	),
	array(
		'name'	=> 'Rohan Purekar',
		'x'		=> 67,
		'y'		=> 0
	),
	array(
		'name'	=> 'Harshal Bahekar',
		'x'		=> 56,
		'y'		=> 0
	),
	array(
		'name'	=> 'Krutik Thakor',
		'x'		=> 13,
		'y'		=> 0
	),
	array(
		'name'	=> 'Ekta Ghonge',
		'x'		=> 89,
		'y'		=> 0
	),
	array(
		'name'	=> 'Vivek Bhanse',
		'x'		=> 57,
		'y'		=> 0
	),
	array(
		'name'	=> 'Modiksha Madan',
		'x'		=> 67,
		'y'		=> 0
	),
	array(
		'name'	=> 'Mahesh Chitnis',
		'x'		=> 26,
		'y'		=> 0
	),
	array(
		'name'	=> 'Bhushan Darekar',
		'x'		=> 36,
		'y'		=> 0
	),
);
$kmeans
	->setData($extraData)
	->setXKey('x')
	->setYKey('y')
	->setClusterCount(3)
	->solve();

$clusters = $kmeans->getClusters();
foreach ($clusters as $cluster) {
	$x = $cluster->getX();
	$y = $cluster->getY();
	$data = $cluster->getData();
}

$names = array();
$extraCoordinates = array();
$extraCoordinates1 = array();
$extraCoordinates2 = array();
foreach ($clusters[0]->getData() as $key => $ra) {
	$extraCoordinates[$key]['marks'] = $ra['x'];
	$extraCoordinates[$key][1] = $ra['y'];
	$extraCoordinates[$key]['name'] = $ra['name'];
}
foreach ($clusters[1]->getData() as $key => $ra) {
	$extraCoordinates1[$key]['marks'] = $ra['x'];
	$extraCoordinates1[$key][1] = $ra['y'];
	$extraCoordinates1[$key]['name'] = $ra['name'];
}
foreach ($clusters[2]->getData() as $key => $ra) {
	$extraCoordinates2[$key]['marks'] = $ra['x'];
	$extraCoordinates2[$key][1] = $ra['y'];
	$extraCoordinates2[$key]['name'] = $ra['name'];
}

$return[3][0] = $extraCoordinates;
$return[3][1] = $extraCoordinates1;
$return[3][2] = $extraCoordinates2;

$i = 3;
foreach ($clusters as $cluster) {
	$return[3][$i] = $cluster->getX() . ',' . $cluster->getY();
	$i++;
}

#============================================================================================================================
// echo "<pre>";
// print_r($return);
// echo "<pre>";
echo json_encode($return);
?>
