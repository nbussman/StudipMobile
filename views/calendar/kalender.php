<?
$this->set_layout("layouts/calendar");
$page_title = "Kalender";
$page_id = "calendar-kalender";


$month = date("n",$stamp);
$day = date("j");
$year = date("Y",$stamp);
$daysOfMonth = date("t",$stamp);
	
?>
<div data-role="page" id="calendar">

	<div data-role="header" data-theme="e">       
		<a href="<?= $controller->url_for("quickdial") ?>" class="externallink" data-ajax="false" data-icon="grid" data-iconpos="notext" data-theme="c"><?=_("Menu")?></a>          
		<h1>Kalender</h1>
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
		
		<table border=0 cellspacing=0 class="calendar">
			<tr>
				<td class="<?echo ($day==1) ? "calendar_cell_active":"calendar_cell_inactive"; ?>" onClick="self.location.href='<?= $controller->url_for("calendar/kalender",htmlReady($year-1), htmlReady($month)) ?>#day1'">
					<center>
					<?
						for ($i = 1; $i <= $dots[1]; $i++)
						{
							if ($i >= 4)	break;
						
							?> <img src="<?= $plugin_path ?>/public/images/icons/calendar_dot.png"> <?
						}
					?>
					</center>
					1
				</td>	
				<td class="<?echo ($day==2) ? "calendar_cell_active":"calendar_cell_inactive"; ?>"  onClick="self.location.href='<?= $controller->url_for("calendar/kalender",htmlReady($year-1), htmlReady($month)) ?>#day2'">
					<center>
					<?
						for ($i = 1; $i <= $dots[2]; $i++)
						{
							if ($i >= 4)	break;
						
							?> <img src="<?= $plugin_path ?>/public/images/icons/calendar_dot.png"> <?
						}
					?>
					</center>2</td>
				<td class="<?echo ($day==3) ? "calendar_cell_active":"calendar_cell_inactive"; ?>"  onClick="self.location.href='<?= $controller->url_for("calendar/kalender",htmlReady($year-1), htmlReady($month)) ?>#day3'">
					<center>
					<?
						for ($i = 1; $i <= $dots[3]; $i++)
						{
							if ($i >= 4)	break;
						
							?> <img src="<?= $plugin_path ?>/public/images/icons/calendar_dot.png"> <?
						}
					?>					</center>3</td>
				<td class="<?echo ($day==4) ? "calendar_cell_active":"calendar_cell_inactive"; ?>"  onClick="self.location.href='<?= $controller->url_for("calendar/kalender",htmlReady($year-1), htmlReady($month)) ?>#day4'">
					<center>
						<?
						for ($i = 1; $i <= $dots[4]; $i++)
						{
							if ($i >= 4)	break;
						
							?> <img src="<?= $plugin_path ?>/public/images/icons/calendar_dot.png"> <?
						}
					?>	
					</center>4</td>
				<td class="<?echo ($day==5) ? "calendar_cell_active":"calendar_cell_inactive"; ?>"  onClick="self.location.href='<?= $controller->url_for("calendar/kalender",htmlReady($year-1), htmlReady($month)) ?>#day5'">
					<center>
						<?
						for ($i = 1; $i <= $dots[5]; $i++)
						{
							if ($i >= 4)	break;
						
							?> <img src="<?= $plugin_path ?>/public/images/icons/calendar_dot.png"> <?
						}
					?>	
					</center>5</td>
				<td class="<?echo ($day==6) ? "calendar_cell_active":"calendar_cell_inactive"; ?>"  onClick="self.location.href='<?= $controller->url_for("calendar/kalender",htmlReady($year-1), htmlReady($month)) ?>#day6'">
					<center>
						<?
						for ($i = 1; $i <= $dots[6]; $i++)
						{
							if ($i >= 4)	break;
						
							?> <img src="<?= $plugin_path ?>/public/images/icons/calendar_dot.png"> <?
						}
					?>	
					</center>6</td>
				<td class="<?echo ($day==7) ? "calendar_cell_active":"calendar_cell_inactive"; ?>"  onClick="self.location.href='<?= $controller->url_for("calendar/kalender",htmlReady($year-1), htmlReady($month)) ?>#day7'">
					<center>
						<?
						for ($i = 1; $i <= $dots[7]; $i++)
						{
							if ($i >= 4)	break;
						
							?> <img src="<?= $plugin_path ?>/public/images/icons/calendar_dot.png"> <?
						}
					?>	
					</center>7</td>
			</tr>												  
			<tr>
				<td class="<?echo ($day==8) ? "calendar_cell_active":"calendar_cell_inactive"; ?>"  onClick="self.location.href='<?= $controller->url_for("calendar/kalender",htmlReady($year-1), htmlReady($month)) ?>#day8'">
					<center>
						<?
						for ($i = 1; $i <= $dots[8]; $i++)
						{
							if ($i >= 4)	break;
						
							?> <img src="<?= $plugin_path ?>/public/images/icons/calendar_dot.png"> <?
						}
					?>	
					</center>8</td>	
				<td class="<?echo ($day==9) ? "calendar_cell_active":"calendar_cell_inactive"; ?>"  onClick="self.location.href='<?= $controller->url_for("calendar/kalender",htmlReady($year-1), htmlReady($month)) ?>#day9'">
					<center>
						<?
						for ($i = 1; $i <= $dots[9]; $i++)
						{
							if ($i >= 4)	break;
						
							?> <img src="<?= $plugin_path ?>/public/images/icons/calendar_dot.png"> <?
						}
					?>	
					</center>9</td>
				<td class="<?echo ($day==10) ? "calendar_cell_active":"calendar_cell_inactive"; ?>" onClick="self.location.href='<?= $controller->url_for("calendar/kalender",htmlReady($year-1), htmlReady($month)) ?>#day10'">
					<center>
						<?
						for ($i = 1; $i <= $dots[10]; $i++)
						{
							if ($i >= 4)	break;
						
							?> <img src="<?= $plugin_path ?>/public/images/icons/calendar_dot.png"> <?
						}
					?>	
					</center>10</td>
				<td class="<?echo ($day==11) ? "calendar_cell_active":"calendar_cell_inactive"; ?>" onClick="self.location.href='<?= $controller->url_for("calendar/kalender",htmlReady($year-1), htmlReady($month)) ?>#day11'">
					<center>
						<?
						for ($i = 1; $i <= $dots[11]; $i++)
						{
							if ($i >= 4)	break;
						
							?> <img src="<?= $plugin_path ?>/public/images/icons/calendar_dot.png"> <?
						}
					?>	
					</center>11</td>
				<td class="<?echo ($day==12) ? "calendar_cell_active":"calendar_cell_inactive"; ?>" onClick="self.location.href='<?= $controller->url_for("calendar/kalender",htmlReady($year-1), htmlReady($month)) ?>#day12'">
					<center>
						<?
						for ($i = 1; $i <= $dots[12]; $i++)
						{
							if ($i >= 4)	break;
						
							?> <img src="<?= $plugin_path ?>/public/images/icons/calendar_dot.png"> <?
						}
					?>	
					</center>12</td>
				<td class="<?echo ($day==13) ? "calendar_cell_active":"calendar_cell_inactive"; ?>" onClick="self.location.href='<?= $controller->url_for("calendar/kalender",htmlReady($year-1), htmlReady($month)) ?>#day13'">
					<center>
						<?
						for ($i = 1; $i <= $dots[13]; $i++)
						{
							if ($i >= 4)	break;
						
							?> <img src="<?= $plugin_path ?>/public/images/icons/calendar_dot.png"> <?
						}
					?>	
					</center>13</td>
				<td class="<?echo ($day==14) ? "calendar_cell_active":"calendar_cell_inactive"; ?>" onClick="self.location.href='<?= $controller->url_for("calendar/kalender",htmlReady($year-1), htmlReady($month)) ?>#day14'">
					<center>
						<?
						for ($i = 1; $i <= $dots[14]; $i++)
						{
							if ($i >= 4)	break;
						
							?> <img src="<?= $plugin_path ?>/public/images/icons/calendar_dot.png"> <?
						}
					?>	
					</center>14</td>
			</tr>
			<tr>
				<td class="<?echo ($day==15) ? "calendar_cell_active":"calendar_cell_inactive"; ?>" onClick="self.location.href='<?= $controller->url_for("calendar/kalender",htmlReady($year-1), htmlReady($month)) ?>#day15'">
					<center>
						<?
						for ($i = 1; $i <= $dots[15]; $i++)
						{
							if ($i >= 4)	break;
						
							?> <img src="<?= $plugin_path ?>/public/images/icons/calendar_dot.png"> <?
						}
					?>	
					</center>15</td>	
				<td class="<?echo ($day==16) ? "calendar_cell_active":"calendar_cell_inactive"; ?>" onClick="self.location.href='<?= $controller->url_for("calendar/kalender",htmlReady($year-1), htmlReady($month)) ?>#day16'">
					<center>
						<?
						for ($i = 1; $i <= $dots[16]; $i++)
						{
							if ($i >= 4)	break;
						
							?> <img src="<?= $plugin_path ?>/public/images/icons/calendar_dot.png"> <?
						}
					?>	
					</center>16</td>
				<td class="<?echo ($day==17) ? "calendar_cell_active":"calendar_cell_inactive"; ?>" onClick="self.location.href='<?= $controller->url_for("calendar/kalender",htmlReady($year-1), htmlReady($month)) ?>#day17'">
					<center>
						<?
						for ($i = 1; $i <= $dots[17]; $i++)
						{
							if ($i >= 4)	break;
						
							?> <img src="<?= $plugin_path ?>/public/images/icons/calendar_dot.png"> <?
						}
					?>	
					</center>17</td>
				<td class="<?echo ($day==18) ? "calendar_cell_active":"calendar_cell_inactive"; ?>" onClick="self.location.href='<?= $controller->url_for("calendar/kalender",htmlReady($year-1), htmlReady($month)) ?>#day18'">
					<center>
						<?
						for ($i = 1; $i <= $dots[18]; $i++)
						{
							if ($i >= 4)	break;
						
							?> <img src="<?= $plugin_path ?>/public/images/icons/calendar_dot.png"> <?
						}
					?>	
					</center>18</td>
				<td class="<?echo ($day==19) ? "calendar_cell_active":"calendar_cell_inactive"; ?>" onClick="self.location.href='<?= $controller->url_for("calendar/kalender",htmlReady($year-1), htmlReady($month)) ?>#day19'">
					<center>
						<?
						for ($i = 1; $i <= $dots[19]; $i++)
						{
							if ($i >= 4)	break;
						
							?> <img src="<?= $plugin_path ?>/public/images/icons/calendar_dot.png"> <?
						}
					?>	
					</center>19</td>
				<td class="<?echo ($day==20) ? "calendar_cell_active":"calendar_cell_inactive"; ?>" onClick="self.location.href='<?= $controller->url_for("calendar/kalender",htmlReady($year-1), htmlReady($month)) ?>#day20'">
					<center>
						<?
						for ($i = 1; $i <= $dots[20]; $i++)
						{
							if ($i >= 4)	break;
						
							?> <img src="<?= $plugin_path ?>/public/images/icons/calendar_dot.png"> <?
						}
					?>	
					</center>20</td>
				<td class="<?echo ($day==21) ? "calendar_cell_active":"calendar_cell_inactive"; ?>" onClick="self.location.href='<?= $controller->url_for("calendar/kalender",htmlReady($year-1), htmlReady($month)) ?>#day21'">
					<center>
						<?
						for ($i = 1; $i <= $dots[21]; $i++)
						{
							if ($i >= 4)	break;
						
							?> <img src="<?= $plugin_path ?>/public/images/icons/calendar_dot.png"> <?
						}
					?>	
					</center>21</td>
			</tr>
			<tr>
				<td class="<?echo ($day==22) ? "calendar_cell_active":"calendar_cell_inactive"; ?>" onClick="self.location.href='<?= $controller->url_for("calendar/kalender",htmlReady($year-1), htmlReady($month)) ?>#day22'">
					<center>
						<?
						for ($i = 1; $i <= $dots[22]; $i++)
						{
							if ($i >= 4)	break;
						
							?> <img src="<?= $plugin_path ?>/public/images/icons/calendar_dot.png"> <?
						}
					?>	
					</center>22</td>	
				<td class="<?echo ($day==23) ? "calendar_cell_active":"calendar_cell_inactive"; ?>" onClick="self.location.href='<?= $controller->url_for("calendar/kalender",htmlReady($year-1), htmlReady($month)) ?>#day23'">
					<center>
						<?
						for ($i = 1; $i <= $dots[23]; $i++)
						{
							if ($i >= 4)	break;
						
							?> <img src="<?= $plugin_path ?>/public/images/icons/calendar_dot.png"> <?
						}
					?>	
					</center>23</td>
				<td class="<?echo ($day==24) ? "calendar_cell_active":"calendar_cell_inactive"; ?>" onClick="self.location.href='<?= $controller->url_for("calendar/kalender",htmlReady($year-1), htmlReady($month)) ?>#day24'">
					<center>
						<?
						for ($i = 1; $i <= $dots[24]; $i++)
						{
							if ($i >= 4)	break;
						
							?> <img src="<?= $plugin_path ?>/public/images/icons/calendar_dot.png"> <?
						}
					?>	
					</center>24</td>
				<td class="<?echo ($day==25) ? "calendar_cell_active":"calendar_cell_inactive"; ?>" onClick="self.location.href='<?= $controller->url_for("calendar/kalender",htmlReady($year-1), htmlReady($month)) ?>#day25'">
					<center>
						<?
						for ($i = 1; $i <= $dots[25]; $i++)
						{
							if ($i >= 4)	break;
						
							?> <img src="<?= $plugin_path ?>/public/images/icons/calendar_dot.png"> <?
						}
					?>	
					</center>25</td>
				<td class="<?echo ($day==26) ? "calendar_cell_active":"calendar_cell_inactive"; ?>" onClick="self.location.href='<?= $controller->url_for("calendar/kalender",htmlReady($year-1), htmlReady($month)) ?>#day26'">
					<center>
						<?
						for ($i = 1; $i <= $dots[26]; $i++)
						{
							if ($i >= 4)	break;
						
							?> <img src="<?= $plugin_path ?>/public/images/icons/calendar_dot.png"> <?
						}
					?>	
					</center>26</td>
				<td class="<?echo ($day==27) ? "calendar_cell_active":"calendar_cell_inactive"; ?>" onClick="self.location.href='<?= $controller->url_for("calendar/kalender",htmlReady($year-1), htmlReady($month)) ?>#day27'">
					<center>
						<?
						for ($i = 1; $i <= $dots[27]; $i++)
						{
							if ($i >= 4)	break;
						
							?> <img src="<?= $plugin_path ?>/public/images/icons/calendar_dot.png"> <?
						}
					?>	
					</center>27</td>
				<td class="<?echo ($day==28) ? "calendar_cell_active":"calendar_cell_inactive"; ?>" onClick="self.location.href='<?= $controller->url_for("calendar/kalender",htmlReady($year-1), htmlReady($month)) ?>#day28'">
					<center>
						<?
						for ($i = 1; $i <= $dots[28]; $i++)
						{
							if ($i >= 4)	break;
						
							?> <img src="<?= $plugin_path ?>/public/images/icons/calendar_dot.png"> <?
						}
					?>	
					</center>28</td>
			</tr>
			<tr>
				<?
					if ($daysOfMonth > 28){
						?><td class="<?echo ($day==29) ? "calendar_cell_active":"calendar_cell_inactive"; ?>" onClick="self.location.href='<?= $controller->url_for("calendar/kalender",htmlReady($year-1), htmlReady($month)) ?>#day29'">
					<center>
						<?
						for ($i = 1; $i <= $dots[29]; $i++)
						{
							if ($i >= 4)	break;
						
							?> <img src="<?= $plugin_path ?>/public/images/icons/calendar_dot.png"> <?
						}
					?>	
					</center>29</td> <?
					}
					if ($daysOfMonth > 29){
						?><td class="<?echo ($day==30) ? "calendar_cell_active":"calendar_cell_inactive"; ?>" onClick="self.location.href='<?= $controller->url_for("calendar/kalender",htmlReady($year-1), htmlReady($month)) ?>#day30'">
					<center>
						<?
						for ($i = 1; $i <= $dots[30]; $i++)
						{
							if ($i >= 4)	break;
						
							?> <img src="<?= $plugin_path ?>/public/images/icons/calendar_dot.png"> <?
						}
					?>	
					</center>30</td> <?
					}
					if ($daysOfMonth > 30){
						?><td class="<?echo ($day==31) ? "calendar_cell_active":"calendar_cell_inactive"; ?>" onClick="self.location.href='<?= $controller->url_for("calendar/kalender",htmlReady($year-1), htmlReady($month)) ?>#day31'">
					<center>
						<?
						for ($i = 1; $i <= $dots[31]; $i++)
						{
							if ($i >= 4)	break;
						
							?> <img src="<?= $plugin_path ?>/public/images/icons/calendar_dot.png"> <?
						}
					?>	
					</center>31</td> <?
					}
				?>
				<td class="calendar_cell_inactive"></td>
				<td class="calendar_cell_inactive"></td>
				<td class="calendar_cell_inactive"></td>
				<td class="calendar_cell_inactive"></td>
			</tr>
		</table>						
	</div>
  

	<div data-role="footer" data-id="mainFooter" data-position="fixed" style="position:absolute;bottom:0px;">
		<div data-role="navbar" data-grid="a">
			<ul class="apple-navbar-ui comboSprite">
				<li><a href="<?= $controller->url_for("calendar") ?>" data-iconpos="top" data-icon="calendar"  >Stundenplan</a></li>
				<li><a href="#" data-iconpos="top" data-icon="calendar" class="ui-btn-active">Kalender</a></li>
			</ul>
		</div>
	</div>
