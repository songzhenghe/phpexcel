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

<form action="import_action.php?id=<?php echo $_GET['id'];?>" target="ccc" enctype="multipart/form-data" method="post">
<table width="100%" border="1" cellspacing="0" cellpadding="0">
  <tr>
    <th scope="row">project id</th>
    <td><?php echo $_GET['id'];?></td>
  </tr>
  <tr>
    <th scope="row">xls file</th>
    <td><input type="file" name="upload" id=""></td>
  </tr>
  <tr>
    <th scope="row">活动表</th>
    <td><?php echo form_radio('as',range(1,10),0);?></td>
  </tr>
  <tr>
    <th scope="row">表头</th>
    <td><input type="text" name="head" id="" value="1"></td>
  </tr>
  <tr>
    <th scope="row">数据</th>
    <td><input type="text" name="body" id="" value="2"></td>
  </tr>
  <tr>
    <th scope="row">屏蔽excel列</th>
    <td><input type="text" name="filter_column" id="" value="">(以,分隔)</td>
  </tr>
  <tr>
    <th scope="row">数据库表名</th>
    <td>
    <?php
	$query="show tables from `phpexcel`";
	$tables_array=$db->mselect($query);
	?>
    <input type="text" name="table_name" id="table_name">
    <select name="" id="" onchange="document.getElementById('table_name').value=this.value;document.getElementById('radio_1').checked=true;">
    <option value="">====</option>
    <?php
    foreach($tables_array as $v){
		$table=array_pop($v);
	?>
    <option value="<?php echo $table;?>"><?php echo $table;?></option>
    <?php
	}
	?>
    </select>
    </td>
  </tr>
  <tr>
    <th scope="row">自动取得表结构</th>
    <td><label><input type="radio" name="is_auto" id="radio_1" value="1" >是</label> <label><input type="radio" name="is_auto" id="" value="0" checked="checked">否</label></td>
  </tr>
  <tr>
    <th scope="row">是否insert</th>
    <td><label><input type="radio" name="is_insert" id="" value="1" checked="checked">是</label> <label><input type="radio" name="is_insert" id="" value="0">否</label></td>
  </tr>
  <tr>
    <th scope="row"><input type="submit" name="submit" value="上传"></th>
    <td>&nbsp;</td>
  </tr>
</table>

</form>
<br>
<br>
<br>
<br>

<iframe name="ccc" width="100%" height="500px">

</iframe>
</body>
</html>