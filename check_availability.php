<?php 
require_once("includes/config.php");

if(!empty($_POST["emailid"])) {
	$email= $_POST["emailid"];

	$sql ="SELECT EmailId FROM tblusers WHERE EmailId='$email'";
	$query= $dbh->query($sql);
	$results = $query->fetchAll(PDO::FETCH_OBJ);
	$cnt=1;
	if($query->rowCount() > 0)
	{
		echo "<span style='color:red'> Email already exists .</span>";
		echo "<script>$('#submit').prop('disabled',true);</script>";
	} else{
		echo "<span style='color:green'> Email available for Registration .</span>";
		echo "<script>$('#submit').prop('disabled',false);</script>";
	}
}
?>