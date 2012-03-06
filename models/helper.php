<?php
namespace Studip\Mobile;

class Helper {
        function stamp_to_dat( $timestamp )
        {
                $weekday = date("N",$timestamp);
                $date    = date(j.m.Y);
                return $date;
        }
        function get_weekday( $day )
        {
                switch ( $day )
                {
                        case 1:
                                $ausgabe = "Montag";
                                break;
                        case 2:
                                $ausgabe = "Dienstag";
                                break;
                        case 3:
                                $ausgabe = "Mittwoch";
                                break;
                        case 4:
                                $ausgabe = "Donnerstag";
                                break;
                        case 5:
                                $ausgabe = "Freitag";
                                break;
                        case 6:
                                $ausgabe = "Samstag";
                                break;
                        case 7:
                                $ausgabe = "Sonntag";
                                break;
                }
                return $ausgabe;
        }
}
