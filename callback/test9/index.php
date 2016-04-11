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
		
		for($i=2;$i<=$rows;$i++){
			//0
			$values_arr=array();
			foreach($this->final_fields as $kkk=>$vvv){
				$column=$this->relationship[$kkk];
				$value=addslashes(trim($sheet->getCellByColumnAndRow($column,$i)->getValue()));
				$values_arr[]=$value;
			}
			$values="'".implode("','",$values_arr)."'";
			$sql="insert into `{$this->table_name}` ({$fields}) values ({$values});";
			echo htmlspecialchars($sql,ENT_QUOTES);
			echo "<br />";
		}
		
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