<?php
if(isset($_GET['old']) && isset($_GET['new'])  && isset($_GET['folder'])  && isset($_GET['extension']))
{
	$old_name = $_GET['old'];
	$new_name = $_GET['new'];
	$folder = $_GET['folder'];
   $extension = $_GET['extension'];

   // echo $folder.$old_name;
   // echo $folder.$new_name.$extension;

	if(file_exists($folder.$new_name.$extension))
    { 
    	echo "file_exists";
    }
    else
    {
       if(rename( $folder.$old_name, $folder.$new_name.$extension))
       { 
       	echo "success";
       }
    }
}
?>