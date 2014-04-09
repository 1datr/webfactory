<?php	
/* fieldclass class */
class wfp_fc
{
	function  draw($fld_param)
	{

	}
}

class wfp_fc_string extends wfp_fc
{
	function draw($fld,$name=NULL)
	{
		if($name==NULL)
			$name = "params[".$fld->name."]";
		?>
		<input type="text" name="<?php echo $name; ?>" value="<?php echo $fld->value; ?>" />
		<?php	
	}
}

class wfp_fc_integer extends wfp_fc
{
	function draw($fld,$name=NULL)
	{
		if($name==NULL)
			$name = "params[".$fld->name."]";
		?>
		<input type="text" name="$name" value="<?php echo $fld->value; ?>" />
		<?php	
	}
}

class wfp_fc_float extends wfp_fc
{
	function draw($fld,$name=NULL)
	{
		if($name==NULL)
			$name = "params[".$fld->name."]";
		?>
		<input type="text" name="$name" value="<?php echo $fld->value; ?>" />
		<?php	
	}
}

class wfp_fc_boolean extends wfp_fc
{
	function draw($fld,$name=NULL)
	{
		if($name==NULL)
			$name = "params[".$fld->name."]";
		if($fld->value) $checked = "checked"; else $checked = "";
		?>
		<input type="checkbox" name="$name" <?php echo $checked; ?> />
		<?php	
	}
}

class wfp_fc_array extends wfp_fc
{
	function draw($fld,$name=NULL)
	{
		if($name==NULL)
			$name = "params[".$fld->name."]";		
		
		?>
		<div id="array_box_<?php echo $fld->name; ?>" class="">
		<?php 
		foreach($fld->value as $idx => $val)
		{
			//var_dump($fld);
			?>
			<div>
			<?php 			
			$ftype = gettype($val);
			$ftclass = "wfp_fc_$ftype";
			$fc = new $ftclass();
			$param = new wfp_param('',$val,"","array_".$name);
			$fc->draw($param,$name."[]");
			?>
			</div>
			<?php 
		}
		?>
		</div>
	<?php 
	}
}

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
	
	function parse_temp($tmpl_file,$parse_vars)
	{
		$content = file_get_contents(mydir()."lib/".$this->getname()."/templates/$tmpl_file.pft");
		$parse_vars_skob = Array();
		foreach ($parse_vars as $key => $val)
		{
			$parse_vars_skob["{_".$key."_}"]=$val;			
		}
		return strtr($content,$parse_vars_skob);
	}
	
	function draw_param_input($param)
	{
		$ftype = gettype($param->value);
		$ftclass = "wfp_fc_$ftype";
		$fc = new $ftclass();
		$fc->draw($val);		
	}
	// get pages of project required to this library
	function getpages()
	{
		return Array(Array("name"=>"index","title"=>"Основное"));
	}
	
	function hook($hookname,$params=NULL)
	{
		$hookname = "hook_".$hookname;
		if(method_exists($this, $hookname))
			$this->$hookname($params);
	}
	
	function gen_hook($hookname,$params=NULL)
	{
		GLOBAL $_LIBS;
		foreach ($_LIBS as $idx => $lib)
		{
			$lib->hook($hookname,$params);
		}
	}
	
	function page_index($project)
	{
		?>
		<div class="well">
		<?php 
		echo $this->getname()." v.".$this->version;
		?>
		</div>
		<table>
		<?php
		
		foreach ($this->fieldlist() as $fld)
		{
			//print_r($fld);
			$value = $project->params[$fld->name]->value;
			?>
			<tr>
			<th><?php echo $project->params[$fld->name]->title; ?></th>
			<td>			
			<?php 
			$draw_fun_name = "fld_".$fld->name."_input_draw";
			
			if(method_exists($this,$draw_fun_name))
				$this->$draw_fun_name($project->params[$fld->name]);
			else
			{
				//var_dump($project->params[$fld->name]);
				$ftype = gettype($project->params[$fld->name]->value);
				
				$ftclass = "wfp_fc_$ftype";
				if(class_exists($ftclass))
				{
					$fc = new $ftclass();
					$fc->draw($project->params[$fld->name]);
				}
			}				
			?>
			</td>
			</tr>
			<?php 	
		}
		?>
		</table>
		<?php
	}
	// required libs
	function req_libs()
	{
		return Array();
	}
	// после загрузки библы
	function after_load()
	{
		
	}
	// собрать данные для библиотеки из формы
	function gather_form_data()
	{
		$keys = array_keys($_POST['params']);
		//var_dump($keys);
		foreach($keys as $idx)
		{
			//var_dump($idx);
			if(is_array($_POST['params'][$idx]))
			{
				foreach($_POST['params'][$idx] as $idx2 => $v)
				{
					if($v=="")
						unset($_POST['params'][$idx][$idx2]);
				}
			}
			$project->params[$idx]->value = $_POST['params'][$idx];
		}
	}
	
	VAR $pagename="";
	VAR $version = "1.0";
}
?>