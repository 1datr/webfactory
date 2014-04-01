<?php 
class wfl_theme extends wf_lib {
	
	function fieldlist()
	{
		return Array(
				//new wfp_param('content_type','user',"Тип содержимого",$this->getname(),'Тип содержимого, выводимый в обзоре'),
				new wfp_param('theme',Array('defaultfront','defaultback'),"Обзоры",$this->getname(),'Вьюшки (выборки из контент типов)'),
					//Array('name'=>'content_type','defvalue'=>'c1')
			);
	}
	
	// get pages of project required to this library
	function getpages()
	{
		return Array(
				Array("name"=>"index","title"=>"Основное"),
				Array("name"=>"colors","title"=>"Цветовая схема")
		);
	}
	
	function page_colors()
	{
		echo "<p>COLORS</p>";
		
	}
	
	VAR $pagename="Тема";
}
?>