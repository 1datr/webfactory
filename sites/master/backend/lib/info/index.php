<?php 
class wfl_info extends wf_lib {
	
	function fieldlist()
	{
		return Array(
				//new wfp_param('content_type','user',"��� �����������",$this->getname(),'��� �����������, ��������� � ������'),
				new wfp_param('sitename','Site1',"�������� �����",$this->getname(),''),
				new wfp_param('moto','Hello, world',"������",$this->getname(),''),
				new wfp_param('enterpoints',Array('frontend','backend','install'),"����� �����",$this->getname(),'',Array('frontend','backend','install')),
					//Array('name'=>'content_type','defvalue'=>'c1')
			);
	}
	
	function hook_compile($_params)
	{
		echo "<h2>COMPILING</h2>";
		print_r($_params);
		makesite($_params['SITE'],$this->params['enterpoints']);
		write_file($_params['SITE'],NULL,"config.php",
					$this->parse_temp("config",
						Array(
							"TITLE"=>$_params['PROJECT']->params['sitename']->value,
							"SLOGAN"=>$_params['PROJECT']->params['moto']->value,
						)));
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
			foreach ($param->value as $ep)
			{
				//	var_dump($param);
				$readonly = "";
				if(in_array($ep, $param->att_data)) 
				{
					$readonly =" readonly disabled=\"disabled\"";
				}
				?>
				<div class="array_item">
				<div class="textbox">
				<input type="text" name="params[<?php echo $param->name; ?>][]"<?php echo $readonly; ?> value="<?php echo $ep; ?>" />
				</div>
				<?php 
				if(in_array($ep, $param->att_data))
				{
					
				}
				else 
				{
					?>
					<div class="drop"> 
						<input type="image" title="�������" src="/sites/<?php echo $_SITE."/".$_ENTERPOINT; ?>/images/delete.jpg" />
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
						<input type="image" title="�������" src="/sites/<?php echo $_SITE."/".$_ENTERPOINT; ?>/images/delete.jpg" />
					</div>
				</div>
			</div>
		</div>
		
		
		<input type="button" value="��������" class="btn_add"/>
		<?php 		
	}
	
	VAR $pagename="����������";
}
?>