</div>
<div data-role="page" id="day1">

	<div data-role="header" data-position="fixed" data-theme="e" data-fullscreen="true">       
		<a href="#calendar" class="externallink" data-ajax="false" data-icon="arrow-l" data-iconpos="notext" data-theme="c"><?=_("back")?></a>          
		<h1>1.<?=$month ?>.<?=$year ?> </h1>
	</div>

	<div data-role="content" class="content">
		<div class="calendar_time">10:00 - 12:00:</div>
		<div class="calendar_bubble">Termina A ... B ...C</div>
		
		<div class="calendar_time">12:00 - 14:00:</div>
		<div class="calendar_bubble">Termin B .. C ... D</div>	   	   
		
	</div>
 

	<div data-role="footer" data-id="mainFooter" data-position="fixed" style="position:absolute;bottom:0px;">
		<div data-role="navbar" data-grid="a">
			<ul class="apple-navbar-ui comboSprite">
				<li><a href="<?= $controller->url_for("calendar") ?>" data-iconpos="top" data-icon="calendar"  >Stundenplan</a></li>
				<li><a href="<?= $controller->url_for("calendar/kalender") ?>" data-iconpos="top" data-icon="calendar" class="ui-btn-active">Kalender</a></li>
			</ul>
		</div>
	</div>
</div>