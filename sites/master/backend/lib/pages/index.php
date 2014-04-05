<?php 
class wfl_pages extends wf_lib {
	
	function fieldlist()
	{
		return Array(
				//new wfp_param('content_type','user',"Тип содержимого",$this->getname(),'Тип содержимого, выводимый в обзоре'),
				new wfp_param('pagelist','user',"Таксономии",$this->getname(),'Справочники'),
					//Array('name'=>'content_type','defvalue'=>'c1')
			);
	}
	
	
	VAR $pagename="Страницы";
}
?>