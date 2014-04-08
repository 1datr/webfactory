<?php 
class wfl_info extends wf_lib {
	
	function fieldlist()
	{
		return Array(
				//new wfp_param('content_type','user',"Тип содержимого",$this->getname(),'Тип содержимого, выводимый в обзоре'),
				new wfp_param('sitename','Site1',"Название сайта",$this->getname(),''),
				new wfp_param('moto','Hello, world',"Слоган",$this->getname(),''),
				new wfp_param('enterpoints',Array('frontend','backend','install'),"Точки входа",$this->getname(),'',Array('frontend','backend','install')),
					//Array('name'=>'content_type','defvalue'=>'c1')
			);
	}
	
	function hook_compile($_params)
	{
		echo "<h2>COMPILING</h2>";
	//var_dump($this->params);
		makesite($_params['SITE'],$_params['PROJECT']->params['enterpoints']->value);
		write_file($_params['SITE'],NULL,"config.php",
					$this->parse_temp("config",
						Array(
							"TITLE"=>$_params['PROJECT']->params['sitename']->value,
							"SLOGAN"=>$_params['PROJECT']->params['moto']->value,
						)));
		$this->gen_hook("make_base",Array('libfrom'=>'info','project'=>$_params['PROJECT']));
	}
	
	function fld_enterpoints_input_draw($param)
	{
		GLOBAL $_SITE;
		GLOBAL $_ARGS;
		GLOBAL $_PAGE;
		GLOBAL $_ENTERPOINT;
		?>
		<div id="array_box_<?php echo $param->name; ?>" class="arraybox">
		<?php 
		//var_dump($param);
			foreach ($param->value as $ep)
			{
				//	var_dump($param);
				$readonly = "";
				if(in_array($ep, $param->att_data)) 
				{
					$readonly =" readonly";
				}
				?>
				<div class="array_item">
				<div class="textbox">
				<input type="text" name="params[<?php echo $param->name; ?>][]" <?php echo $readonly; ?> value="<?php echo $ep; ?>" />
				</div>
				<?php 
				if(in_array($ep, $param->att_data))
				{
					
				}
				else 
				{
					?>
					<div class="drop"> 
						
						<button class="btn btn-info btn-small btn-drop" title="Удалить"><i class="icon-white icon-remove"></i></button>
					</div>
					<?php 
				}
				?>
				
				</div>
				<?php 
			}
			?>
			<div class="adding_block" style="display:none">
				<div class="array_item">
					<div class="textbox">
					<input type="text" name="params[<?php echo $param->name; ?>][]" value="" />
					</div>
					<div class="drop"> 
					<button class="btn btn-info btn-small btn-drop" title="Удалить"><i class="icon-white icon-remove"></i></button>				
										
					</div>
				</div>
			</div>
		</div>
		
		<button class="btn btn-primary btn-small btn_add"><i class="icon-white icon-plus-sign"></i> Добавить</button>
		
		<?php 		
	}
	
	VAR $pagename="Информация";
}
?>