<?php

$this->set_layout("layouts/mail_list");
$page_title = "Eingang";
$page_id = "mails-index";

if (sizeof($inbox)) 
{
        echo $this->render_partial('mails/list_in.php');
}
else
{
        ?>
        <p>Sie haben zur Zeit keine Nachrichten</p>
        <?
}
?>
