<?php

require "StudipMobileController.php";
require dirname(__FILE__) . "/../models/profile.php";

use Studip\Mobile\Activity;

class ProfilesController extends StudipMobileController
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
<<<<<<< HEAD
    }
    function show_action ($id=null)
    {
	    $this->profile = Profile::finduser( $id );
=======
        $this->profile = Profile::finduser( $this->currentUser()->id );
>>>>>>> 3f9395817e821753bae80db600cc893a89fcd3dc
    }
}
