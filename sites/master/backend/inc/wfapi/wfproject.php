<?php 
// compiler library
class wf_lib
{
	// attaching fields
	function fieldlist()
	{
		return null;
	}
	
	function addfields(&$proj)
	{
		$paramlist = $this->fieldlist();
		foreach ($paramlist as $p)
		{
			//var_dump($p);
			if(!empty($p))
				$proj->addparam($p['name'],$p['defvalue'],$this->getname());
		}
	}
	
	function getname()
	{
		$classname = get_class($this);
		list($thename) = sscanf($classname, "wfl_%s");
		return $thename;
	}
}

class wfp_param 
{
	VAR $name;		//	name of setting item
	VAR $value;		// 	value of setting item
	VAR $lib;		// 
}
// class of webfactory project
class wf_project {
	VAR $params;
	VAR $libs;
	
	function addparam($pname,$value,$lib)
	{
		if($this->params==NULL) 
			$this->params=Array();
		
		if($this->libs==NULL)
			$this->libs=Array();
		
		$paramobj = new wfp_param();
		$paramobj->name = $pname;
		$paramobj->value = $value;
		$paramobj->lib = $lib;
		
		$this->params[$pname] = $paramobj;
		
		if(!in_array($lib, $this->libs))
			$this->libs[]=$lib;
		
	}
	
	function save($filename)
	{
		file_put_contents($filename, serialize($this));
	}
	
}

function loadproject($projname)
{
	$prjfile = mydir()."projects/$projname/index.prj";
	//var_dump($prjfile);
	if(file_exists($prjfile))
	{
		$projobj = unserialize(file_get_contents($prjfile));
		return $projobj;
	}
	else 
	{
		$projobj = new wf_project();
		
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