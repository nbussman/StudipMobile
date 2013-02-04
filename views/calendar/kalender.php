<?
$this->set_layout("layouts/calendar");
$page_title = "Kalender";
$page_id = "calendar-kalender";


$month = date("n",$stamp);
$day = date("j");
$year = date("Y",$stamp);
$daysOfMonth = date("t",$stamp);
$startAt = date("N",$stamp) -1;
	
?>
<div data-role="page" id="calendar">

	<div data-role="header" data-theme="e">       
		<a href="<?= $controller->url_for("quickdial") ?>" class="externallink" data-ajax="false" data-icon="grid" data-iconpos="notext" data-theme="c"><?=_("Menu")?></a>          
		<h1>Kalender</h1>
		<a href="#popupMenu" data-rel="popup" data-role="button" data-inline="true">Planer</a>
		<div data-role="popup" id="popupMenu" data-theme="a">
				<ul data-role="listview" data-inset="true" style="min-width:210px;" data-theme="b">
					<li><a href="<?= $controller->url_for("calendar/index") ?>">Stundenplan</a></li>
					<li data-role="divider" data-theme="a">Kalender</li>
				</ul>
		</div>
	</div>

	<div data-role="content" class="content">
		<div class="ui-grid-a">
			<div class="ui-block-a"> <div class="calendar_year"><?=$year ?></div> </div>
			<div class="ui-block-b"> <div style="text-align:right;">
				<div data-role="controlgroup" data-type="horizontal" data-mini="true" >
					<a href="<?= $controller->url_for("calendar/kalender",htmlReady($year-1), htmlReady($month)) ?>" data-role="button" data-iconpos="notext" data-icon="arrow-l">left</a>
					<a href="<?= $controller->url_for("calendar/kalender",htmlReady($year+1), htmlReady($month)) ?>" data-role="button" data-iconpos="notext" data-icon="arrow-r">right</a>
				</div>
			</div></div>
		</div>
		
		<table border=0 cellspacing=0 class="calendar_month">
		<tr>
			<td class="<?echo ($month==1) ? "calendar_month_activ":"calendar_month_inactive"; ?>"   onclick="location.href='<?= $controller->url_for("calendar/kalender",htmlReady($year), htmlReady("1")) ?>'">JAN</td>
			<td class="<?echo ($month==2) ? "calendar_month_activ":"calendar_month_inactive" ; ?>"  onclick="location.href='<?= $controller->url_for("calendar/kalender",htmlReady($year), htmlReady("2")) ?>'">FEB</td>
			<td class="<?echo ($month==3) ? "calendar_month_activ":"calendar_month_inactive" ; ?>"  onclick="location.href='<?= $controller->url_for("calendar/kalender",htmlReady($year), htmlReady("3")) ?>'">MÄR</td>
			<td class="<?echo ($month==4) ? "calendar_month_activ":"calendar_month_inactive" ; ?>"  onclick="location.href='<?= $controller->url_for("calendar/kalender",htmlReady($year), htmlReady("4")) ?>'">APR</td>
			<td class="<?echo ($month==5) ? "calendar_month_activ":"calendar_month_inactive" ; ?>"  onclick="location.href='<?= $controller->url_for("calendar/kalender",htmlReady($year), htmlReady("5")) ?>'">MAI</td>
			<td class="<?echo ($month==6) ? "calendar_month_activ":"calendar_month_inactive" ; ?>"  onclick="location.href='<?= $controller->url_for("calendar/kalender",htmlReady($year), htmlReady("6")) ?>'">JUN</td>
		</tr><tr>																				    
			<td class="<?echo ($month==7) ? "calendar_month_activ":"calendar_month_inactive" ; ?>"  onclick="location.href='<?= $controller->url_for("calendar/kalender",htmlReady($year), htmlReady("7")) ?>'">JUL</td>
			<td class="<?echo ($month==8) ? "calendar_month_activ":"calendar_month_inactive" ; ?>"  onclick="location.href='<?= $controller->url_for("calendar/kalender",htmlReady($year), htmlReady("8")) ?>'">AUG</td>
			<td class="<?echo ($month==9) ? "calendar_month_activ":"calendar_month_inactive" ; ?>"  onclick="location.href='<?= $controller->url_for("calendar/kalender",htmlReady($year), htmlReady("9")) ?>'">SEP</td>
			<td class="<?echo ($month==10) ? "calendar_month_activ":"calendar_month_inactive" ; ?>" onclick="location.href='<?= $controller->url_for("calendar/kalender",htmlReady($year), htmlReady("10")) ?>'">OKT</td>
			<td class="<?echo ($month==11) ? "calendar_month_activ":"calendar_month_inactive" ; ?>" onclick="location.href='<?= $controller->url_for("calendar/kalender",htmlReady($year), htmlReady("11")) ?>'">NOV</td>
			<td class="<?echo ($month==12) ? "calendar_month_activ":"calendar_month_inactive" ; ?>" onclick="location.href='<?= $controller->url_for("calendar/kalender",htmlReady($year), htmlReady("12")) ?>'">DEZ</td>
		</tr>
		</table>
		<div style="width:100%;height:10px;"></div>
		
		<script type="text/javascript">
			 $(document).on('pageinit',function(event){
			 	$(".calendar_cell").on("click", function(event){
					document.location.href = "<?=$controller->url_for("calendar/kalender",htmlReady($year), htmlReady($month)) ?>"+"#day"+$(this).attr("title");
				})
			 });
			
		</script>

		<table border=0 cellspacing=0 class="calendar">
			<tr>
		<?
			$i  = 0;
			$jj = 0 - $startAt;
			while ( $i < $daysOfMonth )
			{
				$ii = $i+1;
				if (($i % 6) == 0)	echo "</tr><tr>";
				?>
				<td class="<? echo ($day==$ii) ? "calendar_cell_active":"calendar_cell_inactive"; ?> calendar_cell" onClick="self.location.href='<?= $controller->url_for("calendar/singleDay",htmlReady($year), htmlReady($month)) ?>#day<?=$ii ?>" title="<?=$ii ?>">
					<center>
					<?
						for ($j = 1; $j <= $dots[$ii]; $j++)
						{
							if ($j >= 4)	break;
						
							?> <img src="<?= $plugin_path ?>/public/images/icons/calendar_dot.png"> <?
						}
					?>
					</center>
					<?=$ii ?>
				</td>	
				<?
				$i++;
			}

		?>
			</tr>
		</table>

	</div>
  

	
</div>


<?
	// var_dump($dates);
	foreach ($dates as $key => $value) {
		?>
		<div data-role="page" id="day<?=$key ?>">

			<div data-role="header" data-theme="e">       
				<a href="#calendar" class="externallink" data-ajax="false" data-icon="arrow-l" data-iconpos="notext" data-theme="c"><?=_("back")?></a>          
				<h1><?=$key ?>.<?=$month ?>.<?=$year ?> </h1>
			</div>
			<div data-role="content" class="content">
			<?
			if ($value != NULL)
			{
				foreach ($value as $key2 => $value2) 
				{
					?>
					<div class="calendar_time"><?=$value2["start"] ?> - <?=$value2["end"] ?>:</div>
					<div class="calendar_bubble">
						<b><?=utf8_encode($value2["title"]) ?></b><br>
						<?=($value2["description"])?utf8_encode($value2["description"])."<br>":"" ?>
						<?=($value2["location"])?"Ort: ".utf8_encode($value2["location"]):"" ?>
					</div>
					<?
				}
			}
			else
			{
				?>
					<div class="calendar_bubble">
						<b>Keine Einträge</b>
					</div>
				<?
			}
			?>   
			</div>
		</div>
		<?
	}

?>
