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
				$proj->addparam($p);
		}
	}
	
	function getname()
	{
		$classname = get_class($this);
		list($thename) = sscanf($classname, "wfl_%s");
		return $thename;
	}
	
	function draw_param_input($param)
	{
		?>
		<input type="text" name="params[<?php echo $param->name; ?>]" value="<?php echo $param->value; ?>" />
		<?php 
	}
	// get pages of project required to this library
	function getpages()
	{
		return Array(Array("name"=>"index","title"=>"Основное"));
	}
	
	function page_index()
	{
		echo "THE INDEX PAGE";
	}
	
	VAR $pagename="";
}

class wfp_param 
{
	VAR $name;		//	name of setting item
	VAR $value;		// 	value of setting item
	VAR $lib;		// 
	VAR $description;	// describe of field
	VAR $title;		// title of field
	
	function __construct($name,$value,$title,$lib,$describe=NULL)
	{
		$this->name = $name;
		$this->value = $value;
		$this->title = $title;
		$this->lib = $lib;
		$this->description = $describe;
	}
}
// class of webfactory project
class wf_project {
	VAR $params;
	VAR $libs;
	
	function addparam($p)
	{
		if($this->params==NULL) 
			$this->params=Array();
		
		if($this->libs==NULL)
			$this->libs=Array();
		
		
		
		$this->params[$p->name] = $p;
		
		if(!in_array($p->lib, $this->libs))
			$this->libs[]=$p->lib;
		
	}
	
	function save($filename)
	{
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