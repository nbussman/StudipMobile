<?php
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

require "StudipMobileController.php";
require dirname(__FILE__) . "/../models/quickdail.php";

use Studip\Mobile\Quickdail;

/**
 *    The Start Screen of studipmobile
 *    @author Nils Bussmann - nbussman@uos.de
 *    @author Marcus Lunzenauer - mlunzena@uos.de
 *    @author André Klaßen - aklassen@uos.de
 */
class QuickdialController extends StudipMobileController
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
	// get next 5 courses of the day
	$this->next_courses 		=	Quickdail::get_next_courses( $this->currentUser()->id );
	$this->user_id 	  	= $this->currentUser()->id;
        

	// get numbers of new mails
	$this->number_unread_mails 	=	Quickdail::get_number_unread_mails( $this->currentUser()->id );

	
    }
}
