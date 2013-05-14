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

/**
 *    just a few helfull functions
 *    @author Nils Bussmann - nbussman@uos.de
 */
class ConverterController extends StudipMobileController
{
    /**
     * custom before filter (see StudipMobileController#before_filter)
     */
    function before()
    {
            # require a logged in User or else redirect to session/new
            $this->requireUser();
    }

    /*
     * converts a given unix timestamp to
     * a string representing this date
     * @ param $timestamp the unix timecode
     * @ return string representing the day
     */
    function stamp_to_dat_action( $timestamp )
    {
        return Convert::stamp_to_dat( $timestamp );
    }
    
    /*
     * converts a day to a string 
     * like 1 => Montag
     * @param $day dayint
     * @return daystring
     */
    function int_to_day_action( $day)
    {
        
        return get_weekday( $day )
    }
}
?>