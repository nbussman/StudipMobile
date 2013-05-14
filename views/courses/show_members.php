<?
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

$this->set_layout("layouts/single_page_back");
$page_title = "Teilnehmer";
$page_id = "courses-show_members";

//rolle
$status = '';
?>



<ul id="courses" data-role="listview" data-filter="true" data-filter-placeholder="Suchen" data-divider-theme="d" >
<?
	foreach ($members AS $member)   
	{
		if ($status != $member['status'])
		{
		$status=$member['status'];
		?>
			<li data-role="list-divider">
	         <?=ucfirst(htmlReady($member['status'])) ?>
	        </li>
	    <?
		}
		?>
        <li>
	        <a href=" <?= $controller->url_for("profiles/show", htmlReady($member['user_id'])) ?>" class="externallink" data-ajax="false">
		        <img src="<?= $controller->url_for("avatars/show", $member['user_id'], 'medium') ?>" class="ui-li-thumb">
		        <h3><?=htmlReady($member["title_front"]) ?> <?=htmlReady($member['Vorname']) ?>  <?=htmlReady($member['Nachname'])?> </h3>
		    </a>
        </li>
    <?
    }
    ?>
</ul>