<?PHP
header("Content-Type:application/json;charset=utf-8");
/*
* 功能:根据区域id查询所属的街道
* @param   aid
* return {"status":"OK","data":[{streetID:14,streetName:"东直门"},{streetID:14,streetName:"东直门"},{streetID:14,streetName:"东直门"}]}
*/
/*参数获取*/
@$a=$_REQUEST["aid"];
/*数据库*/
$con=mysqli_connect("localhost","root","","ulift","3306");
mysqli_query($con,"set names uft8");
$sql="select * from tstreet where cid = ".$a."";//cmd
$res=mysqli_query($con,$sql);
//var_dump($res);
$str="{\"status\":\"OK\",\"data\":[";
$i=0;
 while($row=mysqli_fetch_array($res)){
$i++;
 if($i==1){
	 $str.="{\"streetID\":".$row["ID"].",\"streetName\":\"".$row["CsName"]."\"}";
	 }
 else{
	 $str.=",{\"streetID\":".$row["ID"].",\"streetName\":\"".$row["CsName"]."\"}";
	 }	 	 
	 }
 $str.="]}"; 
 echo $str;	 
/*$row=mysqli_fetch_array($res);
echo $row["Cdate"];
$row=mysqli_fetch_array($res);
echo $row["Cdate"];
$row=mysqli_fetch_array($res);
echo $row["Cdate"];*/
mysqli_free_result($res);
mysqli_close($con);
//echo $a;
?>