<div id="filter">
	<h3>Application Type Information</h3>
	<div style="border:solid 0px red;float:right;width:auto;" class="buttons">
		<?php echo anchor('application_types/add',img(array('src'=>base_url().'/media/images/add.png','border'=>'0','alt'=>'Add Application type')).'Add',array('class'=>'addbutton','title'=>'Add Application Type'));  ?>
	</div>
</div>
<table class="sortable" cellspacing="0px" cellpadding="0px">
<tr>
	<th width='10%'>#</th>
	<th width='30%'>Type Name</th>
    <th width='40%'>Summary</th>
	<th>Action</th>
</tr>
<?php 
	$i=$counter;
	foreach ($apptypes as $row):
	$i++;
?>
<tr <?php if($i % 2 == 0){ echo 'class="evenrow";'; echo ' bgcolor="#fff"';}else{echo 'class="oddrow"';}?> >
	 <td class="serial"><?php echo $i;?></td>
	<td><?php echo $row->name;?></td>
    <td><?php echo $row->summary;?></td>
	<td>
	<?php echo anchor('application_types/edit/'.$row->id,img(array('src'=>base_url().'media/images/edit.gif','border'=>'0','alt'=>'edit')),array('class'=>'imglink','title'=>'Edit'));   ?>
	<?php echo anchor('application_types/delete/'.$row->id, img(array('src'=>base_url().'media/images/delete.gif','border'=>'0','alt'=>'edit')),
					array('class'=>'delete','title'=>'Delete','onclick'=>"return confirm('" . DELETE_CONFIRMATION_MESSAGE . "')"));?>	
	</td>	
</tr>
<?php endforeach;?>
</table>

<div align="center" id="paging"><?php echo $this->pagination->create_links(); ?></div>
