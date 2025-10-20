<?php
if(isset($_GET['old']) && isset($_GET['new']))
{
	$old_name = $_GET['old'];
	$new_name = $_GET['new'];
   $folder = $_GET['folder'];

   // echo $folder.$old_name." | ";
   // echo $folder.$new_name;

	if(is_dir($folder.$new_name))
   { 
      echo "folder_exists";
   }
   else
   {
      if(rename($folder.$old_name, $folder.$new_name))
      { 
         echo "success";
      }
   }
}
?>