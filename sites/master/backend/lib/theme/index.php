<?php 
class wfl_theme extends wf_lib {
	
	function fieldlist()
	{
		return Array(
				//new wfp_param('content_type','user',"��� �����������",$this->getname(),'��� �����������, ��������� � ������'),
				new wfp_param('theme',Array('defaultfront','defaultback'),"������",$this->getname(),'������ (������� �� ������� �����)'),
					//Array('name'=>'content_type','defvalue'=>'c1')
			);
	}
	
	// get pages of project required to this library
	function getpages()
	{
		return Array(
				Array("name"=>"index","title"=>"��������"),
				Array("name"=>"colors","title"=>"�������� �����")
		);
	}
	
	function page_colors()
	{
		echo "<p>COLORS</p>";
		
	}
	
	VAR $pagename="����";
}
?>