<?php 
class wfl_view extends wf_lib {
	
	function fieldlist()
	{
		return Array(
				//new wfp_param('content_type','user',"��� �����������",$this->getname(),'��� �����������, ��������� � ������'),
				new wfp_param('viewlist','user',"������",$this->getname(),'������ (������� �� ������� �����)'),
					//Array('name'=>'content_type','defvalue'=>'c1')
			);
	}
	
	
	
	VAR $pagename="�������";
}
?>