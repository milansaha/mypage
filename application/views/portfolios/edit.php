<?php
	//print_r($row);
	$options[""] = "--------SELECT---------";
	foreach($app_types as $app_type)
	{					
		$options[$app_type->app_type_id]=$app_type->app_type_name;
	}
	echo form_open('portfolios/edit');
	echo form_hidden('portfolio_id',$row->id);
	$class_name = 'class="formTitleBar_edit"';
?>
<fieldset>
	<table class="addForm" border="0" cellspacing="0px" cellpadding="0px" width="100%">
		<tr>
			<td class="formTitleBar">
				<div <?php echo $class_name?>>
					<h2>Edit Portfolio</h2>
				</div>
			</td>
			<td class="formTitleBar">
				<div style="float:right;">
					<?php echo form_submit(array('name'=>'submit','id'=>'submit','class'=>'submit_buttons positive'),'Save');?>
					<?php echo form_button(array('name'=>'button','id'=>'button','value'=>'true','type'=>'reset','content'=>'Reset','class'=>'reset_buttons'));?>
					<?php echo form_button(array('name'=>'button','id'=>'button','value'=>'true','type'=>'reset','content'=>'Cancel','class'=>'cancel_buttons','onclick'=>"window.location.href='".site_url('portfolios')."'"));?>
				</div>
			</td>
		</tr>
		<tr>
			<td width="60%">
				<div class="formContainer">
					<ul>  						 
						<li>
							<label for="app_type">Application Type:<span class="required_field_indicator">*</span></label>
							<div class="form_input_container">
							<?php echo form_dropdown('app_type', $options,$row->application_type_id); ?>
							</div>
							<?php echo form_error('app_type'); ?>	
							</div>			
						</li>
						<li>
							<label for="txt_name">Name:<span class="required_field_indicator">*</span></label>
							<div class="form_input_container">
								<?php echo form_input(array('name'=>'txt_name','id'=>'txt_name','maxlenght'=>'100','class'=>'input_textbox'),set_value('txt_name',(isset($row->name)?$row->name:"")));?>
								<?php echo form_error('txt_name'); ?>
							</div>
						</li>

						<li>
							<label for="txt_url">URL:<span class="required_field_indicator">*</span></label>
							<div class="form_input_container">
								<?php echo form_input(array('name'=>'txt_url','id'=>'txt_url','maxlenght'=>'100','class'=>'input_textbox'),set_value('txt_url',(isset($row->url)?$row->url:"")));?>
								<?php echo form_error('txt_url'); ?>
							</div>
						</li>
						<li>
							<label for="txt_name">Summary:<span class="required_field_indicator">*</span></label>
							<div class="form_input_container">
							<textarea name="txt_summary"><?php echo (isset($row->summary)?$row->summary:"");?></textarea>
							<?php echo form_error('txt_summary'); ?>
							</div>
						</li>
						<li>
							<label for="txt_description">Description:<span class="required_field_indicator">*</span></label>
							<div class="form_input_container">
								<textarea name="txt_description"><?php echo (isset($row->description)?$row->description:"");?></textarea>
								<?php echo form_error('txt_description'); ?>
							</div>
						</li>
					</ul>
				</div>
			</td>
									
			<td valign="top" style="background:url(<?php echo base_url();?>media/images/alpona.gif) no-repeat bottom right;">
				<p class="helper"></p>
			</td>
		</tr>
		<tr>
			<td class="formBottomBar">
				<div class="buttons" style="margin:0px 0px 0px 20px;">
					<?php echo form_submit(array('name'=>'submit','id'=>'submit','class'=>'submit_buttons positive'),'Save');?>
					<?php echo form_button(array('name'=>'button','id'=>'button','value'=>'true','type'=>'reset','content'=>'Reset','class'=>'reset_buttons'));?>
					<?php echo form_button(array('name'=>'button','id'=>'button','value'=>'true','type'=>'reset','content'=>'Cancel','class'=>'cancel_buttons','onclick'=>"window.location.href='".site_url('portfolios')."'"));?>
				</div>
			</td>
			<td class="formBottomBar"></td>
		</tr>
	</table>
</fieldset>
<?php 
echo form_close();
?>
