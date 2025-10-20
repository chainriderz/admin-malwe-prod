<?php
include '../config.php';

$select2 = "SELECT * FROM `shared_files`";
$result2 = mysqli_query($con, $select2);

?>
<div class="table-responsive mb-0">
    <table id="filemanager" class="table align-middle table-nowrap table-hover mb-0">
        <thead>
            <tr>
                <th scope="col">Name</th>
                <th scope="col">Shared By</th>
                <th scope="col">Share To</th>
                <th scope="col">Type</th>
                <th scope="col">Size</th>
            </tr>
        </thead>
        <tbody>
<?php
if(mysqli_num_rows($result2) > 0)
{
    while($row2 = mysqli_fetch_array($result2))
    {
        $filename = $row2["filename"];
        $url = $row2["url"];
        $shared_by = $row2["shared_by"];
        $shared_to = $row2["shared_to"];
        
        if(pathinfo($url, PATHINFO_EXTENSION) == 'jpg' ||
            pathinfo($url, PATHINFO_EXTENSION) == 'jpeg' ||
            pathinfo($url, PATHINFO_EXTENSION) == 'png')
        {
?>
            <tr>
                <td>
                    <a href="<?php echo $url; ?>" target="_blank" class="text-dark fw-medium">
                      	<i class="fa fa-image font-size-16 align-middle text-primary mr-2"></i> 
                      	<?php echo $filename; ?>
                    </a>
                </td>
                <td>
                    <?php
                        if($shared_by != 'Admin')
                        {
                            $stf = "SELECT * FROM `staff` WHERE `sid` = '$shared_by'";
                            $res_stf = mysqli_query($con, $stf);
                            $rw_stf = mysqli_fetch_array($res_stf);
                            echo $rw_stf['name'];
                        }
                        else
                        {
                            echo 'Admin';
                        }
                    ?>
                </td>
                <td>
                    <?php
                        if($shared_to !== 'Admin')
                        {
                            $stf = "SELECT * FROM `staff` WHERE `sid` = '$shared_to'";
                            $res_stf = mysqli_query($con, $stf);
                            $rw_stf = mysqli_fetch_array($res_stf);
                            echo $rw_stf['name'];
                        }
                        else
                        {
                            echo 'Admin';
                        }
                    ?>
                </td>
                <td><?php echo "Image File"; ?></td>
                <td><?php echo formatSizeUnits(filesize($url)); ?></td>
            </tr>
<?php
        }
        elseif(pathinfo($url, PATHINFO_EXTENSION) == 'pdf')
        {
?>
            <tr>
                <td>
                    <a href="<?php echo $url; ?>" target="_blank" class="text-dark fw-medium">
                      	<i class="fa fa-file-archive-o font-size-16 align-middle text-danger mr-2"></i>
                      	<?php echo $filename; ?>
                    </a>
                </td>
                <td>
                    <?php
                        if($shared_by != 'Admin')
                        {
                            $stf = "SELECT * FROM `staff` WHERE `sid` = '$shared_by'";
                            $res_stf = mysqli_query($con, $stf);
                            $rw_stf = mysqli_fetch_array($res_stf);
                            echo $rw_stf['name'];
                        }
                        else
                        {
                            echo 'Admin';
                        }
                    ?>
                </td>
                <td>
                    <?php
                        if($shared_to != 'Admin')
                        {
                            $stf = "SELECT * FROM `staff` WHERE `sid` = '$shared_to'";
                            $res_stf = mysqli_query($con, $stf);
                            $rw_stf = mysqli_fetch_array($res_stf);
                            echo $rw_stf['name'];
                        }
                        else
                        {
                            echo 'Admin';
                        }
                    ?>
                </td>
                <td><?php echo "PDF File"; ?></td>
                <td><?php echo formatSizeUnits(filesize($url)); ?></td>
            </tr>
<?php 
        }
    }
}

function formatSizeUnits($bytes)
{
  if ($bytes >= 1073741824)
  {
      $bytes = number_format($bytes / 1073741824, 2) . ' GB';
  }
  elseif ($bytes >= 1048576)
  {
      $bytes = number_format($bytes / 1048576, 2) . ' MB';
  }
  elseif ($bytes >= 1024)
  {
      $bytes = number_format($bytes / 1024, 2) . ' KB';
  }
  elseif ($bytes > 1)
  {
      $bytes = $bytes . ' bytes';
  }
  elseif ($bytes == 1)
  {
      $bytes = $bytes . ' byte';
  }
  else
  {
      $bytes = '0 byte';
  }

  return $bytes;
}
?>
        </tbody>
    </table>
</div>