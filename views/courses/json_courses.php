<?php
$this->set_layout("layouts/no_layout");
header('Content-Type: application/json');
$groups = array();
foreach ($courses as $course) {
    if (!isset($groups[$course['sem_number']])) {
        $groups[$course['sem_number']] = array();
    }
    $groups[$course['sem_number']][] = $course;
}
arsort($groups);

$ausgabe = array();
foreach ($groups as $sem_key => $group) {
	foreach ($group as $course)
	{
		$tmp = array("id" => htmlReady($course['Seminar_id']), "name"=> htmlReady($course['Name']));
		array_push($ausgabe, $tmp);
	}
	break;
}
echo json_encode( $ausgabe );

?>