<div id="filter">
	<h3>Portfolio List</h3>
	<div style="border:solid 0px red;float:right;width:auto;" class="buttons">
		<?php echo anchor('portfolios/add',img(array('src'=>base_url().'/media/images/add.png','border'=>'0','alt'=>'Add Portfolio')).'Add',array('class'=>'addbutton','title'=>'Add Portfolio'));  ?>
	</div>
</div>
<table class="sortable" cellspacing="0px" cellpadding="0px">
<tr>
	<th width='10%'>#</th>
	<th width='50%'>Name</th>
    <th width='20%'>Type</th>
    <!--<th width='5%'>Report Sorting Order</th>-->
	<th>Action</th>
</tr>
<?php 
	$i=$counter;
	foreach ($portfolios as $row):
	$i++;
?>
<tr <?php if($i % 2 == 0){ echo 'class="evenrow";'; echo ' bgcolor="#fff"';}else{echo 'class="oddrow"';}?> >
	 <td class="serial"><?php echo $i;?></td>
	<td><?php echo $row->name;?></td>
    <td><?php echo $row->app_type_name;?></td>
	<td>
	<?php echo anchor('portfolios/edit/'.$row->id,'Edit',array('class'=>'imglink','title'=>'Edit'));   ?> |
	<?php echo anchor('portfolios/delete/'.$row->id, 'Delete',
					array('class'=>'delete','title'=>'Delete','onclick'=>"return confirm('" . DELETE_CONFIRMATION_MESSAGE . "')"));?>	
	<?php /*echo anchor('portfolios/edit/'.$row->id,img(array('src'=>base_url().'media/images/edit.gif','border'=>'0','alt'=>'edit')),array('class'=>'imglink','title'=>'Edit'));   ?>
	<?php echo anchor('portfolios/delete/'.$row->id, img(array('src'=>base_url().'media/images/delete.gif','border'=>'0','alt'=>'edit')),
					array('class'=>'delete','title'=>'Delete','onclick'=>"return confirm('" . DELETE_CONFIRMATION_MESSAGE . "')"));
					*/?>	
	</td>	
</tr>
<?php endforeach;?>
</table>

<div align="center" id="paging"><?php echo $this->pagination->create_links(); ?></div>
