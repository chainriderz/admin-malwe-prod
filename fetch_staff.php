<?php
  include('../config.php');
  
  $select = "SELECT * FROM `staff` WHERE `status` = '1'";
//   echo $select;
  $result = mysqli_query($con, $select);
  
  if(mysqli_num_rows($result) > 0)
  {
      while($row = mysqli_fetch_array($result))
      {
          $sid = $row['sid'];
          $sname = $row['name'];
          echo "<option value='".$sid."'>".$sname."</option>";
      }
  }
?>