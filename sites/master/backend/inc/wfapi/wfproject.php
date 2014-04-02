<?php 



class wfp_param 
{
	VAR $name;			//	name of setting item
	VAR $value;			// 	value of setting item
	VAR $lib;			// 
	VAR $description;	// describe of field
	VAR $title;			// title of field
	VAR $fieldclass;	// класс поля
	
	function __construct($name,$value,$title,$lib,$describe=NULL,$fieldclass="text")
	{
		$this->name = $name;
		$this->value = $value;
		$this->title = $title;
		$this->lib = $lib;
		$this->description = $describe;
		$this->fieldclass = $fieldclass;
	}
}
// class of webfactory project
class wf_project {
	VAR $params;
	VAR $libs;
	VAR $name;
	
	function addparam($p)
	{
		if($this->params==NULL) 
			$this->params=Array();
		
		if($this->libs==NULL)
			$this->libs=Array();
		
		
		if(empty($this->params[$p->name]))
			$this->params[$p->name] = $p;
		
		if(!in_array($p->lib, $this->libs))
			$this->libs[]=$p->lib;
		
	}
	
	function save($filename=NULL)
	{
		if($filename==NULL)
			$filename = mydir()."/projects/".$this->name."/index.prj";
		file_put_contents($filename, serialize($this));
	}
	
	function draw_param_input($fparam)
	{
		GLOBAL $_LIBS;
		$_LIBS[$fparam->lib]->draw_param_input($fparam);
	}	
	
}

function loadproject($projname)
{
	$prjfile = mydir()."projects/$projname/index.prj";
	//var_dump($prjfile);
	if(file_exists($prjfile))
	{
		$projobj = unserialize(file_get_contents($prjfile));
		
		GLOBAL $_LIBS;
		
		foreach($_LIBS as $lname => $lib)
		{
			$lib->addfields($projobj);
		}
		
		return $projobj;
	}
	else 
	{
		$projobj = new wf_project();
		$projobj->name = $projname;
		GLOBAL $_LIBS;
		
		foreach($_LIBS as $lname => $lib)
		{
			$lib->addfields($projobj);
		}
		
		return $projobj;
	}
	return NULL;
}

?>