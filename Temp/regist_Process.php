<head>
<meta charset="utf8">
</head>

<?php
	mysql_connect("localhost","it57160029","0983696978");
	mysql_select_db("it57160029");
	mysql_query("SET NAMES UTF8");
	
	
	if(trim($_POST["m_StudentID"]) == "")
	{
		echo "Please input Password!";
		exit();	
	}	
		
	if(trim ($_POST["m_Firstname"]) == "" )
	{
		echo "Please input Firstname!";
		exit();
	}
	
	if(trim($_POST["m_Lastname"]) == "")
	{
		echo "Please input Name!";
		exit();	
	}	
	
	if(trim($_POST["m_major"]) == "")
	{
		echo "Please input Name!";
		exit();	
	}	
	if(trim($_POST["m_level"]) == "")
	{
		echo "Please input Name!";
		exit();	
	}	

				
		$strSQL = "INSERT INTO Member (m_userID,m_StudentID	,m_Firstname,m_Lastname,m_major,m_phone,m_email,m_level) 
		           VALUES ('".$_POST["m_userID"]."', '".$_POST["m_StudentID"]."','".$_POST["m_Firstname"]."','".$_POST["m_Lastname"]."','".$_POST["m_major"]."','".$_POST["m_phone"]."','".$_POST["m_email"]."','".$_POST["m_level"]."')";
		
		$objQuery = mysql_query($strSQL);
		echo "$strSQL";
		echo "Register Completed!<br>";		
	
		echo "<br> Go to <a href='index.php'>Login page</a>";
		
	

	mysql_close();
?>