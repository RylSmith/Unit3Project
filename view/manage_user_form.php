<?php
    $user = get_admin($_SESSION['user_id']);
?>
<!DOCTYPE html>
<html>
  <?php include('util/header.php');?>
  <body> 
        <header>
            <h1>Welcome to the Task Manager Area</h1>
        </header>
        <main>
            <h2>Account Information</h2>
            <ul>
                <li>Email: <?php echo($user['emailAddress']); ?></li>
                <li>Name: <?php echo($user['fName'] . ' ' . $user['lName']) ?></li>
            </ul>

            <form action="." method="post" id="update_user_form" class="aligned">
                <input type="hidden" name="action" value="update_user_form">

                <label>&nbsp;</label>
                <input type="submit" value="Update Account Information">
            </form>
            
            <form action="." method="post" id="return_home" class="aligned">
                <input type="hidden" name="action" value="show_admin_menu">

                <label>&nbsp;</label>
                <input type="submit" value="Back to Home Page">
            </form>

            <form action="." method="post" id="logout_form" class="aligned">
                <input type="hidden" name="action" value="logout">

                <label>&nbsp;</label>
                <input type="submit" value="Logout">
            </form>
        </main>
  </body>

</html>