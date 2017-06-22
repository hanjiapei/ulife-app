<?PHP
header("Content-Type:application/json;charset=utf-8");
/*
* 功能:告诉前端给第n个版面的所有新闻列表
* @param   pagenum
* return {status:"OK",data:[{title:"df",cnt:"df",date:"2012-02-02 12:00:00",src:"dfdfdsf.jpg"},{title:"df",cnt:"df"},{title:"df",cnt:"df"}]}
*/
/*参数获取*/
@$a=$_REQUEST["pagenum"];
/*数据库*/
$con=mysqli_connect("localhost","root","","ulift","3306");
mysqli_query($con,"set names uft8");
$sql="select * from tnews order by Cdate DESC limit ".($a*3).",3";//cmd
$res=mysqli_query($con,$sql);
//var_dump($res);
$str="{\"status\":\"OK\",\"data\":[";
$i=0;
 while($row=mysqli_fetch_array($res)){
$i++;
 if($i==1){
	 $str.="{\"id\":".$row[0].",\"title\":\"".$row[1]."\",\"desc\":\"".$row[2]."\",\"date\":\"".$row[3]."\",\"src\":\"".$row[4]."\"}";
	 }
 else{
	 $str.=",{\"id\":".$row[0].",\"title\":\"".$row[1]."\",\"desc\":\"".$row[2]."\",\"date\":\"".$row[3]."\",\"src\":\"".$row[4]."\"}";
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