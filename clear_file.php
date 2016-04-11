<?php
include('./init.php');

$path=ROOT.'upload/';
$files=scandir($path);
foreach($files as $file){
	if($file=='.' or $file=='..') continue;
	unlink($path.$file);
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>无标题文档</title>
</head>
<body>

清空完成

</body>
</html>