<?php 
class wfl_maket extends wf_lib {
	
	function fieldlist()
	{
		return Array(
				//new wfp_param('content_type','user',"��� �����������",$this->getname(),'��� �����������, ��������� � ������'),
				new wfp_param('column_count',3,"�������",$this->getname(),'������� �������'),
				new wfp_param('header',TRUE,"���������",$this->getname(),'���������'),
				
			);
	}
	
	function make_base_hook($params=NULL)
	{
		
	}
	
	VAR $pagename="�����";
}
?>