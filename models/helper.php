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
        
        function getColorball($color, $size=15, $noColor=false)
        {
            if ($noColor)
            {
                 echo    '<div style="
                            width:'.$size.'px;
                            height:'.$size.'px;
                            position:relative; 
                            top:10px;
                            margin-right:15px;
                            float:left;"></div>
                            ';
            }
            else
            {
                    $color2 = htmlReady($color);
                    $color1 = Helper::colourBrightness( htmlReady($color) , 0.4);
                    echo    '<div style="
                            background-color:'.$color1.';
                            width:'.$size.'px;
                            height:'.$size.'px;
                            position:relative; 
                            top:10px;
                            margin-right:15px;
                            float:left;
                            -webkit-border-radius: 20px;border-radius: 20px;background-image: linear-gradient(left top, '.$color1.' 25%,  '.$color2.' 75%);
                            background-image: -o-linear-gradient(left top, '.$color1.' 25%,  '.$color2.' 75%);
                            background-image: -moz-linear-gradient(left top, '.$color1.' 25%,  '.$color2.' 75%);
                            background-image: -webkit-linear-gradient(left top, '.$color1.' 25%,  '.$color2.' 75%);
                            background-image: -ms-linear-gradient(left top, '.$color1.' 25%,  '.$color2.' 75%);
                            background-image: -webkit-gradient(
                            	linear,
                            	left top,
                            	right bottom,
                            	color-stop(0.3, '.$color1.'),
                            	color-stop(0.75, '.$color2.')
                            );"></div>
                            ';
            }
        }
        
        function filenameReplaceBadChars( $filename ) 
        {
             
             $patterns = array( 
               "/\\s/",  # Leerzeichen 
               "/\\&/",  # Kaufmaennisches UND 
               "/\\+/",  # Plus-Zeichen 
               "/\\</",  # < Zeichen 
               "/\\>/",  # > Zeichen 
               "/\\?/",  # ? Zeichen 
               "/\"/",   # " Zeichen 
               "/\\:/",  # : Zeichen 
               "/\\|/",  # | Zeichen 
               "/\\\\/",   # \ Zeichen 
               "/ä/",
               "/ö/",
               "/ü/",
               "/\\*/"   # * Zeichen 
             ); 
              
             $replacements = array( 
               "_", 
               "-", 
               "-", 
               "_", 
               "_", 
               "_", 
               "_", 
               "_", 
               "_", 
               "_", 
               "ae",
               "oe",
               "ue",
               "_", 
               ); 
               return preg_replace( $patterns, $replacements, $filename ); 
        }
        
        
        function endsWith($check, $endStr) {
                if (!is_string($check) || !is_string($endStr) || strlen($check)<strlen($endStr)) {
                    return false;
                }

                return (substr($check, strlen($check)-strlen($endStr), strlen($endStr)) === $endStr);
            }
}
