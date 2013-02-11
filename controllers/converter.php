<?php

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