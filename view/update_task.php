<?php
    $taskId = $_SESSION['task_id'];
    $task = get_task($taskId);
?>  
<!DOCTYPE html>
<html>
  <?php include('util/header.php');?>
  <body> 
        <header>
            <h1>Update a Task</h1>
        </header>
        <main>
            <form action="." method="post" id="new_task_form" class="aligned">
                <input type="hidden" name="action" value="update_task">

                <label>Task Name:</label>
                <input type="text" name="task_name" 
                    value='<?php echo $task['taskName'] ?>'>
                <?php echo $fields->getField('task_name')->getHTML(); ?><br>

                <label>Due Date:</label>
                <input type="text" name="due_date" 
                    value="<?php echo $task['dueDate'] ?>">
                <?php echo $fields->getField('due_date')->getHTML(); ?><br>

                <label>Description:</label>
                <input type="text" name="description" 
                    value="<?php echo $task['description'] ?>">
                <?php echo $fields->getField('description')->getHTML(); ?><br>

                <label>Status:</label>
                <select name="status" id="status">
                    <option value="Complete" <?php if ($task['status'] = "Complete") echo 'selected'; ?>>Complete</option>
                    <option value="Not Complete" <?php if ($task['status'] = "Not Complete") echo 'selected'; ?>>Not Complete</option>
                </select>
                <?php echo $fields->getField('status')->getHTML(); ?><br>

                <label>&nbsp;</label>
                <input type="submit" value="Update Task">
            </form>
            <form action="." method="post" id="return_home" class="aligned">
                <input type="hidden" name="action" value="show_admin_menu">

                <label>&nbsp;</label>
                <input type="submit" value="Back to Home Page">
            </form>
        </main>
  </body>

</html>