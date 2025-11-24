<?php

?>
<!DOCTYPE html>
<html>
  <?php include('util/header.php');?>
  <body> 
        <header>
            <h1>Add a Task</h1>
        </header>
        <main>
            <form action="." method="post" id="new_task_form" class="aligned">
                <input type="hidden" name="action" value="add_task">

                <label>Task Name:</label>
                <input type="text" name="task_name" 
                    value="">
                <?php echo $fields->getField('task_name')->getHTML(); ?><br>

                <label>Due Date:</label>
                <input type="text" name="due_date" 
                    value="">
                <?php echo $fields->getField('due_date')->getHTML(); ?><br>

                <label>Description:</label>
                <input type="text" name="description" 
                    value="">
                <?php echo $fields->getField('description')->getHTML(); ?><br>

                <label>Status:</label>
                <select name="status" id="status">
                    <option value="Complete">Complete</option>
                    <option value="Not Complete" selected>Not Complete</option>
                </select>
                <?php echo $fields->getField('status')->getHTML(); ?><br>

                <label>&nbsp;</label>
                <input type="submit" value="Add Task">
            </form>
            <form action="." method="post" id="return_home" class="aligned">
                <input type="hidden" name="action" value="show_admin_menu">

                <label>&nbsp;</label>
                <input type="submit" value="Back to Home Page">
            </form>
        </main>
  </body>

</html>