<?php
if (isset($_GET['src']) && isset($_GET['dst']))
{
	$src = $_GET['src'];
	$dst = $_GET['dst'];

	// echo "Source: ".$src." | Destination: ".$dst.">br>";

	if (pathinfo($src, PATHINFO_EXTENSION) == '' && pathinfo($dst, PATHINFO_EXTENSION) == '')
	{
		if($src != $dst)
		{
			// echo "Directory";
			function custom_move($src, $dst)
			{	  
			    // open the source directory
			    $dir = opendir($src); 
			  
			    // Make the destination directory if not exist
			    @mkdir($dst); 
			  
			    // Loop through the files in source directory
			    while( $file = readdir($dir) )
			    { 
			  
			        if (( $file != '.' ) && ( $file != '..' ))
			        { 
			            if ( is_dir($src . '/' . $file) ) 
			            { 
			  
			                // Recursively calling custom copy function
			                // for sub directory 
			                custom_move($src . '/' . $file, $dst . '/' . $file); 
			  				rmdir($src . '/' . $file);
			            } 
			            else
			            { 
			                rename($src . '/' . $file, $dst . '/' . $file);
			            } 
			        } 
			    }		  
			    closedir($dir);
			}

			custom_move($src, $dst);
			rmdir($src);
			echo "folder_moved";
		}
		else
		{
			echo 'folder_exists';
		}
	}
	else
	{
		if($src != $dst)
		{
			// echo "File";
			if (rename($src, $dst))
			{
			    echo "file_moved";
			}
		}
		else
		{
			echo 'file_exists';
		}
	}
}
?>