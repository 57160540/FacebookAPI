<head>
<meta charset="utf8">
</head>

<?php
	mysql_connect("localhost","it57160029","0983696978");
	mysql_select_db("it57160029");
	mysql_query("SET NAMES UTF8");
	
	
	if(trim($_POST["co_name"]) == "")
	{
		echo "Please input Password!";
		exit();	
	}	
		
	if(trim ($_POST["co_date"]) == "" )
	{
		echo "Please input Firstname!";
		exit();
	}
	
	if(trim($_POST["co_time"]) == "")
	{
		// echo "Please input Name!";
		// exit();	
	}	
	
	if(trim($_POST["co_detail"]) == "")
	{
		echo "Please input Name!";
		exit();	
	}	
	if(trim($_POST["co_hours"]) == "")
	{
		echo "Please input Name!";
		exit();	
	}
	if(trim($_POST["co_place"]) == "")
	{
		echo "Please input Name!";
		exit();	
	}
	if(trim($_POST["co_StartTime"]) == "")
	{
		echo "Please input Name!";
		exit();	
	}
	if(trim($_POST["co_StopTime"]) == "")
	{
		echo "Please input Name!";
		exit();	
	}
	if(trim($_POST["Co_op_Type_co_type_id"]) == "")
	{
		echo "Please input Name!";
		exit();	
	}	

				
		$strSQL = "INSERT INTO Co_op_Activity
 (co_name,co_date	,co_time,co_detail,co_hours,co_place,co_StartTime,co_StopTime,Co_op_Type_co_type_id) 
		           VALUES ('".$_POST["co_name"]."', '".$_POST["co_date"]."','".$_POST["co_time"]."','".$_POST["co_detail"]."',".$_POST["co_hours"].",'".$_POST["co_place"]."','".$_POST["co_StartTime"]."','".$_POST["co_StopTime"]."',".$_POST["Co_op_Type_co_type_id"].")";
		
		$objQuery = mysql_query($strSQL);
		// echo "$strSQL";
		// echo "Register Completed!<br>";		
	
		// echo "<br> Go to <a href='index.php'>Login page</a>";
		echo"<meta http-equiv='refresh' content='0;url=manager.php'>";
	

	mysql_close();
?>