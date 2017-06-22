<?PHP
header("Content-Type:application/json;charset=utf-8");
/*
*  功能：查询所有区
*  参数: @param 无
*  返回值:  {"status":"OK","data":[
                                 { "id":1,"name":"东城"},{"id":2,"name":"西城"}]}
*/
/*获得参数*/
/*数据*/
  $con=mysqli_connect("localhost","root","","ulift","3306");
  mysqli_query($con,"set names utf8"); 
  $sql="select * from tarea";
  $res=mysqli_query($con,$sql);
  $str="{\"status\":\"OK\",\"data\":[";
  $i=0;
  while($row=mysqli_fetch_array($res,MYSQLI_ASSOC)){
	  $i++;
	  if($i==1){
		  $str.="{\"id\":".$row["ID"].",\"name\":\"".$row["CaName"]."\"}";
		  }
	  else{
		  $str.=",{\"id\":".$row["ID"].",\"name\":\"".$row["CaName"]."\"}";
		  }
	  }
  $str.="]}";
  echo $str;
  mysqli_close($con);
/*返回值*/


?>