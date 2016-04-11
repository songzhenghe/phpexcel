<?php
include('./init.php');
if($_POST){
	$query="insert into `project` (`title`,`dir`,`file`,`class`,`callback`) values ('{$title}','{$dir}','{$file}','{$class}','{$callback}')";
	$r=$db->query($query);
	if($r){
		if($dir and !file_exists(ROOT.'callback/'.$dir.'/')){
			mkdir(ROOT.'callback/'.$dir.'/');
		}	
	}
	autoalert($r);
	js("window.parent.frames['left'].location.reload();");
	back();
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>无标题文档</title>
</head>
<body>
<form action="" method="post">
<table width="100%" border="1" cellspacing="0" cellpadding="0">
  <tr>
    <th scope="row">名称</th>
    <td><input type="text" name="title" id=""></td>
  </tr>
  <tr>
    <th scope="row">dir name</th>
    <td><input type="text" name="dir" id=""></td>
  </tr>
  <tr>
    <th scope="row">file</th>
    <td><input type="text" name="file" id="" value="index.php"></td>
  </tr>
  <tr>
    <th scope="row">class</th>
    <td><input type="text" name="class" id="" value="inst"></td>
  </tr>
  <tr>
    <th scope="row">callback</th>
    <td><input type="text" name="callback" id="" value="begin"></td>
  </tr>
  <tr>
    <th scope="row"><input type="submit" name="sumbit" value="提交"></th>
    <td>&nbsp;</td>
  </tr>
</table>
</form>
</body>
</html>