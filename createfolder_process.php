<?php
if(isset($_GET['source']) && isset($_GET['folder']))
{
	$source = $_GET['source'];
   $folder = $_GET['folder'];

   // echo $folder.$source." | ";
   // echo $folder.$folder;

   $create_folder = $source.$folder;

	if(is_dir($create_folder))
   { 
      echo "folder_exists";
   }
   else
   {
      if(mkdir($create_folder))
      { 
         echo "success";
      }
   }
}
?>