<table class="sortable" cellspacing="0px" cellpadding="0px">
<tr>
	<th width='10%'>#</th>
    <th width='40%'>Name</th>
	<th>Summary</th>
</tr>
<?php 
	foreach ($app_list as $row):	
?>
<tr>
	<td><?php echo $row->name;?></td>
    <td><?php echo $row->summary;?></td>
</tr>
<?php endforeach;?>
</table>
		