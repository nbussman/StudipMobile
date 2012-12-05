<?php


class Helper {
        static function stamp_to_dat( $timestamp )
        {
                $date    = date("j.m.Y", $timestamp);
                return $date;
        }
        
        static function get_weekday( $day )
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
        static function get_moth( $month )
        {
                switch ( $month )
                {
                        case 1:
                                $ausgabe = "Januar";
                                break;
                        case 2:
                                $ausgabe = "Februar";
                                break;
                        case 3:
                                $ausgabe = "März";
                                break;
                        case 4:
                                $ausgabe = "April";
                                break;
                        case 5:
                                $ausgabe = "Mail";
                                break;
                        case 6:
                                $ausgabe = "Juni";
                                break;
                        case 7:
                                $ausgabe = "Juli";
                                break;
                        case 8:
                                $ausgabe = "August";
                                break;
                        case 9:
                                $ausgabe = "September";
                                break;
                        case 10:
                                $ausgabe = "Oktober";
                                break;
                        case 11:
                                $ausgabe = "November";
                                break;
                        case 12:
                                $ausgabe = "Dezember";
                                break;
                }
                return $ausgabe;
        }

        
        public static function correctText($text)
        {
	        return Helper::url_to_link( studip_utf8encode($text) ) ;
        }
        
        public static function url_to_link($text) {
        	return preg_replace("#(https?|ftp)://\S+[^\s.,>)\];'\"!?]#", '<a href="\\0">\\0</a>',$text);    
        }
        static function colourBrightness($hex, $percent) {
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
        
        static function getColorball($color, $size=15, $noColor=false)
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
        
        static function filenameReplaceBadChars( $filename ) 
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
               "/Ä/",
               "/Ö/",
               "/Ü/",
               "/\\*/"   # * Zeichen 
             ); 
              
             $replacements = array( 
               " ", 
               "-", 
               "-", 
               "_", 
               "_", 
               "_", 
               "_", 
               " ", 
               "\\s", 
               "_", 
               "ae",
               "oe",
               "ue",
               "Ae",
               "Oe",
               "Ue",
               "_", 
               ); 
               return preg_replace( $patterns, $replacements, $filename ); 
        }

        //filters a string so thats ist vaild for filenames and pathes, slashes are not filterd
        static function cleanFilename($string, $lowercase=false)
        {
	        // Remove special accented characters - ie. sí.
	        $clean_name = strtr($string, 'ŠŽšžŸÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÑÒÓÔÕÖØÙÚÛÜÝàáâãäåçèéêëìíîïñòóôõöøùúûüýÿ', 										'SZszYAAAAAACEEEEIIIINOOOOOOUUUUYaaaaaaceeeeiiiinoooooouuuuyy');
	        $clean_name = strtr($clean_name, array('Þ' => 'TH', 'þ' => 'th', 'Ð' => 'DH', 'ð' => 'dh', 'ß' => 'ss', 'Œ' => 'OE', 'œ' => 'oe', 'Æ' => 'AE', 'æ' => 'ae', 'µ' => 'u'));

	        $clean_name = preg_replace(array('/\s/', '/\.[\.]+/', '/[^\w_\.\-\/]/'), array('_', '.', ''), $clean_name);
	        if ($lowercase) $clean_name = strtolower($clean_name);
	        return utf8_encode($clean_name);
        }
		
		
		
        static function endsWith($check, $endStr) {
                if (!is_string($check) || !is_string($endStr) || strlen($check)<strlen($endStr)) {
                    return false;
                }

                return (substr($check, strlen($check)-strlen($endStr), strlen($endStr)) === $endStr);
            }
}
