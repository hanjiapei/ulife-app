<?PHP
header("Content-Type:application/json;charset=utf-8");
/*
* 功能:根据id返回一条房源信息
* @param   id
* return {status:"OK",data:[{agentID:"df",agentName:"df",agentPhone:"2012-02-02 12:00:00",src:"dfdfdsf.jpg","aid":2,"sid":3}]}
*/
/*参数获取*/
@$a=$_REQUEST["id"];
/*数据库*/
$con=mysqli_connect("localhost","root","","ulift","3306");
mysqli_query($con,"set names uft8");
// 查询房源信息
$sql="select * from tren where ID = ".$a."";//cmd
$res=mysqli_query($con,$sql);

$row=mysqli_fetch_array($res,MYSQLI_ASSOC);//存到数组$row中
//var_dump($row);
// 根据id 查询详情表 8图
  $sql2="select * from trdetail where cid = ".$a."";
  $res2=mysqli_query($con,$sql2);
// 查询所属于的经纪人信息
  $sql3="select * from tagent where CSID = ".$row["CSID"]."";
  //echo $sql3;
  $res3=mysqli_query($con,$sql3);
  $row3=mysqli_fetch_array($res3,MYSQLI_ASSOC);
//var_dump($res);
$str="{\"status\":\"OK\",\"data\":[";
//1条数据

$str.="{\"id\":".$row["ID"].",\"title\":\"".$row["Ctitle"]."\",\"src\":\"".$row["Cthumb"]."\",\"type\":\"".$row["Ctype"]."\"".
	 ",\"mode\":\"".$row["Cmode"]."\"".
	 ",\"area\":\"".$row["Carea"]."\"".
	 ",\"floor\":\"".$row["Cfloor"]."\"".
	 ",\"dir\":\"".$row["Cdir"]."\"".
	 ",\"add\":\"".$row["Cadd"]."\"".
	 ",\"price\":\"".$row["Cprice"]."\"".
	 ",\"date\":\"".$row["Cdate"]."\"".
	 ",\"pay\":\"".$row["Cpay"]."\"".
	 ",\"dec\":\"".$row["Cdec"]."\"".
	 ",\"desc\":\"".$row["Cdesc"]."\"".
	 ",\"aid\":\"".$row["CAID"]."\"".
	 ",\"sid\":\"".$row["CSID"]."\"".
	 ",\"agentID\":\"".$row3["ID"]."\"".
	 ",\"agentName\":\"".$row3["Cname"]."\"".
	 ",\"agentPhone\":\"".$row3["Cphone"]."\"".
     ",\"agentsrc\":\"".$row3["Csrc"]."\"".
	 ",\"pics\":[";
	 $k=0;
	 while($row2=mysqli_fetch_array($res2)){
		 $k++;
		 if($k==1){ 
		 $str.="{\"big\":\"".$row2["Cbsrc"]."\",\"mid\":\"".$row2["Cmsrc"]."\",\"sm\":\"".$row2["Cssrc"]."\"}";
		   }
		 else{
		 $str.=",{\"big\":\"".$row2["Cbsrc"]."\",\"mid\":\"".$row2["Cmsrc"]."\",\"sm\":\"".$row2["Cssrc"]."\"}";	 
			 }
		 }
	$str.="]}";

 $str.="]}"; 
 echo $str;	  
mysqli_free_result($res);
mysqli_close($con);
?>