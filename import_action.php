<?php
include('./init.php');
/*
Array
(
    [upload] => Array
        (
            [name] => 14144643991691.doc
            [type] => application/msword
            [tmp_name] => E:\php-5.4.6\uploads\php1A2E.tmp
            [error] => 0
            [size] => 315392
        )

)
*/

//$func = function($myInstance)
//{
//	$f=$myInstance->func;
//	$myInstance->$f();
//};
if($_POST){
	//p($_FILES);
	$head=intval($_POST['head']);//表头
	$body=intval($_POST['body']);
	$table_name=trim($_POST['table_name']);
	$is_auto=intval($_POST['is_auto']);
	$filter_column=trim($_POST['filter_column']);
	$file=time().rand(1000,9999);
	$r=move_uploaded_file($_FILES['upload']['tmp_name'],ROOT.'upload/'.$file);
	$as=$_POST['as'];
	$is_insert=$_POST['is_insert'];
	if($r){
			$id=intval($_GET['id']);
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
			$myInstance->set_fields();
			
			
			//得到有几条数据
			//$rows=$sheet->getHighestRow();
			//总列数
			//$cols=$sheet->getHighestColumn();
			$cols=50;
			//循环读取数据
			//因为第一行是标题，所以从2开始
			$fields=array();
			$full_fields=array();
			$except=explode(',',$filter_column);
			
			for($j=0;$j<$cols;$j++){
				$tmp=trim($sheet->getCellByColumnAndRow($j,$head)->getValue());
				if($tmp){
					if(!in_array($j+1,$except)){
						$fields[$j]=$tmp;
					}
					$full_fields[$j]=$tmp;
				}
			}
			
			//$sqls=array();
			//for($i=1;$i<=$rows;$i++){
				//0
				//$myInstance->$func();
			//}
        //unlink(ROOT.'upload/'.$file);
		include(ROOT.'field.tpl.php');
	}	
}