<!-- FOOTER -->
<div data-role="footer" data-id="footer" data-position="fixed" style="position:fixed;z-index:1000">
    <div data-role="navbar" data-iconspos="top">
                   <ul class="ui-grid-b">
                           <li class="ui-block-a"><a href="<?= $controller->url_for("mails/index") ?>" 
                               data-theme="c" data-icon="studip-inbox" data-transition="flip" 
                               class="externallink" data-ajax="false">Eingang</a></li>
                           <li class="ui-block-b"><a href="<?= $controller->url_for("mails/list_outbox") ?>" 
                               data-theme="c" data-icon="studip-shoebox"  data-transition="flip" 
                               class="externallink" data-ajax="false">Ausgang</a></li>
                           <li class="ui-block-c"><a href="<?= $controller->url_for("mails/write") ?>" 
                           	   data-theme="c" data-icon="studip-envelope" data-transition="slideup" 
                           	   class="externallink" data-ajax="false">Neu Nachricht</a></li>
                   </ul>
    </div>
</div>
<!-- END FOOTER -->