<?php 
class wfl_cck extends wf_lib {
	
	function fieldlist()
	{
		return Array(
				new wfp_param('content_typelist','',"Типы контента",$this->getname(),'Типы содержимого'),
					//Array('name'=>'content_type','defvalue'=>'c1')
			);
	}
	
	
	
	VAR $pagename="Типы контента";
}
?>