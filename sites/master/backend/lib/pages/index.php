<?php 
/* Tree of pages */
class pagesTree
{
	function __construct()
	{
		
	}
}

class wfl_pages extends wf_lib {
	
	function fieldlist()
	{
		return Array(
				//new wfp_param('content_type','user',"Тип содержимого",$this->getname(),'Тип содержимого, выводимый в обзоре'),
				new wfp_param('pagelist',Array('frontend'=>Array('index','auth'),'backend'=>Array('index'),'install'=>Array('index')),"Список страниц",$this->getname(),'Страницы сайта'),
					//not to change this pages
				new wfp_param('pages_stable',Array('frontend/index','backend/index','install/index'),"Список страниц",$this->getname(),'Страницы сайта'),
				
			);
	}
	
	function pagepath()
	{
		
	}
	
	function page_index($project)
	{
		
		function drawnode($arr,$path,$project)
		{
			//var_dump($path);
			if(is_array($arr))
			{
				?>
							<ul class="ul_page_tree">
							<?php 
							$i = 0;
							foreach($arr as $key => $pages)
							{
								
								$path_str = implode('/',$path);
								?>
								<li>
									
									<?php 
									if(is_array($pages))
									{				
										if(in_array($pathstr."/".$key, $project->params['pages_stable']->value))
										{
											?>											
										<input type="text" readonly="readonly" name="params[<?php echo $path_str; ?>][]" value="<?php echo $key; ?>" />	
											
											<?php 	
										}
										else 
										{
												
										}
											?>											
										<input type="text" name="params[<?php echo $path_str; ?>][]" value="<?php echo $key; ?>" />	
										<button type="button" class="btn btn-inverse btn-mini btn-add-branch"><i class="icon-white icon-plus-sign"></i></button>
											<button type="button" class="btn btn-primary btn-mini btn-drop_branch"><i class="icon-white icon-remove-sign"></i></button>								
											
											<?php 
											$path[]=$key;
										drawnode($pages,$path,$project);
									}
									else 
									{
										if(in_array($pathstr."/".$pages, $project->params['pages_stable']->value))
										{
											?>											
											<input type="text" readonly="readonly" name="params[<?php echo $path_str; ?>][]" value="<?php echo $key; ?>" />	
											
											<?php 	
										}
										else 
										{
											?>
											<input type="text" name="params[<?php echo $path_str; ?>][]" value="<?php echo $pages; ?>" />
											<button type="button" class="btn btn-inverse btn-mini btn-add-branch"><i class="icon-white icon-plus-sign"></i></button>
											<button type="button" class="btn btn-primary btn-mini btn-drop_branch"><i class="icon-white icon-remove-sign"></i></button>								
											<?php
										}
										
										?>
												
										<?php 
									}
									?>
		
								</li>
								<?php
								$i++;
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
							<input type="hidden" name="params[pagelist][<?php echo $key; ?>][<?php echo $i ?>]" value="<?php echo $key; ?>" />
								<?php 
									            
								?>
							</li>
							<?php 
						}
					}
		
		?>
		<div class="accordion" id="acc_pagetree">
		<?php
		//GLOBAL $_LIBS;
		$i=0;
		foreach ($project->params['pagelist']->value as $key => $ep)
		{
			?>
			<div class="accordion-group">
				<div class="accordion-heading">
		
					<span class="add_btn-on-accordion">	
						<button type="button" class="btn btn-inverse btn-mini btn-add-branch"><i class="icon-white icon-plus-sign"></i></button>
					</span>
					
						<a class="accordion-toggle collapsed" data-toggle="collapse"
						data-parent="#acc_pagetree" href="#acc_<?php echo $key; ?>">
						<font class="btn btn-info btn-mini"><i class="icon-white icon-arrow-right"></i></font>&nbsp;
						 <?php echo $key; ?> 
						 </a>
					
					
				</div>
				<div id="acc_<?php echo $key; ?>" class="accordion-body collapse"
				style="height: 0px;">
					<div class="accordion-inner">
					<?php 
					drawnode($project->params['pagelist']->value[$key],Array($key),$project);
					
					?>					
					</div>
				</div>
			
			</div>
			
			<?php 
		}
		?>
		</div>

		
		<?php
		
		jq_bind_event('.btn-add-branch', "
				alert($(this).parent().html());
		/*
				$('#pagetree .addingpage input[type=\"text\"]').attr(\"name\",\"params[]\");
				branchhtml = $('#pagetree .addingpage').html();
				$(this).parent().children('ul').append('<li>'+branchhtml+'</li>');*/
				");
		jq_bind_event('.btn-drop_branch', "
				$(this).parent().remove();
				");
	}
	/*
	function page_index_x($project)
	{
		
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
			function drawnode($arr,$thename)
			{
				
				if(is_array($arr))
				{
					?>
					<ul>
					<?php 
					$i = 0;
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
									<input type="hidden" name="params[pagelist][<?php echo $key; ?>][<?php echo $i ?>]" value="<?php echo $key; ?>" />								
									<?php	
								}
								else 
								{
									?>
									<span class="badge badge-success"><i class="icon-folder-open"></i><input type="text" name="<?php echo $thename; ?>[<?php echo $i; ?>]" value="<?php echo $key; ?>" /></span>
									<button type="button" class="btn btn-inverse btn-mini btn-add-branch"><i class="icon-white icon-plus-sign"></i></button>
									<button type="button" class="btn btn-primary btn-mini btn-drop_branch"><i class="icon-white icon-remove-sign"></i></button>								
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
									<input type="hidden" name="params[pagelist][<?php echo $i ?>]" value="<?php echo $key; ?>" />								
									<?php
								}
								else 
								{
									?>
									<span class="badge badge-success"><i class="icon-leaf"></i><input type="text" name="<?php echo $thename; ?>[<?php echo $i; ?>]" value="<?php echo $pages; ?>" /></a></span>
									<button type="button" class="btn btn-inverse btn-mini btn-add-branch"><i class="icon-white icon-plus-sign"></i></button>
									<button type="button" class="btn btn-primary btn-mini btn-drop_branch"><i class="icon-white icon-remove-sign"></i></button>								
									<?php
								}
								
							}
							?>

						</li>
						<?php
						$i++;
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
					<input type="hidden" name="params[pagelist][<?php echo $key; ?>][<?php echo $i ?>]" value="<?php echo $key; ?>" />
						<?php 
							            
						?>
					</li>
					<?php 
				}
			}
			
			?>
		<div class="tree well" id="pagetree">
		<ul>
        <li>
            <span><i class="icon-folder-open"></i> Страницы</span>
    		<ul>	
			<?php 
			//GLOBAL $_LIBS;
			$i=0;
			foreach ($project->params['pagelist']->value as $key => $ep)
			{
				if(is_array($ep))
				{
					?>
					<li>
					<?php if($key=="index")
								{
									?>
									<span class="badge"><i class="icon-minus-sign"></i><input type="text" name="params[pagelist][<?php echo $key; ?>][<?php echo $i ?>]" value="<?php echo $key; ?>" /></span>								
									<?php									
								}
								else 
								{	
									?>
									<span class="badge "><i class="icon-minus-sign"></i>&nbsp;<?php echo $key; ?></span>
									<input type="hidden" name="params[pagelist][<?php echo $key; ?>][<?php echo $i ?>]" value="<?php echo $key; ?>" />
									<button type="button" class="btn btn-inverse btn-mini btn-add-branch"><i class="icon-white icon-plus-sign"></i></button>			
									<?php 
								}
								?>
						
					
						<?php 
						drawnode($ep,"params[pagelist][".$key."][". $i."]");
						 ?>
				
					</li>
					<?php
				}
				else
				{
					?>
					<li>
						<span class="badge "><i class="icon-minus-sign"></i><a href="">&nbsp;<?php echo $ep; ?></a></span>
						<input type="hidden" name="params[pagelist][<?php echo $key; ?>][<?php echo $i ?>]" value="<?php echo $key; ?>" />
		            	<?php 
		            
		            	?>
		            </li>
					<?php	
				}	
				$i++;		
			}
?>
   		</li>
   		</ul>
   		
   		<div class="addingpage" style="display: none;">
   			<span class="badge "><i class="icon-minus-sign"></i>&nbsp;<input type="text" name="" value="" /></span>
			<button type="button" class="btn btn-inverse btn-mini btn-add-branch"><i class="icon-white icon-plus-sign"></i></button>	
			<button type="button" class="btn btn-primary btn-mini btn-drop_branch"><i class="icon-white icon-remove-sign"></i></button>								
   		</div>
	</div>
	<?php 
	}*/
	
	VAR $pagename="Страницы";
}

?>