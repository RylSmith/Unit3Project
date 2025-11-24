<?php
    $user = get_admin($_SESSION['user_id']);
?>  
<!DOCTYPE html>
<html>
  <?php include('util/header.php');?>
  <body> 
        <header>
            <h1>Update a Task</h1>
        </header>
        <main>
            <form action="." method="post" id="update_user" class="aligned">
                <input type="hidden" name="action" value="update_user">

                <label>E-Mail:</label>
                <input type="text" name="email" 
                    value="<?php echo $user['emailAddress'] ?>">
                <?php echo $fields->getField('email')->getHTML(); ?><br>

                <label>First Name:</label>
                <input type="text" name="first_name" 
                    value="<?php echo $user['fName'] ?>">
                <?php echo $fields->getField('first_name')->getHTML(); ?><br>

                <label>Last Name:</label>
                <input type="text" name="last_name" 
                    value="<?php echo $user['lName'] ?>">
                <?php echo $fields->getField('last_name')->getHTML(); ?><br>

                <label>&nbsp;</label>
                <input type="submit" value="Update Account">
            </form>
            <form action="." method="post" id="return_home" class="aligned">
                <input type="hidden" name="action" value="show_admin_menu">

                <label>&nbsp;</label>
                <input type="submit" value="Back to Home Page">
            </form>
        </main>
  </body>

</html>