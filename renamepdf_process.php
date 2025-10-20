<?php
if(isset($_GET['old']) && isset($_GET['new'])  && isset($_GET['folder']))
{
	$old_name = $_GET['old'].".pdf";
	$new_name = $_GET['new'].".pdf";
	$folder = $_GET['folder'];

	if(file_exists($folder.$new_name))
    { 
    	echo "file_exists";
    }
    else
    {
       if(rename( $folder.$old_name, $folder.$new_name))
       { 
       	echo "success";
       }
    }
}
?>