<?php
$groups = array();
foreach ($courses as $course) {
    if (!isset($groups[$course['sem_number']])) {
        $groups[$course['sem_number']] = array();
    }
    $groups[$course['sem_number']][] = $course;
}
arsort($groups);

?>

<ul id="courses" data-role="listview" data-filter="true" data-divider-theme="d">
    <? foreach ($groups as $sem_key => $group) { ?>
        <li data-role="list-divider">
             <?= htmlReady($semester[$sem_key]['name']) ?>
        </li>
        <? foreach ($group as $course) { ?>

            <li class="course" data-course="<?= htmlReady($course['Seminar_id']) ?>">
                <a href="<?= $controller->url_for("courses/show", htmlReady($course['Seminar_id'])) ?>"  rel="external">
                    <?
                        Helper::getColorball($course["color"]);
                    ?>
                    <h3><?= htmlReady($course['Name']) ?></h3>
                </a>
            </li>
        <? } ?>
    <? } ?>
</ul>