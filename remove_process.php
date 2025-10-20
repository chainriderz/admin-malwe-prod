<?php
if (isset($_GET['dir']))
{
	$dir = $_GET['dir'];

    // echo $dir;

	if (is_dir($dir))
	{
        function remove($directory)
        {
    		$d_dir = opendir($directory);
            while (false !== ($file = readdir($d_dir)))
            {
                // echo $file.'\n';
                if (($file != '.') && ($file != '..'))
                {
                    $full = $directory . '/' . $file;
                    if (is_dir($full))
                    {
                        remove($full);
                        // rmdir($full);
                        // echo "D: ".$full."\n";
                    }
                    else
                    {
                        unlink($full);
                        // echo "F: ".$full."\n";
                    }
                }
            }
            rmdir($directory);
            closedir($d_dir);
        }
        remove($dir);
        
        // rmdir($dir);
	}
	elseif (file_exists($dir))
	{
		unlink($dir);
	}
}
?>