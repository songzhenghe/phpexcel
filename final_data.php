<?php
include('./init.php');

if($_POST){
	//p($_FILES);
	$head=intval($_POST['head']);//表头
	$body=intval($_POST['body']);
	$table_name=$_POST['table_name'];
	$is_auto=$_POST['is_auto'];
	$file=$_POST['file'];
	$relationship=$_POST['relationship'];
	
	$id=intval($_GET['id']);
	$as=$_POST['as'];
	$is_insert=$_POST['is_insert'];
	$info=$db->select("select * from project where id='{$id}'");
	include_once(ROOT.'callback/'.$info['dir'].'/'.$info['file']);
	//从文件加载excel
	$path=ROOT.'upload/'.$file;
	$excel=PHPExcel_IOFactory::load($path);
	
	//得到活动的工作表
	$excel->setActiveSheetIndex($as);
	$sheet=$excel->getActiveSheet();
	
	$class=$info['class'];
	$func=$info['callback'];
	
	$myInstance=new $class;
	$myInstance->excel=$excel;
	$myInstance->sheet=$sheet;
	$myInstance->table_name=$table_name;
	$myInstance->is_auto=$is_auto;
	$myInstance->is_insert=$is_insert;
	
	
	$myInstance->relationship=$relationship;
	$myInstance->set_fields();
	$myInstance->$func();
	//unlink(ROOT.'upload/'.$file);
	
}