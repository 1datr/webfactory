<?php 
class wfl_view extends wf_lib {
	
	function fieldlist()
	{
		return Array(
				//new wfp_param('content_type','user',"Тип содержимого",$this->getname(),'Тип содержимого, выводимый в обзоре'),
				new wfp_param('viewlist','user',"Обзоры",$this->getname(),'Вьюшки (выборки из контент типов)'),
					//Array('name'=>'content_type','defvalue'=>'c1')
			);
	}
	
	
	
	VAR $pagename="Выборки";
}
?>