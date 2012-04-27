<?php


class Helper {
        function stamp_to_dat( $timestamp )
        {
                $date    = date("j.m.Y", $timestamp);
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
        function colourBrightness($hex, $percent) {
        	// Work out if hash given
        	$hash = '';
        	if (stristr($hex,'#')) {
        		$hex = str_replace('#','',$hex);
        		$hash = '#';
        	}
        	/// HEX TO RGB
        	$rgb = array(hexdec(substr($hex,0,2)), hexdec(substr($hex,2,2)), hexdec(substr($hex,4,2)));
        	//// CALCULATE
        	for ($i=0; $i<3; $i++) {
        		// See if brighter or darker
        		if ($percent > 0) {
        			// Lighter
        			$rgb[$i] = round($rgb[$i] * $percent) + round(255 * (1-$percent));
        		} else {
        			// Darker
        			$positivePercent = $percent - ($percent*2);
        			$rgb[$i] = round($rgb[$i] * $positivePercent) + round(0 * (1-$positivePercent));
        		}
        		// In case rounding up causes us to go to 256
        		if ($rgb[$i] > 255) {
        			$rgb[$i] = 255;
        		}
        	}
        	//// RBG to Hex
        	$hex = '';
        	for($i=0; $i < 3; $i++) {
        		// Convert the decimal digit to hex
        		$hexDigit = dechex($rgb[$i]);
        		// Add a leading zero if necessary
        		if(strlen($hexDigit) == 1) {
        		$hexDigit = "0" . $hexDigit;
        		}
        		// Append to the hex string
        		$hex .= $hexDigit;
        	}
        	return $hash.$hex;
        }
        
}
