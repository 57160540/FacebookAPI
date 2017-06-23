<html>
<head>
<title>ThaiCreate.Com</title>
</head>
<body>
<?php
$host = "localhost";
$username = "it57160029";
$password = "0983696978";
$objConnect = mysql_connect($host,$username,$password);

$objDB = mysql_select_db("it57160029");
$fid = '1451739611538469'
$strSQL = "SELECT 
				co_list_time, co_name, co_detail, co_list_status
			FROM 
				(Co_op_List JOIN Co_op_Activity ON (Co_op_Activity_co_id = co_id)) JOIN Member ON (Member_m_id=m_id)
			WHERE
				m_userID= ".$fid.;

$objQuery = mysql_query($strSQL) or die (mysql_error());
echo $sql;
?>
<table width="600" border="1">
  <tr>
    <th width="91"> <div align="center">CustomerID </div></th>
    <th width="98"> <div align="center">Name </div></th>
    <th width="198"> <div align="center">Email </div></th>
    <th width="97"> <div align="center">CountryCode </div></th>
    <th width="59"> <div align="center">Budget </div></th>
    <th width="71"> <div align="center">Used </div></th>
  </tr>
<?php
while($objResult = mysql_fetch_array($objQuery))
{
?>
  <tr>
    <td><div align="center"><?php echo $objResult["CustomerID"];?></div></td>
    <td><?php echo $objResult["Name"];?></td>
    <td><?php echo $objResult["Email"];?></td>
    <td><div align="center"><?php echo $objResult["CountryCode"];?></div></td>
    <td align="right"><?php echo $objResult["Budget"];?></td>
    <td align="right"><?php echo $objResult["Used"];?></td>
  </tr>
<?php
}
?>
</table>
<?php
mysql_close($objConnect);
?>
</body>
</html>
