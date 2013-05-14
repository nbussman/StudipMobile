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


$groups = array();
foreach ($courses as $course) {
    if (!isset($groups[$course['sem_number']])) {
        $groups[$course['sem_number']] = array();
    }
    $groups[$course['sem_number']][] = $course;
}
arsort($groups);
$groups = array_reverse($groups,true);
?>

<ul id="courses" data-role="listview" data-filter="true" data-filter-placeholder="Suchen" data-divider-theme="d">
    <? foreach ($groups as $sem_key => $group) { ?>
        <li data-role="list-divider">
             <?= htmlReady($semester[$sem_key]['name']) ?>
        </li>
        <? foreach ($group as $course) { ?>

            <li class="course" data-course="<?= htmlReady($course['Seminar_id']) ?>">
                <a href="<?= $controller->url_for("courses/show", htmlReady($course['Seminar_id'])) ?>"  class="externallink" data-ajax="false">
                    <?
                        Helper::getColorball($course["color"]);
                    ?>
                    <h3><?= htmlReady($course['Name']) ?></h3>
                </a>
            </li>
        <? } ?>
    <? } ?>
</ul>
