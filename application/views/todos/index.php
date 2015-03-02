<?php foreach ($todos as $todo): ?>

    <h2><?php echo $todo['title'] ?></h2>
    <div id="list">
        <?php echo $todo['description'] ?>
    </div>
    
<a href="<?php echo base_url(); ?>index.php/todos/view/<?php echo $todo['id'] ?>">View</a> | 
	<a href="<?php echo base_url(); ?>index.php/todos/edit/<?php echo $todo['id'] ?>">Edit</a> | 
	<a href="<?php echo base_url(); ?>index.php/todos/completed/<?php echo $todo['id'] ?>">Completed</a>
	<hr>
<?php endforeach ?>