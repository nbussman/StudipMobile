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

$this->set_layout("layouts/quickdial");
$page_title = _("Uni Osnabrück");

?>
      
      <div class="ui-grid-b" >
          <div class="ui-block-a grid">
            <a href="<?= $controller->url_for("activities") ?>" class="externallink" data-ajax="false">
              <img class="icon" src="<?= $plugin_path ?>/public/images/quickdial/news.png" /><br />
              <span>News</span>
            </a>
          </div>
          <div class="ui-block-b grid">
            <a href="<?= $controller->url_for("calendar") ?>"  class="externallink" data-ajax="false">
              <img class="icon" src="<?= $plugin_path ?>/public/images/quickdial/schedule.png" /><br />
              <span>Planer</span>
            </a>
          </div>
          <div class="ui-block-c grid">
            <a href="<?= $controller->url_for("mails") ?>/" class="externallink" data-ajax="false">
	      <?
	      	if ($number_unread_mails > 0)
		{ 
			?>
			<span class="notification"><?= $number_unread_mails ?></span>
			<?
		}
		?>
              <img class="icon" src="<?= $plugin_path ?>/public/images/quickdial/mail.png" /><br />
              <span>Nachrichten</span>              
            </a>
          </div>
          
          <div class="ui-block-a grid scndrow">
            <a href="<?= $controller->url_for("courses") ?>" class="externallink" rel="external" data-ajax="false">
              <img class="icon" src="<?= $plugin_path ?>/public/images/quickdial/seminar.png" /><br />
              <span>Kurse</span>
            </a>
          </div>
          <!-- <div class="ui-block-b grid scndrow">
            <a href="<?= $controller->url_for("courses/dropAll") ?>">
              <img class="icon" src="<?= $plugin_path ?>/public/images/quickdial/dropbox.png" /><br />
              <span>DropFiles</span>
            </a>
          </div> -->
          <div class="ui-block-c grid scndrow">
            <a href="<?= $controller->url_for("profiles/show",htmlReady($user_id)) ?>"  
               class="externallink" rel="external" data-ajax="false">
              <img class="icon" src="<?= $plugin_path ?>/public/images/quickdial/profile.png" /><br />
              <span>Ich</span>
            </a>
          </div>
          <div></div>
      </div>
      <div style="width:70%;height:15px;"></div>
    <?

	if (!empty($next_courses))
	{
		?>
			<ul id="nextCourses" data-role="listview" data-inset="true" data-theme="c">
				<li data-role="list-divider" data-theme="b">Als Nächstes</li>
		<?
	}
    foreach($next_courses as $next)
	{	
		?>
				<li>
					<?
						if (strlen($next["id"]) == 32) 
            {
              $this_link = $controller->url_for("courses/show", htmlReady($next["id"]));
            }
						else 	$this_link = "";
					?>
						<a href="<?=$this_link ?>" data-ajax='false'>
						<p><strong><?=Helper::get_weekday($next["weekday"]) ?></strong> <?=htmlReady($next["title"]) ?></p>
						<p>
							<?=htmlReady($next["description"]) ?>
						    <span class="ui-li-count">
						    	<?=htmlReady($next["beginn"])?> - <?=htmlReady($next["ende"])?>
						    </span>
						</p>
						</a>
				</li>
		<?
	}
	if (!empty($next_courses))
	{
		?>
			</ul>
		<?
	}
    ?>

    
