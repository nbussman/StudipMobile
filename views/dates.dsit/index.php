<?
$this->set_layout("layouts/single_page");
$page_title = "Stud.IP - Meine Termine";
$page_id = "dates-index";
?>

<? if (empty($dates)) : ?>
<h1><?= _('Keine Termine vorhanden!') ?></h1>
<? else : ?>
<ul id="dates" data-role="listview" data-filter="true" data-filter-placeholder="Suchen">
    <? foreach ($dates as $date) : ?>
    <li class="dates ui-btn" data-dates="<?= $date['id'] ?>">
        <a href="#">
        <?= Assets::img('icons/16/blue/schedule.png', array('class' => 'ui-li-icon')) ?>

        <?= strftime('%x', $date['start']) ?>,
            <?= date('H:i', $date['start']) ?> -
            <?= date('H:i', $date['end']) ?>

        <? if ($date['room']) : ?>
        - <?= htmlReady($date['room']) ?>
        <? endif ?>
        <br>

        <? if ($date['semname']) : ?>
        <strong><?= htmlReady($date['semname']) ?></strong><br>
        <?= htmlReady($date['title']) ?>
        <? else : ?>
        <strong><?= htmlReady($date['title']) ?></strong>
        <? endif ?>
        </a>
    </li>
    <? endforeach ?>
</ul>
<? endif ?>