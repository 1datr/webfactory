<?php 
class wfl_maket extends wf_lib {
	
	function fieldlist()
	{
		return Array(
				//new wfp_param('content_type','user',"Тип содержимого",$this->getname(),'Тип содержимого, выводимый в обзоре'),
				new wfp_param('column_count',3,"Колонок",$this->getname(),'Сколько колонок'),
				new wfp_param('header',TRUE,"Заголовок",$this->getname(),'Заголовок'),
				
			);
	}
	
	function make_base_hook($params=NULL)
	{
		
	}
	
	VAR $pagename="Макет";
}
?>