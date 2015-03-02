<h2>Edit a To-do item</h2>

<?php echo validation_errors(); //print_r($todo); die(); ?>

<?php echo form_open('todos/edit') ?>

	<label for="title">Title: </label> 
	<input type="input" name="title" value="<?php echo $todo['title']?>" />

	<label for="text">Description: </label>
	<textarea name="description"><?php echo $todo['description']?></textarea>
	
	<input type="submit" name="submit" value="Update" /> 

</form>