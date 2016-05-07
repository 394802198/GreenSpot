<?php

class MyUtils {
    
    public static function startsWith($haystack, $needle)
    {
        return (substr($haystack, 0, strlen($needle)) === $needle);
    }
    
    public static function endsWith($haystack, $needle)
    {
    
        return (substr($haystack, -strlen($needle)) === $needle);
    }
    
    /**
     * 
     * @param number $length
     * @param string $str_type:('A-Za-z','a-z','A-Z','0-9','\w','\W')
     * @return string
     */
    public static function r_str( $length = 8, $str_type = 'all' )
    {
        // CHARACTER SET
        $chars = array(
            'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j',
            'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't',
            'u', 'v', 'w', 'x', 'y', 'z', 'A', 'B', 'C', 'D',
            'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N',
            'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X',
            'Y', 'Z', '0', '1', '2', '3', '4', '5', '6', '7',
            '8', '9',
            '_', '@', '#', '$', '%', '^', '&', '*', '(', ')',
            '!', '-', '[', ']', '{', '}', '<', '>', '~', '`',
            '+', '=', ',', '.', ';', ':', '/', '?', '|'
        );
        
        switch ($str_type)
        {
            case 'all':
                $start_index = 0; $end_index = count($chars)-1; break;
            case 'A-Za-z':
                $start_index = 0; $end_index = 51; break;
            case 'a-z':
                $start_index = 0; $end_index = 25; break;
            case 'A-Z':
                $start_index = 26; $end_index = 51; break;
            case '0-9':
                $start_index = 52; $end_index = 61; break;
            case '\w':
                $start_index = 0; $end_index = 62; break;
            case '\W':
                $start_index = 63; $end_index = count($chars)-1; break;
        }
        
        $rand_str = '';
        for($i = 0; $i < $length; $i++)
        {
            $rand_str .= $chars[mt_rand($start_index, $end_index)];
        }
        return $rand_str;
    }
    
}