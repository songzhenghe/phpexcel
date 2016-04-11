<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>无标题文档</title>
<script src="./jquery.js"></script>
</head>
<body>
<table width="800" border="1" align="center">
  <tr>
    <th colspan="100" bgcolor="#009999">完整excel表头</th>
  </tr>
  <tr>
    <?php
    foreach($full_fields as $m=>$n){
	?>
    <th scope="row"><?php echo $n;?></th>
    <?php
	}
	?>
  </tr>
</table>
<br>
<br>
<?php
$result=$db->query("desc {$table_name}");
$fff=array();
while($row=$db->fetch_array($result,'ASSOC')){
	$fff[]=$row;
}
$db->free_result($result);
?>
<table width="800" border="1" align="center">
  <tr>
    <th colspan="100" bgcolor="#009999">完整数据库字段信息</th>
  </tr>
  <?php
  foreach($fff as $k=>$v){
  ?>
  <tr>
    <th scope="row"><?php echo $v['Field'];?></th>
    <td>
    <?php
    unset($v['Field']);
	foreach($v as $kk=>$vv) echo $kk.':'.$vv.'&nbsp;&nbsp;';
	?>
    </td>
  </tr>
  <?php
  }
  ?>
</table>
<br>
<br>

<form action="final_data.php?id=<?php echo $id;?>" method="post" target="result">
<table width="800" border="1" align="center">
  <tr>
    <th colspan="2" align="center" scope="row">字段对应关系 <?php echo $file;?> <input type="hidden" name="file" value="<?php echo $file;?>"><input type="hidden" name="head" value="<?php echo $head;?>"><input type="hidden" name="body" value="<?php echo $body;?>"><input type="hidden" name="as" value="<?php echo $as;?>"><input type="hidden" name="table_name" value="<?php echo $table_name;?>"><input type="hidden" name="is_auto" value="<?php echo $is_auto;?>"><input type="hidden" name="filter_column" value="<?php echo $filter_column;?>"><input type="hidden" name="is_insert" value="<?php echo $is_insert;?>"></th>
  </tr>
    <tr>
    <td align="center" bgcolor="#009999">database</td>
    <td align="center" bgcolor="#009999">excel</td>
  </tr>
  <?php
  foreach($myInstance->ori_fields as $k=>$field){
  ?>

  <tr>
    <th align="center" scope="row"><?php echo $field; ?></th>
    <td align="center">
    <select class="myselect" name="relationship[]" id="" k="<?php echo $k;?>">
    <option value="-1">====</option>
    <?php
    foreach($fields as $m=>$n){
	?>
    <option value="<?php echo $m;?>" <?php if($field==$n){echo "selected='selected'";}?>><?php echo $n;?></option>
    <?php
	}
	?>
    </select>
    <input type="button" class="clear_select" value="clear" k="<?php echo $k;?>">
    </td>
  </tr>
  <?php
  }
  ?>
  <tr>
    <th align="center" scope="row"><input type="submit" value="提交" name="submit"></th>
    <td align="center"><input type="reset" value="重置"></td>
  </tr>
</table>
</form>
<script>
window.open('','result');
$(document).ready(function(e) {
    $(".clear_select").click(function(){
		var k=$(this).attr('k');
		$(".myselect[k="+k+"]").val("-1");
	});
});
</script>
<!--<iframe src="" name="result" frameborder="0" width="600" height="400"></iframe>-->
</body>
</html>