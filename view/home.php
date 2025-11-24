<?php

?>
<!DOCTYPE html>
<html>
  <?php include('util/header.php');?>
  <body> 
        <header>
            <h1>Welcome to the Task Manager Area</h1>
        </header>
        <main>
            <form action="." method="post" id="manage_user_form" class="aligned">
                <input type="hidden" name="action" value="manage_user_form">

                <label>&nbsp;</label>
                <input type="submit" value="Manage Account">
            </form>

            <form action="." method="post" id="add_task_form" class="aligned">
                <input type="hidden" name="action" value="add_task_form">

                <label>&nbsp;</label>
                <input type="submit" value="Add Task">
            </form>

            <?php include('view/task_list.php'); ?>

            <form action="." method="post" id="logout_form" class="aligned">
                <input type="hidden" name="action" value="logout">

                <label>&nbsp;</label>
                <input type="submit" value="Logout">
            </form>
        </main>
  </body>

</html>