<?php
//$this->excel
//$this->sheet
class inst extends super_inst{
    public function __construct(){
        parent::__construct();
    }
	/*
	Array
(
    [0] => 2
    [1] => 3
    [2] => 9
)
	*/
	//UPDATE `project` SET `id` = 9,`title` = 'test9',`dir` = 'test9',`file` = 'index.php',`class` = 'inst',`callback` = 'begin' WHERE `project`.`id` = 9;
	//REPLACE INTO `project` (`id`, `title`, `dir`, `file`, `class`, `callback`) VALUES (9, 'test9', 'test9', 'index.php', 'inst', 'begin');
    public function begin(){
		$this->init();
        $sheet=$this->sheet;
		$rows=$sheet->getHighestRow();

		$fields="`".implode("`,`",array_values($this->final_fields))."`";
		$x=0;
		for($i=2;$i<=$rows;$i++){
			//0
			//$title=addslashes(trim($sheet->getCellByColumnAndRow(8,$i)->getValue()));
			//$info_id=intval(_post('http://yun.foodvip.net/api/test/cofco2_info_exist.php',array('title'=>$title)));
			$values_arr=array();
			foreach($this->final_fields as $kkk=>$vvv){
				$column=$this->relationship[$kkk];
				$value=addslashes(trim($sheet->getCellByColumnAndRow($column,$i)->getValue()));
				$values_arr[]=$value;
			}
			if(trim($values_arr[0])=='') continue;
			$values="'".implode("','",$values_arr)."'";
			$sql="insert into `{$this->table_name}` ({$fields},username,addtime,editor,edittime,status) values ({$values},'admin','1416737170','admin','1416737170','3');";
			echo htmlspecialchars($sql,ENT_QUOTES);
			echo "<br />";
			$x++;
		}
		//echo $x;
		echo "<script>var c=window.open('','demo');c.document.write('{$x}');</script>";
    }
	public function fields(){
		//手动指定
		return array(
			'catid',
			'title',
			'content',
		);
		//自动获取
	}
}