<?php 
echo "Testing Connection<br>";
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

$sql = "SELECT TOP 100 [as_id]
      ,[as_child]
  FROM [GCC_ANALYTICS].[dbo].[tblAssetChildren]";
$stmt = sqlsrv_query($conn, $sql);
if($stmt == false)
{
	die(print_r(sqlsrv_errors(),true));
}

while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
      echo $row['as_id'].", ".$row['as_child']."<br />";
}
echo "Succeed<br>";
//echo $stmt. "<br>";

?>