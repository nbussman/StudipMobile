<?php

$this->set_layout("layouts/single_page_normal");
<<<<<<< HEAD
$page_title = "Kurse";
=======
$page_title = "Stud.IP - Courses";
>>>>>>> 3f9395817e821753bae80db600cc893a89fcd3dc
$page_id = "courses-index";

if (sizeof($courses)) {
    echo $this->render_partial('courses/_list.php');
} else { ?>
<p>Sie haben zur Zeit keine Veranstaltungen abonniert, an denen Sie teilnehmen können. Bitte nutzen Sie <a href="#">Veranstaltung suchen / hinzufügen</a> um neue Veranstaltungen aufzunehmen</p>
<? } ?>
