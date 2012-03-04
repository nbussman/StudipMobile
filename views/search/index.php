<?php

$this->set_layout("layouts/single_page");
$page_title = "Suchen";
$page_id = "search-index";

?>
        <div data-role="collapsible" data-collapsed="false">
        				<h3>Suchformular</h3>
        				<ul data-role="listview" data-inset="true">
        					<li data-role="fieldcontain" style="display:none">
        						<select name="select-choice-a" id="select-choice-a" data-native-menu="true">
        							<option value="standard">Veranstaltung</option>
        							<option value="rush">Person</option>
        							<option value="express">Raum</option>
        						</select>
        					</li>
        					<li data-role="fieldcontain">
        								    <fieldset data-role="controlgroup">
        								    	<legend>Was sucht du</legend>
        								         	<input type="radio" name="radio-choice-1" id="radio-choice-1" value="choice-1" checked="checked" />
        								         	<label for="radio-choice-1">Veranstaltung</label>

        								         	<input type="radio" name="radio-choice-1" id="radio-choice-2" value="choice-2"  />
        								         	<label for="radio-choice-2">Person</label>

        								         	<input type="radio" name="radio-choice-1" id="radio-choice-3" value="choice-3"  />
        								         	<label for="radio-choice-3">Ort / Raum</label>
        								    </fieldset>
        								</li>
        					<li data-role="fieldcontain">
        						<label for="search">Suchfeld</label>
        						<input type="search" name="search" id="search" value="" />
        					</li>
        					<li class="ui-body ui-body-b">
        						<fieldset class="ui-grid-a">
        							<div class="ui-block-a"><button type="submit" data-theme="d">Abbrechen</button></div>
        							<div class="ui-block-b"><button type="submit" data-theme="a">Suchen</button></div>
        						</fieldset>
        					</li>
        				</ul>
        			</div>
        			<div data-role="collapsible" data-collapsed="true">
        				<h3>Suchergebnisse</h3>
        				<ul data-role="listview" style="display:none">
        										<li><a href="index.html">
        											<img src="images/experiment.jpg" />
        											<h3>8.15 - 9.45 Experimentalphysik 3</h3>
        											<p>Gebäude 43 - Raum 210 </p>
        										</a></li>
        										<li><a href="index.html">
        											<img src="images/infoa.jpg" />
        											<h3>10.15 - 11.45 Informatik A</h3>
        											<p>Gebäude 43 - Raum 210 </p>
        										</a></li>
        										<li><a href="index.html">
        											<img src="images/experiment.jpg" />
        											<h3>14.15 - 15.45 Experimentalphysik 1</h3>
        											<p>Hot Chip</p>
        										</a></li>
        				</ul>
        				<ul data-role="listview">
        										<li><a href="#">
        											<img src="<?= $plugin_path ?>/public/images/courses/experiment.jpg" />
        											<h3>Keine Treffer</h3>
        											<p>Versuche es mit Platzhaltern</p>
        										</a></li>
        				</ul>
        			</div>
