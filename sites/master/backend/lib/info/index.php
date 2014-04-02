<?php 
class wfl_info extends wf_lib {
	
	function fieldlist()
	{
		return Array(
				//new wfp_param('content_type','user',"Тип содержимого",$this->getname(),'Тип содержимого, выводимый в обзоре'),
				new wfp_param('sitename','Site1',"Название сайта",$this->getname(),''),
				new wfp_param('moto','Hello, world',"Слоган",$this->getname(),''),
				new wfp_param('enterpoints',Array('frontend','backend'),"Точки входа",$this->getname(),''),
					//Array('name'=>'content_type','defvalue'=>'c1')
			);
	}
	
	
	VAR $pagename="Информация";
}
?>