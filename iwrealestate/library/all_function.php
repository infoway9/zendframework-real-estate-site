<?php

    function Rand_String($digits)
    {
	$alphanum = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";

	// generate the random string
	$rand = substr(str_shuffle($alphanum), 0, $digits);
        $time=mktime();
        $val=$time.$rand;

	return $val;
    }
 function get_extension($names)
    {
        
        $ext=explode('.', $names);
       
        $tot_ext=count($ext);
        $tot_ext=$tot_ext-1;
        $extention= $ext[$tot_ext];
        $extention=strtolower($extention);
        
        return $extention;
    }
    
    function get_estate_image_display_path($image_name,$image_type="thumb")
    {
        if($image_name=="")
        {
            $image_path=ROOT_PATH."images/no_image_$image_type.jpg";
        }
        else {
            
            $image_path=ROOT_PATH."file_upload/estate_picture/$image_type/".$image_name;
        }
        
        return $image_path;
    }
    
    function get_transaction_status($status)
    {
        if($status=='1')
        {
            $val='Sale';
        }
        else {
                
            $val='Rent';
        }
        
        return $val;
    }
    
    



?>