<?php
class super_inst{
    public $excel;
    public $sheet;
	public $table_name;
	public $ori_fields=array();
	
    public function __construct(){
    }
	public function set_fields(){
		if($this->is_auto){
			$this->ori_fields=$this->auto_fields();
		}else{
			$this->ori_fields=$this->fields();
		}
	}
	public function init(){


		$final_fields=array();
		
		foreach($this->relationship as $k=>$v){
			if($v>-1){
				$final_fields[$k]=$this->ori_fields[$k];
			}
		}
		$this->final_fields=$final_fields;
		
	}
	public function auto_fields(){
		global $db;
		$result=$db->query("desc {$this->table_name}");
		$fields=array();
		while($row=$db->fetch_array($result,'ASSOC')){
			$fields[]=strtolower($row['Field']);
		}
		$db->free_result($result);
		return $fields;
	}
}