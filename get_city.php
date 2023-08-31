<?php
require_once("includes/config.php");
if(!empty($_POST["stateID"])) 
{
$stateid=$_POST["stateId"];
$sql= "SELECT stateID, cityName FROM cities WHERE stateID=:stateid";
$query = mysqli_query($conn,$sql);
// mysqli_fetch_assoc($result)
$rows = mysqli_fetch_assoc($query);
// $sql->execute(array(':stateid' => $stateid));	
?>
<option value="">Select District</option>
<?php
foreach($rows as $row)
{
?>
<option value="<?php echo $row[1]; ?>"><?php echo $row[1]; ?></option>
<?php
}
}
?>
