<?php
include("../config.php");

$select = "SELECT * FROM `delivery_status`";
// echo $delete;
$result = mysqli_query($con, $select);

if (mysqli_num_rows($result) > 0)
{
	while($row = mysqli_fetch_array($result))
	{
	    ?>
	    <option value="<?php echo $row['del_status']; ?>"><?php echo $row['del_status']; ?></option>
	    <?php
	}
}

?>