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
		return Array(Array("name"=>"index","title"=>"��������"));
	}
	
	function page_index($project)
	{
		echo $this->getname()." v.".$this->version;
		?>
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
			$ftype = gettype($project->params[$fld->name]->value);
			$ftclass = "wfp_fc_$ftype";
			$fc = new $ftclass();
			$fc->draw($project->params[$fld->name]);
			?>
			</td>
			</tr>
			<?php 	
		}
		?>
		</table>
		<?php
	}
	
	VAR $pagename="";
	VAR $version = "1.0";
}
?>