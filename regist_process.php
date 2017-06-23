<?php
 $co_id=$_GET['co_id'];
 $m_id=$_GET['m_id'];
 $co_typeID=$_GET['co_typeID'];
 
?>
<head>
<meta charset="utf8">
</head>

<?php
	mysql_connect("localhost","it57160029","0983696978");
	mysql_select_db("it57160029");
	mysql_query("SET NAMES UTF8");
	
	
	if(trim($_GET['co_id']) == "")
	{
		echo "Please input Password!";
		exit();	
	}	
		
	if(trim ($_GET['m_id']) == "" )
	{
		echo "Please input Firstname!";
		exit();
	}
	
	if(trim( $co_typeID=$_GET['co_typeID']) == "")
	{
		echo "Please input Name!";
		exit();	
	}	
	

	$status=1;

				
		$strSQL = "INSERT INTO Co_op_List
 (co_list_status,Co_op_Activity_co_id,Co_op_Activity_Co_op_Type_co_type_id	,Member_m_id) 
		           VALUES ('".$status."','".$_GET['co_id']."', '".$_GET['co_typeID']."','".$co_typeID=$_GET['m_id']."')";
		
		$objQuery = mysql_query($strSQL);
		
		
	
		
		echo"<meta http-equiv='refresh' content='0;url=index.php'>";
	

	mysql_close();
?>