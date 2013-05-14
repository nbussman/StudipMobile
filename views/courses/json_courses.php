<?php
// Copyright (C) 2013  Nils Bussmann

// This program is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.

// This program is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
// GNU General Public License for more details.

// You should have received a copy of the GNU General Public License
// along with this program. If not, see <http://www.gnu.org/licenses/>.


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