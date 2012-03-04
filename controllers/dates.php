<?php

require "StudipMobileController.php";
require dirname(__FILE__) . "/../models/dates.php";

class DatesController extends StudipMobileController
{
    /**
     * custom before filter (see StudipMobileController#before_filter)
     */
    function before()
    {
        # require a logged in User or else redirect to session/new
        $this->requireUser();
    }

    function index_action()
    {
        // fetch the dates and pass them to the template
        $this->dates = Dates::findAll($this->currentUser()->id);
    }
}
