<?php
include('./init.php');
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>无标题文档</title>
</head>
<body>
<h3>项目列表</h3>
<ul>
<?php
$data=$db->mselect("select * from project order by id asc");
foreach($data as $k=>$v){
?>
<li><?php echo $v['id'];?> <a target="main" href="import.php?id=<?php echo $v['id'];?>"><?php echo $v['title'];?></a>[<?php echo $v['dir'];?>]</li>
<?php
}
?>
</ul>
<?php echo time();?>
<br />
<br />
<h3><a target="main" href='add_project.php'>增加项目</a></h3>
<h3><a target="main" href="clear_file.php">清空上传excel</a></h3>
</body>
</html>