<?php

$this->set_layout("layouts/mail_list");
$page_title = "Eingang";
$page_id = "mails-index";

        echo $this->render_partial('mails/list_in.php');

?>
