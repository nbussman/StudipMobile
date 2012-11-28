<?
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


<div data-role="page" id="landing">

	<div data-role="header" data-position="fixed" data-theme="e" data-fullscreen="true">       
		<a href="<?= $controller->url_for("quickdial") ?>" class="externallink" data-icon="grid" data-iconpos="notext" data-theme="c"><?=_("Menu")?></a>          
		<h1>Stundenplan</h1>
	</div>

	<div data-role="content" class="content">
		<div class="ui-grid-a">
			<div class="ui-block-a"> <div class="calendar_year"><?=Helper::get_weekday($weekday) ?></div> </div>
			<div class="ui-block-b"> <div style="text-align:right;">
				<div data-role="controlgroup" data-type="horizontal" data-mini="true" >
					<a href="<?= $controller->url_for("calendar/index", htmlReady( ($weekday==1)?6:($weekday-1) )) ?>" data-role="button" data-iconpos="notext" data-icon="arrow-l">left</a>
					<a href="<?= $controller->url_for("calendar/index", htmlReady( ($weekday==6)?1:($weekday+1) )) ?>" data-role="button" data-iconpos="notext" data-icon="arrow-r">right</a>
				</div>
			</div></div>
		</div>
		
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
							//var_dump($termin);
							$link = $controller->url_for("courses/show", htmlReady(substr($termin['id'],0,32)));
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
  

	<div data-role="footer" data-id="mainFooter" data-position="fixed">
		<div data-role="navbar" data-grid="a">
			<ul class="apple-navbar-ui comboSprite">
				<li><a href="" data-iconpos="top" data-icon="cal"  class="ui-btn-active">Stundenplan</a></li>
				<li><a href="<?= $controller->url_for("calendar/kalender") ?>" data-iconpos="top" data-icon="cal"                         >Kalender</a></li>
			</ul>
		</div>
	</div>
</div>