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

$this->set_layout("layouts/calendar");
$page_title = "Planer";
$page_id = "calendar-index";

					
$month = date("n");
$day = date("j");
$year = date("Y");

/*
//just to improve
$weekday= date("N");
*/
?>

<div data-role="page" id="timetable">
	<? include dirname(__FILE__).'./../layouts/side_menu.php'; ?>

	<div data-role="header" data-theme="e">       
        <? include dirname(__FILE__).'./../layouts/side_menu_link.php'; ?>
		<h1>Stundenplan</h1>
		<a href="#popupMenu" data-rel="popup" data-role="button" data-inline="true">Planer</a>
		<div data-role="popup" id="popupMenu" data-theme="a">
				<ul data-role="listview" data-inset="true" style="min-width:210px;" data-theme="b">
					<li data-role="divider" data-theme="a">Stundenplan</li>
					<li><a href="<?= $controller->url_for("calendar/kalender") ?>">Kalender</a></li>
				</ul>
		</div>
	</div>

	<div data-role="content" class="content">
		<div class="calendar_year"><?=Helper::get_weekday($weekday) ?></div>
					
		<table border=0 cellspacing=0 class="calendar_month">
		<tr>
			<td class="<?echo ($weekday==1) ? "calendar_month_activ":"calendar_month_inactive"; ?>"  onclick="location.href='<?= $controller->url_for("calendar/index", htmlReady("1")) ?>'">MON</td>
			<td class="<?echo ($weekday==2) ? "calendar_month_activ":"calendar_month_inactive" ; ?>" onclick="location.href='<?= $controller->url_for("calendar/index", htmlReady("2")) ?>'">DIE</td>
			<td class="<?echo ($weekday==3) ? "calendar_month_activ":"calendar_month_inactive" ; ?>" onclick="location.href='<?= $controller->url_for("calendar/index", htmlReady("3")) ?>'">MIT</td>
			<td class="<?echo ($weekday==4) ? "calendar_month_activ":"calendar_month_inactive" ; ?>" onclick="location.href='<?= $controller->url_for("calendar/index", htmlReady("4")) ?>'">DON</td>
			<td class="<?echo ($weekday==5) ? "calendar_month_activ":"calendar_month_inactive" ; ?>" onclick="location.href='<?= $controller->url_for("calendar/index", htmlReady("5")) ?>'">FRE</td>
			<td class="<?echo ($weekday==6) ? "calendar_month_activ":"calendar_month_inactive" ; ?>" onclick="location.href='<?= $controller->url_for("calendar/index", htmlReady("6")) ?>'">SAM</td>
		</tr>
		</table>
		<div style="width:100%;height:20px;"></div>
		<?
			$no_entries = true;
			
			if (array_key_exists(($weekday-1), $termine))
			{
				if (array_key_exists("entries", $termine[$weekday-1]) )
				{
					$calendar_col = $termine[$weekday-1];
					
					$array= $calendar_col->sortEntries();
					if (array_key_exists("col_0", $array))
					{
						foreach($array["col_0"] as $termin )
						{
							if (strlen($termin['id']) >=32)
							{
								$link = $controller->url_for("courses/show", htmlReady(substr($termin['id'],0,32)));	
							}
							else
							{
								$link = "";
							}
							?>
							<div class="calendar_time" onclick="location.href='<?=$link ?>'">
									 
								<?=substr($termin["start"],0,2) ?>:<?=substr($termin["start"],2,2) ?> - 
								<?=substr($termin["end"],0,2) ?>:<?=substr($termin["end"],2,2) ?>:
							</div>
							<div class="calendar_bubble"  onclick="location.href='<?=$link ?>'">
								<strong><?=htmlReady($termin["content"]) ?> </strong>	
								<?=htmlReady($termin["title"]) ?>
							</div>	   
							<?
						}
						$no_entries=false;
					}
				}	
			}
			if ($no_entries == true)
			{
				?>
						<div class="calendar_bubble">Es sind keine Einträge vorhanden.</div>	   
				<?
			}
			
		?>
			
	</div>

</div>