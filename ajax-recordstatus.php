<?php
include("../config.php");

$select = "SELECT * FROM `record_status`";
// echo $delete;
$result = mysqli_query($con, $select);

if (mysqli_num_rows($result) > 0)
{
	while($row = mysqli_fetch_array($result))
	{
	    ?>
	    <option value="<?php echo $row['status']; ?>"><?php echo $row['status']; ?></option>
	    <?php
	}
}

?>