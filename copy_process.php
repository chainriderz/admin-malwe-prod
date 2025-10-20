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
			function custom_copy($src, $dst)
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
			                custom_copy($src . '/' . $file, $dst . '/' . $file); 
			  
			            } 
			            else
			            { 
			                copy($src . '/' . $file, $dst . '/' . $file); 
			            } 
			        } 
			    }		  
			    closedir($dir);
			}

			custom_copy($src, $dst);
			echo "folder_copied";
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
			if (copy($src, $dst))
			{
			    echo "file_copied";
			}
		}
		else
		{
			echo 'file_exists';
		}
	}
}
?>