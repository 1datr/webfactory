<?php 
class wfl_info extends wf_lib {
	
	function fieldlist()
	{
		return Array(
				//new wfp_param('content_type','user',"��� �����������",$this->getname(),'��� �����������, ��������� � ������'),
				new wfp_param('sitename','Site1',"�������� �����",$this->getname(),''),
				new wfp_param('moto','Hello, world',"������",$this->getname(),''),
				new wfp_param('enterpoints',Array('frontend','backend'),"����� �����",$this->getname(),''),
					//Array('name'=>'content_type','defvalue'=>'c1')
			);
	}
	
	
	VAR $pagename="����������";
}
?>