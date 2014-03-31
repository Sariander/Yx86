<html>
<head></head>

<form method="POST" name = "myform" action="test.php">

Select Option :
<select name="query">
	<option value = "Features of User"> Features of User </option>
	<option value = "Most Used Features"> Most Used </option>
	<option value = "Specific Feature"> Specific Feature </option>
	
</select>

<input type='text' name = 'value' />
<input type="submit" name = 'Enter'/>
<br>
<?php 
//echo "Testing Connection<br>";
if(isset($_POST['Enter']))
{
	
	
	
	$serverName = "2CE12909L0\ANALYTICS";
	$connectionOptions = array("Database"=>"GCC_ANALYTICS");

	/* Connect using Windows Authentication. */
	$conn = sqlsrv_connect( $serverName, $connectionOptions);
	if( $conn ) {
		 echo "Connection established.<br />";
	}else{
		 echo "Connection could not be established.<br />";
		 die( print_r( sqlsrv_errors(), true));
	}

	if($_POST["query"]=="Features of User")
	{
		
		echo "Feature Query<br>";
		$textVal = $_POST['value'];
		if(!(is_null($textVal)))
		{
			$sql = "select audit_type_id, count(*) as 'num' from tblAuditLog where in_id=$textVal and as_id is not null group by audit_type_id";
			$stmt = sqlsrv_query($conn, $sql);
			if($stmt == false)
			{
				die(print_r(sqlsrv_errors(),true));
			}
			echo "<table border='1'>
			<tr>
			<th>Audit_type_id</th>
			<th>num</th>
			</tr> ";
			while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) )
			{
			  echo "<tr>";
			  echo "<td>" . $row['audit_type_id']. "</td>";
			  echo "<td>". $row['num']."</td>";
			}
		}
	}
	else if ($_POST["query"]== "Most Used Features")
	{
		echo "Most Used Feature<br>";
		$textVal = $_POST['value'];
		
			$sql = "select top 10 as_id, count(*) as 'num' from tblAuditLog where as_id is not null group by as_id order by num desc";
			$stmt = sqlsrv_query($conn, $sql);
			if($stmt == false)
			{
				die(print_r(sqlsrv_errors(),true));
			}
			echo "<table border='1'> <tr> <th> as_id </th> <th>num</th> </tr>";
			while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) )
			{
			  echo "<tr>";
			  echo "<td>" . $row['as_id']. "</td>";
			  echo "<td>".$row['num']."</td>";
			}
	}
	
	else if($_POST["query"]== "Specific Feature")
	{
		echo "Specific Feature<br>";
		$sql = "select audit_type_id, count(*) as 'num' from tblAuditLog group by audit_type_id order by num desc";
			$stmt = sqlsrv_query($conn, $sql);
			if($stmt == false)
			{
				die(print_r(sqlsrv_errors(),true));
			}
			echo "<table border='1'> <tr> <th> audit_type_id </th> <th>num</th> </tr>";
			while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) )
			{
			  echo "<tr>";			  
			  echo "<td>" .$row['audit_type_id']. "</td>";
			  echo "<td>" .$row['num']."</td>";
			}
		
	}
	else
		echo "Invalid Selection";
	
}

	  
	  //$sql ="select top 10 ast_id, aed_freq_days, aed_freq_months from dbo.tblAssetTasks order by aed_freq_days";
	


	
	
		





?>
</body>
</html>