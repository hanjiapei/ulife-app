<?PHP
header("Content-Type:application/json;charset=utf-8");
/*
* 功能:根据phone pwd来查询
* @param   phone
  @param   pwd
* return {status:"OK",data:[{title:"df",cnt:"df",date:"2012-02-02 12:00:00",src:"dfdfdsf.jpg"}]}
*/
/*参数获取*/
@$a=$_REQUEST["phone"];
@$b=$_REQUEST["pwd"];
/*数据库*/
$con=mysqli_connect("localhost","root","","ulift","3306");
mysqli_query($con,"set names uft8");
$sql="select * from tuser where Cphone = '".$a."' and Cpwd = '".$b."'";//cmd
$res=mysqli_query($con,$sql);
$r=mysqli_affected_rows($con);

if($r<=0){
	$str="{\"status\":\"FAIL\",\"data\":{\"erroMsg\":1212}}";
	}
else{
	$str="{\"status\":\"OK\",\"data\":[";
$i=0;
 while($row=mysqli_fetch_array($res)){
  $i++;
 if($i!=1){
	 $str.=",";
	 }
	 $str.="{\"id\":".$row["ID"].",\"phone\":\"".$row["Cphone"]."\",\"nike\":\"".$row["Cnike"]."\"}";	 
	 }
 $str.="]}";
	}
 echo $str;	 
mysqli_free_result($res);
mysqli_close($con);
?>