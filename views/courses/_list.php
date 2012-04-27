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
                <a href="<?= $controller->url_for("courses/show", htmlReady($course['Seminar_id'])) ?>">
                    <?
                        $color2 =htmlReady($course['color']);
                        $color1 =Helper::colourBrightness( htmlReady($course['color']) , 0.4);
                    ?>
                    <div style="
                            background-color:<?= $color1 ?>;
                            width:15px;
                            height:15px;
                            position:relative; 
                            top:10px;
                            margin-right:15px;
                            float:left;
                            -webkit-border-radius: 20px;border-radius: 20px;background-image: linear-gradient(left top, <?= $color1 ?> 25%,  <?=$color2 ?> 75%);
                            background-image: -o-linear-gradient(left top, <?= $color1 ?> 25%,  <?=$color2 ?> 75%);
                            background-image: -moz-linear-gradient(left top, <?= $color1 ?> 25%,  <?=$color2 ?> 75%);
                            background-image: -webkit-linear-gradient(left top, <?= $color1 ?> 25%,  <?=$color2 ?> 75%);
                            background-image: -ms-linear-gradient(left top, <?= $color1 ?> 25%,  <?=$color2 ?> 75%);
                            background-image: -webkit-gradient(
                            	linear,
                            	left top,
                            	right bottom,
                            	color-stop(0.3, <?= $color1 ?>),
                            	color-stop(0.75, <?=$color2 ?>)
                            );
"></div>
                    <h3><?= htmlReady($course['Name']) ?></h3>
                </a>
            </li>
        <? } ?>
    <? } ?>
</ul>
