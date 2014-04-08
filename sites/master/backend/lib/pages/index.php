<?php 
class wfl_pages extends wf_lib {
	
	function fieldlist()
	{
		return Array(
				//new wfp_param('content_type','user',"Тип содержимого",$this->getname(),'Тип содержимого, выводимый в обзоре'),
				new wfp_param('pagelist',Array('frontend'=>Array('index'),'backend'=>Array('index'),'install'=>Array('index')),"Список страниц",$this->getname(),'Страницы сайта'),
					//Array('name'=>'content_type','defvalue'=>'c1')
			);
	}
	
	function page_index($project)
	{
		addcss("bootstrap/css/bootstrap-combined.min.css");
		/*addcss("css/fuelux.css");
		addcss("css/fuelux-responsive.css");
		addcss("css/style.css");
		
		
		addscript("bootstrap/js/blanket.min.js");
		addscript("bootstrap/js/bootstrap-treeview.min.js");
		addscript("bootstrap/js/qunit-1.12.0.js");*/
		
		/* make tree */
		js_fragment("
				$(function () {
    $('.tree li:has(ul)').addClass('parent_li').find(' > span').attr('title', 'Collapse this branch');
    $('.tree li.parent_li > span').on('click', function (e) {
        var children = $(this).parent('li.parent_li').find(' > ul > li');
        if (children.is(\":visible\")) {
            children.hide('fast');
            $(this).attr('title', 'Expand this branch').find(' > i').addClass('icon-plus-sign').removeClass('icon-minus-sign');
        } else {
            children.show('fast');
            $(this).attr('title', 'Collapse this branch').find(' > i').addClass('icon-minus-sign').removeClass('icon-plus-sign');
        }
        e.stopPropagation();
    });
});
	");
			function drawnode($arr)
			{
				
				if(is_array($arr))
				{
					?>
					<ul>
					<?php 
					foreach($arr as $key => $pages)
					{
						
						?>
						<li>
							
							<?php 
							if(is_array($pages))
							{				
								if($key=="index")
								{
									?>
									<span class="badge badge-success"><i class="icon-folder-open"></i>&nbsp;<?php echo $key; ?></span>								
									<?php	
								}
								else 
								{
									?>
									<span class="badge badge-success"><i class="icon-folder-open"></i><input type="text" name="" value="<?php echo $key; ?>" /></span>								
									<?php	
								}
									
								drawnode($pages);
							}
							else 
							{
								if($key=="index")
								{
									?>
									<span class="badge badge-success"><i class="icon-leaf"></i>&nbsp;<?php echo $pages; ?></a></span>								
									<?php
								}
								else 
								{
									?>
									<span class="badge badge-success"><i class="icon-leaf"></i><input type="text" name="" value="<?php echo $pages; ?>" /></a></span>								
									<?php
								}
								
							}
							?>

						</li>
						<?php
					}
					?>
					</ul>
					<?php 
				}				
				elseif(is_string($arr)) 
				{
					//var_dump($arr);
					?>
					<li>
					<span class="badge badge-success"><i class="icon-time"></i>&nbsp;<a href=""><?php echo $arr; ?></a></span>
						<?php 
							            
						?>
					</li>
					<?php 
				}
			}
			
			?>
		<div class="tree well">
		<ul>
        <li>
            <span><i class="icon-folder-open"></i> Страницы</span>
    		<ul>	
			<?php 
			//GLOBAL $_LIBS;
			foreach ($project->params['pagelist']->value as $key => $ep)
			{
				if(is_array($ep))
				{
					?>
					<li>
					<?php if($key=="index")
								{
									?>
									<span class="badge"><i class="icon-minus-sign"></i><input type="text" name="" value="<?php echo $key; ?>" /></span>								
									<?php									
								}
								else 
								{	
									?>
									<span class="badge "><i class="icon-minus-sign"></i>&nbsp;<?php echo $key; ?></span>
									<?php 
								}
								?>
						
					
						<?php 
						drawnode($ep);
						 ?>
				
					</li>
					<?php
				}
				else
				{
					?>
					<li>
						<span class="badge "><i class="icon-minus-sign"></i><a href="">&nbsp;<?php echo $ep; ?></a></span>
		            	<?php 
		            
		            	?>
		            </li>
					<?php	
				}			
			}
?>
   		</li>
   		</ul>
	</div>
	<?php 
	}
	
	VAR $pagename="Страницы";
}
?>