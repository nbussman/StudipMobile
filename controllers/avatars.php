<?php

require "StudipMobileController.php";

class AvatarsController extends StudipMobileController
{
    /**
     * custom before filter (see StudipMobileController#before_filter)
     */
    function before()
    {
        # require a logged in User or else redirect to session/new
        $this->requireUser();
    }

    function show_action($id = NULL, $size = Avatar::SMALL)
    {
        $this->redirect(Avatar::getAvatar($id)->getURL($size));
    }
}
